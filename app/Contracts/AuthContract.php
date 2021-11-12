<?php


namespace VotingSystem\Contracts;


interface AuthContract
{
    public function userHasLoggedIn($user);

    public function userLogInFailed($message);

    public function userIsBlocked();

    public function userHasLoggedOut();

    public function userPasswordResetDone();

    public function userPasswordResetFailed($message);
}
