<?php

namespace app\index\controller;

use app\common\controller\Frontend;

/**
 * 首页
 *
 * @icon fa fa-circle-o
 */
class Index extends Frontend
{

    protected $layout = '';

    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        return $this->view->fetch();
    }

}
