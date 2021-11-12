<?php

namespace VotingSystem\Services;

use VotingSystem\Models\NomineeCategory;
use Illuminate\Http\Request;
use VotingSystem\Exceptions\ServiceException;
use VotingSystem\Services\Service;

class NomineeCategoryService extends Service
{
    public function create(Request $request)
    {
        $nomineeCategory = $this->processData($request, new NomineeCategory());
        $nomineeCategory->save();
        return $nomineeCategory;
    }

    public function update(Request $request)
    {
        $nomineeCategory = NomineeCategory::find($request->id);
        if (empty($nomineeCategory)) {
            throw new ServiceException("Nominee Category doesn't exist !");
        }
        $nomineeCategory = $this->processData($request, $nomineeCategory);
        $nomineeCategory->save();
        return $nomineeCategory;
    }

    public function delete(Request $request)
    {
        $nomineeCategory = NomineeCategory::find($request->id);
        if (empty($nomineeCategory)) {
            throw new ServiceException("Nominee Category doesn't exist !");
        }
        return $nomineeCategory->delete();
    }

    private function processData(Request $request, NomineeCategory $nomineeCategory)
    {
        $nomineeCategory->name = $request->name;
        return $nomineeCategory;
    }
}
