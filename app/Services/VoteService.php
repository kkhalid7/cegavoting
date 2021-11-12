<?php

namespace VotingSystem\Services;

use Illuminate\Support\Facades\DB;
use VotingSystem\Models\Nominee;
use VotingSystem\Models\NomineeCategory;
use VotingSystem\Models\Vote;
use Illuminate\Http\Request;
use VotingSystem\Exceptions\ServiceException;
use VotingSystem\Models\Voter;
use VotingSystem\Services\Service;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;

class VoteService extends Service
{
    public function castVote(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $voter = Voter::find($request->voter_id);
            if ($voter->vote_casted) {
                throw new ServiceException('Vote already Casted!');
            }
            $voter->ip_address = request()->ip();
            $voter->latitude = $request->latitude;
            $voter->longitude = $request->longitude;
            $voter->vote_casted = true;
            $voter->save();
            $vote = $this->saveInBallot($request);
            $pdfUrl = $this->generatePdf($voter, $vote);
            $voteValue = $this->sanitizeVoteValue($vote);
            return ['vote_id' => $vote->vote_id, 'pdf_url' => $pdfUrl, 'vote_value' => $voteValue];
        });
    }


    private function generateRandomString($length = 6)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $stringExists = Vote::where('vote_id', $randomString)->first();
        if (empty($stringExists)) {
            return $randomString;
        }
        $this->generateRandomString($length);
    }

    private function saveInBallot(Request $request)
    {
        $categories = NomineeCategory::get();
        $vote = new Vote();
        $vote->vote_id = $this->generateRandomString(6);
        $voteValue = [];
        foreach ($categories as $category) {
            $voteValue[implode('_', explode(' ', strtolower($category->name)))] = $request->casts[$category->name];
        }
        $vote->vote_value = json_encode($voteValue);
        $vote->save();
        return $vote;
    }

    private function sanitizeVoteValue(Vote $vote)
    {
        $voteValues = json_decode($vote->vote_value);
        $sanitizedVote = [];
        foreach ($voteValues as $category => $value) {
            $categoryName = implode(' ', explode('_', ucfirst($category)));
            $nominee = Nominee::find($value);
            $sanitizedVote[$categoryName] = !empty($nominee) ? $nominee->name : 'Random Gibberish';
        }
        return $sanitizedVote;
    }

    private function generatePdf(Voter $voter, Vote $vote)
    {
        $pdf = PDF::loadView('pdf.vote-id', compact('vote', 'voter'));
        $hash = substr(md5($vote->vote_id), 0, 6);
        $filePath = "/generated-pdfs/$hash.pdf";
        $pdf->setPaper('A5', 'landscape');
        Storage::disk('public')->put($filePath, $pdf->outPut());
        $voter->hash = $hash;
        $voter->save();
        return Storage::disk('public')->url($filePath);
    }
}
