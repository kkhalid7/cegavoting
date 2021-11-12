<?php


namespace VotingSystem\Grids\Admin;


use VotingSystem\Grids\BaseGrid;
use VotingSystem\Grids\Core\Grid;
use VotingSystem\Models\Voter;

class VotersGrid extends BaseGrid
{

    protected function setGrid(Grid $grid)
    {
        $grid->setName('voters-grid');
        $grid->setDefaultSort(['id' => 'desc']);
        $grid->addColumn('membership_number')->setSearchFilter();
        $grid->addColumn('name')->setSearchFilter();
        $grid->addColumn('phone')->setSearchFilter();
        $grid->addColumn('designation');
        $grid->addColumn('alt_phone');
        $grid->addColumn('address');
        $grid->addColumn('ip_address');
        $grid->addColumn('latitude');
        $grid->addColumn('longitude');
        $grid->addColumn('vote_casted')->setBooleanFilter()->setCallback(function ($val, $dp) {
            if ($val) {
                return "<h5><span class='badge badge-success bg-gradient-success'>Yes</span></h5>";
            } else {
                return "<h5><span class='badge badge-secondary bg-gradient-secondary'>No</span></h5>";
            }
        });
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
            $row = json_encode($dp->getSrc());
            return "<button class='btn btn-sm btn-info' data-voter='$row'>Edit</button>";
        });
        return $grid;
    }

    protected function getQuery()
    {
        return (new Voter())->newQuery();
    }
}
