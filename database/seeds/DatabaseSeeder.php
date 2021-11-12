<?php

use Illuminate\Database\Seeder;
use VotingSystem\Models\Voter;
use VotingSystem\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->setAdmin();
//        $this->setVoter();
    }

    private function setVoter()
    {
        $voter = new Voter();
        $voter->membership_number = "100";
        $voter->name = 'Kounser Khalid';
        $voter->phone = '7006634196';
        $voter->designation = 'Cheif Engineer';
        $voter->save();
    }

    private function setAdmin()
    {
        $user = new User();
        $user->name = 'Kounser Khalid';
        $user->email = 'admin@cega.com';
        $user->password = bcrypt('password');
        $user->status = true;
        $user->save();
    }
}
