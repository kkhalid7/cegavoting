<?php

namespace VotingSystem\Http\Controllers\Admin;

use Illuminate\Http\Request;
use VotingSystem\Http\Controllers\Controller;
use VotingSystem\Grids\Admin\ImporterGrid;
use VotingSystem\Models\Importer;
use VotingSystem\Services\ImporterService;
use VotingSystem\Exceptions\ServiceException;
use Illuminate\Support\Facades\Storage;

class ImporterController extends Controller
{
    public function index(Request $request)
    {
        $grid = ImporterGrid::get();
        if ($request->ajax()) {
            return $grid;
        }
        $types = Importer::getConstants('type');
        return view('admin.importer.index', compact('grid', 'types'));
    }


    public function store(Request $request, ImporterService $service)
    {
        try {
            $importer = $service->create($request, auth()->user());
        } catch (ServiceException $exception) {
            return response(['custom_error' => $exception->getMessage(), 'message' => $exception->getMessage()], 422);
        }
        return response(['message' => 'Successfully imported!']);
    }

    public function downloadFile($file)
    {
        if (!Storage::exists('importers/' . $file)) {
            abort(404);
        }
        return Storage::download('importers/' . $file);
    }
}
