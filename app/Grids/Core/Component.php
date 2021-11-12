<?php

namespace VotingSystem\Grids\Core;

use Nayjest\Grids\Components\HtmlTag as NayTag;
use Nayjest\Grids\Components\CsvExport;
use Nayjest\Grids\Components\ExcelExport;
use Nayjest\Grids\Components\ColumnsHider;
use Nayjest\Grids\Components\RecordsPerPage;
use Nayjest\Grids\Components\ShowingRecords;
use VotingSystem\Grids\Core\HtmlTag;

class Component
{
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function createHtmlTag()
    {
        $htmlTag = new HtmlTag();
        return $htmlTag;
    }

    public function addExcelExport($fileName)
    {
        $excelExport = (new ExcelExport())->setFileName($fileName);
        $this->config->addComponent($excelExport);
        return $this;
    }

    public function addCsvExport($fileName)
    {
        $excelExport = (new CsvExport())->setFileName($fileName);
        $this->config->addComponent($excelExport);
        return $this;
    }

    public function addColumnsHider()
    {
        $columnsHider = new ColumnsHider;
        $this->config->addComponent($columnsHider);
        return $this;
    }

    public function addRecordsPerPage($variants = [])
    {
        $recordsPerPage = new RecordsPerPage;
        if ($variants) {
            $recordsPerPage->setVariants($variants);
        }
        $this->config->addComponent($recordsPerPage);
        return $this;
    }

    public function addShowingRecords()
    {
        $showingRecords = new ShowingRecords;
        $this->config->addComponent($showingRecords);
        return $this;
    }

    public function addResetButton()
    {
        $resetButton = (new NayTag())
            ->setContent('<i class="fas fa-sync-alt" aria-hidden="true"></i> Reset')
            ->setTagName('button')
            ->setAttributes([
                'type' => 'button',
                'class' => 'btn btn-success btn-sm grid-reset bg-gradient-success',
            ]);
        $this->config->addComponent($resetButton);
        return $this;
    }

    public function addAction($action)
    {
        $action['class'] = empty($action['class']) ? 'action' : $action['class'] . ' action';
        $actionButtonConfig = $this->createHtmlTag()->getConfig();
        $content = '<button class="btn btn-small" type="button">' . $action['name'] . '</button>';
        if (!empty($action['button-class'])) {
            $content = '<button class="btn btn-small ' . $action['button-class'] . '" type="button">' . $action['name'] . '</button>';
        }
        if (!empty($action['href'])) {
            $content = '<a class="dropdown-item" href="' . $action['href'] . '" target="' . $action['target'] . '">' . $action['name'] . '</a>';
        }
        $actionButtonConfig->setContent($content)->setAttributes($action);
        $this->config->addComponent($actionButtonConfig);
    }

    public function addActions($actions)
    {
        if (!empty($actions)) {
            $dropdownWrapper = $this->createHtmlTag()->addClass('btn-group mr-4');
            $dropdownWrapperConfig = $dropdownWrapper->getConfig();
            $dropdownButtonConfig = $this->createHtmlTag()->getConfig();
            $dropdownButtonConfig->setContent('Actions')
                ->setTagName('button')
                ->setAttributes([
                    'type' => 'button',
                    'class' => 'btn btn-sm btn-primary bg-gradient-primary dropdown-toggle',
                    'data-toggle' => 'dropdown',
                    'aria-expanded' => 'false'
                ]);

            $dropdown = $this->createHtmlTag()->addClass("dropdown-menu dropdown-menu-right bulk-actions");
            foreach ($actions as $action) {
                $dropdown->addAction($action);
            }
            $dropdownConfig = $dropdown->getConfig();
            $dropdownConfig->setTagName('div');

            $dropdownWrapperConfig->addComponent($dropdownButtonConfig);
            $dropdownWrapperConfig->addComponent($dropdownConfig);
            $this->config->addComponent($dropdownWrapperConfig);
        }
        return $this;
    }
}
