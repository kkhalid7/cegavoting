<?php

namespace VotingSystem\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use VotingSystem\Contracts\AuthContract;
use VotingSystem\Helpers\Authentication\AuthHelper;
use VotingSystem\Http\Controllers\Controller;

class AuthController extends Controller implements AuthContract
{

    public function authenticate(Request $request, AuthHelper $authHelper)
    {
        return $authHelper->execute($request, $this);
    }

    public function logout(Request $request, AuthHelper $authHelper)
    {
        return $authHelper->logout($request, $this);
    }

    public function userHasLoggedIn($user)
    {
        Auth::guard('admin')->login($user);
        $redirect = redirect()->intended();
        return response(['message' => "Welcome $user->name!", 'intended' => $redirect->getTargetUrl()]);
    }

    public function userLogInFailed($message)
    {
        return response(['custom_error' => $message, 'message' => $message], 422);
    }

    public function userIsBlocked()
    {
        $message = 'Your Account is In-Active';
        return response(['custom_error' => $message, 'message' => $message], 422);
    }

    public function userHasLoggedOut()
    {
        return redirect()->route('admin::login');
    }

    public function userPasswordResetDone()
    {
        // TODO: Implement userPasswordResetDone() method.
    }

    public function userPasswordResetFailed($message)
    {
        // TODO: Implement userPasswordResetFailed() method.
    }
}
