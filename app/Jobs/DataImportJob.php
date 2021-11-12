<?php

namespace VotingSystem\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use VotingSystem\Imports\Excel\NomineeCategoryImporter;
use VotingSystem\Imports\Excel\NomineeImporter;
use VotingSystem\Imports\Excel\VoterImporter;
use VotingSystem\Models\Importer;

class DataImportJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private $importer;

    public function __construct(Importer $importer)
    {
        $this->importer = $importer;
    }

    public function handle()
    {
        $this->importer->loadMissing('createdBy');
        switch ($this->importer->type) {
            case Importer::TYPE_VOTER:
                (new VoterImporter($this->importer))->import(storage_path("app/importers/" . $this->importer->input_file), null, \Maatwebsite\Excel\Excel::CSV);
                break;
            case Importer::TYPE_NOMINEES:
                (new NomineeImporter($this->importer))->import(storage_path("app/importers/" . $this->importer->input_file), null, \Maatwebsite\Excel\Excel::CSV);
                break;

            case Importer::TYPE_NOMINEE_CATEGORY:
                (new NomineeCategoryImporter($this->importer))->import(storage_path("app/importers/" . $this->importer->input_file), null, \Maatwebsite\Excel\Excel::CSV);
                break;
            default:
                # code...
                break;
        }
    }
}
