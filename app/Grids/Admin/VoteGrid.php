<?php


namespace VotingSystem\Grids\Admin;


use VotingSystem\Grids\BaseGrid;
use VotingSystem\Grids\Core\Grid;
use VotingSystem\Models\Nominee;
use VotingSystem\Models\NomineeCategory;
use VotingSystem\Models\Vote;

class VoteGrid extends BaseGrid
{

    protected function setGrid(Grid $grid)
    {
        $grid->setName('votes-grid');
        $grid->setDefaultSort(['id' => 'desc']);
        $grid->addColumn('vote_id');
        foreach ($this->getCategories() as $category) {
            $grid->addColumn($category->name)->setCallback(function ($val, $dp) use ($category) {
                $row = $dp->getSrc();
                $voteValue = json_decode($row->vote_value);
                $arr = collect($voteValue);
                $categoryName = implode('_',explode(' ',strtolower($category->name)));
                $nominee = Nominee::find($arr[$categoryName]);
                if(!empty($nominee)){
                    return $nominee->name;
                }
                return '';
            });
        }
        return $grid;
    }

    protected function getQuery()
    {
        return (new Vote())->newQuery();
    }

    private function getCategories()
    {
        return NomineeCategory::all();
    }
}
