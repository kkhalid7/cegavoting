<?php


namespace VotingSystem\Imports\Excel;


use Illuminate\Http\Request;
use VotingSystem\Http\Requests\Importer\Voter\CreateRequest;
use VotingSystem\Services\VoterService;

class VoterImporter extends BaseImporter
{
    public function rules($type)
    {
        if ($type == self::TYPE_CREATE) {
            return (new CreateRequest())->rules();
        }
//        elseif ($type == self::TYPE_UPDATE) {
//
//        }
        return [];
    }

    protected function processRow(Request $request)
    {
        $service = new VoterService();
        $service->create($request);
    }
}
