<?php

namespace VotingSystem\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use VotingSystem\Http\Controllers\Controller;
use VotingSystem\Models\Voter;

class AuthController extends Controller
{
    private $auth;

    public function __construct()
    {
        $this->auth = Auth::guard('web');
    }

    public function getVoter(Request $request)
    {
        $voter = Voter::where('membership_number', $request->member_id)->orWhere('phone', $request->member_id)->first();
        if(empty($voter)){
            return response(['message'=>'Invalid membership id'],422);
        }
        return response()->json($voter,200);
    }

    public function authenticate(Request $request)
    {
        $voter = Voter::where('phone', $request->phone)->first();
        if(empty($voter)){
            return response(['message'=>'Invalid phone number'],422);
        }
        $this->auth->login($voter);
        return response(['message' => "Welcome $voter->name!", 'url' => route('web::home')]);
    }

    public function logout()
    {
        $this->auth->logout();
        return redirect(route('web::login.index'));
    }
}
