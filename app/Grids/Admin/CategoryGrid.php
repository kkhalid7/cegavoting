<?php


namespace VotingSystem\Grids\Admin;


use VotingSystem\Grids\BaseGrid;
use VotingSystem\Grids\Core\Grid;
use VotingSystem\Models\NomineeCategory;

class CategoryGrid extends BaseGrid
{

    protected function setGrid(Grid $grid)
    {
        $grid->setName('category-grid');
        $grid->setDefaultSort(['id' => 'desc']);
        $grid->addColumn('id')->setSearchFilter();
        $grid->addColumn('name')->setSearchFilter();
        return $grid;
    }

    protected function getQuery()
    {
        return (new NomineeCategory())->newQuery();
    }
}
