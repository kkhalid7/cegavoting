<?php

namespace VotingSystem\Grids\Core;

use Closure;
use Nayjest\Grids\GridConfig;
use Nayjest\Grids\EloquentDataProvider;
use VotingSystem\Grids\Core\Header;
use VotingSystem\Grids\Core\Column;
use VotingSystem\Grids\Core\Footer;
use Nayjest\Grids\Grid as NayGrid;
use Nayjest\Grids\Components\TFoot;
use Nayjest\Grids\Components\THead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class Grid
{
    const OPERATOR_LIKE = 'like';
    const OPERATOR_EQ = '=';
    const OPERATOR_NOT_EQ = '<>';
    const OPERATOR_GT = '>';
    const OPERATOR_LS = '<';
    const OPERATOR_LSE = '<=';
    const OPERATOR_GTE = '>=';
    private $config;
    private $hiddenColumns = [];
    private $sort = [];
    private $actions = [];

    public function __construct($dataSource)
    {
        $this->config = new GridConfig();
        $this->setDefaultPageSize(10);
        $this->setDefaultSort(['id' => 'desc']);
        $this->setDataSource($dataSource);
    }

    private function setDataSource($source)
    {
        $this->config->setDataProvider(
            new EloquentDataProvider($source)
        );
        return $this;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function setName($name)
    {
        $this->config->setName($name);
        return $this;
    }

    public function setDefaultPageSize($size)
    {
        $this->config->setPageSize($size);
        return $this;
    }

    public function setDefaultSort($sortArray)
    {
        $this->sort = $sortArray;
        return $this;
    }

    private function setGridSort()
    {
        $this->config->setDefaultSort('id', 'desc');
    }

    public function getHeader()
    {
        return $this->header;
    }

    public function getFooter()
    {
        return $this->footer;
    }

    public function addColumn($name, $label = null)
    {
        $column = new Column($this, $name, $label);
        $this->config->addColumn($column->getConfig());
        return $column;
    }

    public function addHiddenColumn($name)
    {
        $this->hiddenColumns[] = $name;
        return $this;
    }

    public function addAction($name, $href, $destination, $openInNewTab, $attributes = [], Closure $callback = null)
    {
        $formAttributes = new FormAttributes();
        $formAttributes->setHref($href)->setName($name)->setDataDestination($destination)->openInNewTab($openInNewTab);
        foreach ($attributes as $key => $value) {
            $formAttributes->setAttributes($key, $value);
        }
        if (!empty($callback)) {
            call_user_func($callback, $formAttributes);
        }

        $this->actions[] = $formAttributes->getAttributes();
    }

    public function render()
    {
        $this->sort();
        $header = new Header($this->config->getComponentByName(THead::NAME));
        $header->setBulkActions($this->actions);
        $header->setDefaultComponents();
        new Footer($this->config->getComponentByName(TFoot::NAME));
        $nayGrid = new NayGrid($this->config);
        return $nayGrid->render();
    }

    public function getBuilder()
    {
        $nayGrid = new NayGrid($this->config);
        $nayGrid->prepare();
        return $nayGrid->getConfig()->getDataProvider()->getBuilder();
    }

    private function sort()
    {
        $name = $this->config->getName();
        if (empty(Input::get($name)['sort'])) {
            Input::merge([
                $name => [
                    'sort' => $this->sort
                ]
            ]);
        }
    }
}
