<?php

namespace app\index\controller;

use app\common\controller\Frontend;

class Home extends Frontend
{

    protected $layout = '';

    public function _initialize()
    {
        parent::_initialize();
    }

    public function release()
    {
        return $this->view->fetch();
    }

}
