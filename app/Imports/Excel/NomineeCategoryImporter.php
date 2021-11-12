<?php


namespace VotingSystem\Imports\Excel;


use Illuminate\Http\Request;
use VotingSystem\Http\Requests\Importer\NomineeCategory\StoreRequest;
use VotingSystem\Services\NomineeCategoryService;

class NomineeCategoryImporter extends BaseImporter
{

    public function rules($type)
    {
        if ($type == self::TYPE_CREATE) {
            return (new StoreRequest())->rules();
        }
//        elseif ($type == self::TYPE_UPDATE) {
//
//        }
        return [];
    }
    protected function processRow(Request $request)
    {
        $service = new NomineeCategoryService();
        $service->create($request);
    }
}
