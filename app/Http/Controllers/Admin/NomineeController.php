<?php

namespace VotingSystem\Http\Controllers\Admin;

use Illuminate\Http\Request;
use VotingSystem\Exceptions\ServiceException;
use VotingSystem\Grids\Admin\NomineeGrid;
use VotingSystem\Http\Controllers\Controller;
use VotingSystem\Models\NomineeCategory;
use VotingSystem\Services\NomineeService;
use VotingSystem\Services\Service;

class NomineeController extends Controller
{
    public function index(Request $request)
    {
        $grid = NomineeGrid::get();
        if ($request->ajax()) {
            return $grid;
        }
        $categories = NomineeCategory::all();
        return view('admin.nominee.index', compact('grid', 'categories'));
    }

    public function addCategory(Request $request, NomineeService $service)
    {
        try {
            $response = $service->addCategories($request);
        } catch (ServiceException $exception) {
            return response(['message' => $exception->getMessage(), 'custom_error' => $exception->getMessage()], 422);
        }
        return response($response);
    }

    public function addImage (Request $request, NomineeService $service)
    {
        try {
            $response = $service->addImage($request);
        } catch (ServiceException $exception) {
            return response(['message' => $exception->getMessage(), 'custom_error' => $exception->getMessage()], 422);
        }
        return response($response);
    }
}
