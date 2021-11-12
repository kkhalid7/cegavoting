<?php

namespace VotingSystem\Services;

use VotingSystem\Models\Voter;
use Illuminate\Http\Request;
use VotingSystem\Exceptions\ServiceException;
use VotingSystem\Services\Service;

class VoterService extends Service
{
    public function create(Request $request)
    {
        $voter = $this->processData($request, new Voter());
        $voter->save();
        return $voter;
    }

    public function update(Request $request)
    {
        $voter = Voter::find($request->id);
        if (empty($voter)) {
            throw new ServiceException("Voter doesn't exist !");
        }
        $voter = $this->processData($request, $voter);
        $voter->save();
        return $voter;
    }

    public function delete(Request $request)
    {
        $voter = Voter::find($request->id);
        if (empty($voter)) {
            throw new ServiceException("Voter doesn't exist !");
        }
        return $voter->delete();
    }

    public function statusUpdate($id)
    {
        $voter = Voter::find($id);
        if (empty($voter)) {
            throw new ServiceException("Voter doesn't exist !");
        }
        $voter->toggleStatus()->save();
        return !$voter->status ? 'Voter Deactivated Successfully' : 'Voter Activated Successfully';
    }

    private function processData(Request $request, Voter $voter)
    {
        $voter->name = $request->name;
        $voter->membership_number = $request->membership_number;
        $voter->phone = $request->phone;
        $voter->designation = $request->designation;
        $voter->address = $request->address;
        $voter->alt_phone = $request->alt_phone;
        $voter->bank_acc_number = $request->bank_acc_number;
        return $voter;
    }

    public function reset()
    {
        $voters = Voter::all();
        foreach ($voters as $voter){
            $voter->ip_address = null;
            $voter->latitude = null;
            $voter->longitude = null;
            $voter->hash = null;
            $voter->vote_casted = false;
            $voter->save();
        }
    }
}
