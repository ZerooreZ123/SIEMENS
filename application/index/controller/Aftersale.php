<?php

namespace app\index\controller;

use app\common\controller\Frontend;

/**
 * 售后服务
 *
 * @icon fa fa-circle-o
 */
class Aftersale extends Frontend
{

    protected $layout = '';

    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        $inf = db('after_sale')->where(['status'=>'normal'])->order('weigh desc')->find();
        $this->view->assign('inf',$inf);
        return $this->view->fetch();
    }

}
