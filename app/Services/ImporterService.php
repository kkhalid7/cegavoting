<?php

namespace VotingSystem\Services;

use VotingSystem\Models\Importer;
use Illuminate\Http\Request;
use VotingSystem\Exceptions\ServiceException;
use VotingSystem\Models\User;
use VotingSystem\Services\Service;
use VotingSystem\Jobs\DataImportJob;
use Illuminate\Support\Facades\DB;

class ImporterService extends Service
{
    public function create(Request $request, User $createdBy)
    {
        return DB::transaction(function () use ($request, $createdBy) {
            $importer = $this->processData($request, new Importer(), $createdBy);
            $importer->save();
            DataImportJob::dispatchNow($importer);
            return $importer;
        });
    }

    public function complete(Importer $importer)
    {
        $importer->status = Importer::STATUS_COMPLETED;
        $importer->save();
    }

    public function completeWithError($importer, $outputFileName)
    {
        $importer->status = Importer::STATUS_COMPLETED_WITH_ERRORS;
        $importer->output_file = $outputFileName;
        $importer->save();
    }

    private function processData(Request $request, Importer $importer, $createdBy)
    {
        $fileName = $request->type . "-" . time() . rand(10, 99) . '.csv';
        $this->rawUpload($request->file('input_file'), 'importers/', $fileName);
        $importer->type = $request->type;
        $importer->status = Importer::STATUS_PROCESSING;
        $importer->input_file = $fileName;
        $importer->created_by = $createdBy->id;
        return $importer;
    }
}
