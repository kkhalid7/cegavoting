<?php

namespace VotingSystem\Http\Controllers\Admin;

use Illuminate\Http\Request;
use VotingSystem\Grids\Admin\CategoryGrid;
use VotingSystem\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $grid = CategoryGrid::get();
        if($request->ajax()){
            return $grid;
        }
        return view('admin.category.index', compact('grid'));
    }
}
