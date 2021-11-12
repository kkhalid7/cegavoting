<?php

namespace VotingSystem\Http\Controllers\Admin;

use Illuminate\Http\Request;
use VotingSystem\Grids\Admin\VotersGrid;
use VotingSystem\Http\Controllers\Controller;

class VoterController extends Controller
{
    public function index(Request $request)
    {
        $grid = VotersGrid::get();
        if($request->ajax()){
            return $grid;
        }
        return view('admin.voter.index', compact('grid'));
    }
}
