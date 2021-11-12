<?php


namespace VotingSystem\Grids\Admin;


use VotingSystem\Grids\BaseGrid;
use VotingSystem\Grids\Core\Grid;
use VotingSystem\Models\Nominee;

class NomineeGrid extends BaseGrid
{

    protected function setGrid(Grid $grid)
    {
        $grid->setName('nominees');
        $grid->setDefaultSort(['id' => 'desc']);
        $grid->addColumn('avatar', 'Photo')->setCallback(function($val,$dp){
            if(!empty($val)){
                return "<img src='$val->url' style='width: 90px;'>";
            }
            return '';
        });
        $grid->addColumn('id')->setSearchFilter();

        $grid->addColumn('name')->setSearchFilter();
        $grid->addColumn('designation');
        $grid->addColumn('manifesto');
        $grid->addColumn('status')->setBooleanFilter('Active', 'Inactive')
            ->setCallback(function ($val, $dp) {
                $row = $dp->getSrc();
                if ($val) {
                    return "<button class='btn btn-danger bg-gradient-danger btn-sm status' data-id='$row->id'>Deactivate</button>";
                } else {
                    return "<button class='btn btn-success bg-gradient-success btn-sm status' data-id='$row->id'>Activate</button>";
                }
            });
        $grid->addColumn('action')->setCallback(function ($val, $dp) {
            $row = $dp->getSrc();
            $categories = json_encode($row->categories->pluck('id')->toArray());
            return "<button class='btn btn-sm btn-info bg-gradient-info add-category' data-id='$row->id' data-categories='$categories' data-toggle='modal' data-target='#category-modal'>Add Categories</button>";
        });

        $grid->addColumn('action')->setCallback(function ($val, $dp) {
            $row = $dp->getSrc();
            return "<button class='btn btn-sm btn-success bg-gradient-success' data-id='$row->id' data-toggle='modal' data-target='#image-modal'>Add Image</button>";
        });

        return $grid;
    }

    protected function getQuery()
    {
        return Nominee::with('categories', 'avatar')->newQuery();
    }
}
