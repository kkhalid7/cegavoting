<?php

namespace VotingSystem\Http\Controllers\Admin;

use Illuminate\Http\Request;
use VotingSystem\Http\Controllers\Controller;
use VotingSystem\Models\NomineeCategory;
use VotingSystem\Models\Vote;
use VotingSystem\Services\VoterService;
use VotingSystem\Models\Nominee;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $votes = $this->getVoteData($request);
        return view('admin.dashboard.index', compact('votes'));
    }

    public function getVoteData(Request $request)
    {
        $votes = Vote::all();
        $countVotes = collect([]);
        foreach ($votes as $vote){
            $countVotes->push(json_decode($vote->vote_value));
        }
        $nameWise = [];
        foreach($countVotes as $vote){
            foreach($vote as $key=>$vote){
                $nameWise[$key][] = Nominee::find($vote)->name;
            }
        }
        $finalCount = [];
        foreach($nameWise as $key=>$name){
            $finalCount[$key] = array_count_values($name);
        }
        return $finalCount;
    }

    public function resetVotes(VoterService $service)
    {
        Vote::truncate();
        $service->reset();
        return redirect()->back();
    }
}
