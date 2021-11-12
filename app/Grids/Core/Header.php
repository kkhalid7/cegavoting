<?php

namespace VotingSystem\Grids\Core;

use Nayjest\Grids\Components\THead;
use VotingSystem\Grids\Core\Component;

class Header extends Component
{
    private $actions;

    public function __construct($config = null)
    {
        if (empty($config)) {
            $config = new THead();
        }
        parent::__construct($config);
    }

    public function setBulkActions($actions)
    {
        $this->actions = $actions;
    }

    public function setDefaultComponents()
    {
        $headerTag = $this->createHtmlTag()->addClass("row p-2");
        $leftTag = $this->createHtmlTag()->addClass("col-6 mt-2")
            ->addRecordsPerPage([5, 10, 20, 50, 100, 200, 300, 400, 500])
            ->addShowingRecords();

        $rightTag = $this->createHtmlTag()->addClass("col-6 text-right mt-2")
            ->addActions($this->actions)
            ->addResetButton()
//            ->addExcelExport('excel-data-' . date('d-m-Y-h-i-s'))
            ->addCsvExport('csv-data-' . date('d-m-Y-h-i-s'));
        // ->addColumnsHider();

        $headerTag->getConfig()->addComponent($leftTag->getConfig());
        $headerTag->getConfig()->addComponent($rightTag->getConfig());

        $this->config->addComponent($headerTag->getConfig());
    }
}
