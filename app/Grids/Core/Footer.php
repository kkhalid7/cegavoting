<?php

namespace VotingSystem\Grids\Core;

use Nayjest\Grids\Components\TFoot;
use VotingSystem\Grids\Core\Component;
use Nayjest\Grids\Components\Laravel5\Pager;

class Footer extends Component
{
    public function __construct($config = null)
    {
        if (empty($config)) {
            $config = new TFoot();
        }
        parent::__construct($config);
    }
}
