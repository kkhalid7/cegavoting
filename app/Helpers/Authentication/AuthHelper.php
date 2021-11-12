<?php

namespace VotingSystem\Helpers\Authentication;

use VotingSystem\Contracts\AuthContract;
use VotingSystem\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthHelper
{

    private $auth;


    public function __construct()
    {
        $this->auth = Auth::guard('admin');
    }

    public function execute($request, AuthContract $listener)
    {
        return $this->attemptLogin($request, $listener);
    }

    private function attemptLogin($request, AuthContract $listener)
    {
        $user = User::where(['email' => $request->email])->first();
        if (!empty($user)) {
            if (!$user->status) {
                return $listener->userIsBlocked();
            }
                $remember = $request->has('remember') ? true : false;
                if ($this->auth->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
                    return $listener->userHasLoggedIn($user);
                }
            }
        return $listener->userLogInFailed('Invalid credentials');
    }

    public function logout($request, AuthContract $listener)
    {
        $this->auth->logout();
        return $listener->userHasLoggedOut();
    }
}
