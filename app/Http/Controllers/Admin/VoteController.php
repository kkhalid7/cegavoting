<?php

namespace VotingSystem\Http\Controllers\Admin;

use Illuminate\Http\Request;
use VotingSystem\Grids\Admin\VoteGrid;
use VotingSystem\Http\Controllers\Controller;

class VoteController extends Controller
{
    public function index(Request $request)
    {
        $grid = VoteGrid::get();
        if($request->ajax()){
            return $grid;
        }
        return view('admin.vote.index', compact('grid'));
    }
}
