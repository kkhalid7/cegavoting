<?php


namespace VotingSystem\Grids\Admin;


use VotingSystem\Grids\BaseGrid;
use VotingSystem\Grids\Core\Grid;
use VotingSystem\Models\Importer;

class ImporterGrid extends BaseGrid
{

    protected function setGrid(Grid $grid)
    {
        $grid->setName('importer-grid');
        $grid->setDefaultSort(['id' => 'desc']);
        $grid->addColumn("id")->setSortable();
        $grid->addColumn("type")->setSelectFilter(Importer::getConstants('type'));
        $grid->addColumn("input_file", 'Input File')->setCallback(
            function ($val, $dp) {
                return '<a class="link" href="' . route(
                        "admin::importers.download-file",
                        ['file' => $val]
                    ) . '">' . $val . '</a>';
            }
        );
        $grid->addColumn("output_file", 'Output File')->setCallback(
            function ($val, $dp) {
                return '<a class="link" href="' . route(
                        "admin::importers.download-file",
                        ['file' => $val]
                    ) . '">' . $val . '</a>';
            }
        );
        $grid->addColumn('status')->setSelectFilter(Importer::getConstants('status'));
        $grid->addColumn("createdBy.name", "Created By")->setSearchFilter();
        $grid->addColumn("created_at", "Created At")->setDateTimeRangeFilter();
        return $grid;
    }

    protected function getQuery()
    {
       return Importer::with('createdBy')->newQuery();
    }
}
