<?php

namespace VotingSystem\Http\Controllers\Web;

use Illuminate\Http\Request;
use VotingSystem\Http\Controllers\Controller;
use VotingSystem\Models\NomineeCategory;

class HomeController extends Controller
{
    public function index()
    {
        $categories = NomineeCategory::with('nominees.avatar')->get();
        return view('web.home.index', compact('categories'));
    }
}
