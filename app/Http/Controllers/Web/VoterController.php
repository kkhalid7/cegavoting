<?php

namespace VotingSystem\Http\Controllers\Web;

use Illuminate\Http\Request;
use VotingSystem\Exceptions\ServiceException;
use VotingSystem\Http\Controllers\Controller;
use VotingSystem\Services\VoteService;

class VoterController extends Controller
{
    public function castVote(Request $request, VoteService $service)
    {
        try {
            $response = $service->castVote($request);
        } catch (ServiceException $exception) {
            return response(['message' => $exception->getMessage(), 'custom_error' => $exception->getMessage()], 422);
        }
        return response()->json([$response], 200);
    }
}
