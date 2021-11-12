<?php

namespace VotingSystem\Imports\Excel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Row;
use VotingSystem\Exceptions\ServiceException;
use VotingSystem\Imports\Excel\Exceptions\ImporterException;
use VotingSystem\Models\Importer;
use VotingSystem\Services\ImporterService;

abstract class BaseImporter implements OnEachRow, WithHeadingRow, WithChunkReading
{
    use Importable {
        Importable::import as parentImport;
    }

    const TYPE_UPDATE = 'update';
    const TYPE_CREATE = 'create';

    protected $importer;

    protected $outputContent = [];

    public function __construct(Importer $importer)
    {
        $this->importer = $importer;
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function import($filePath = null, string $disk = null, string $readerType = null)
    {
        $fileName = null;
        $parentImporter = $this->parentImport($filePath, $disk, $readerType);
        $importerService = new ImporterService();
        if (!empty($this->outputContent)) {
            $fileName = "Output-" . $this->importer->id . "-" . time() . ".csv";
            $heading = array_keys($this->outputContent[0]);
            (new ExcelExporter($this->outputContent, $heading))->store("importers/$fileName", null, Excel::CSV);
            $importerService->completeWithError($this->importer, $fileName);
        } else {
            $importerService->complete($this->importer);
        }
        return $parentImporter;
    }

    protected function rules($type)
    {
        return [

        ];
    }

    public function onRow(Row $row)
    {
        $data = $row->toArray();
        $request = new Request();
        $request->merge($data);
        $type = !empty($data['id']) ? self::TYPE_UPDATE : self::TYPE_CREATE;
        try {
            $validator = Validator::make($data, $this->rules($type));
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            $this->processRow($request);
        } catch (ServiceException  | ImporterException $exception) {
            $data['error'] = $exception->getMessage();
            $this->setOutput($data);
        } catch (ValidationException $exception) {
            $errors = implode(' , ', array_flatten($exception->errors()));
            $data['error'] = $errors;
            $this->setOutput($data);
        }
    }

    abstract protected function processRow(Request $request);


    private function setOutput(array $output)
    {
        $this->outputContent[] = $output;
    }

}
