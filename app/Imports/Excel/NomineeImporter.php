<?php


namespace VotingSystem\Imports\Excel;


use Illuminate\Http\Request;
use VotingSystem\Http\Requests\Importer\Nominee\StoreRequest;
use VotingSystem\Services\NomineeService;

class NomineeImporter extends BaseImporter
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
        $service = new NomineeService();
        $service->create($request);
    }
}
