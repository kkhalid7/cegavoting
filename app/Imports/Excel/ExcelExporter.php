<?php

namespace VotingSystem\Imports\Excel;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelExporter implements FromArray, WithHeadings
{
    use Exportable;

    protected $data;
    /**
     * @var array
     */
    private $heading;

    public function __construct(array $data, array $heading=[])
    {
        $this->data = $data;
        $this->heading = $heading;
    }

    public function array():array
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return $this->heading;
    }
}
