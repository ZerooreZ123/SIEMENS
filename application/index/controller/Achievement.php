<?php

namespace app\index\controller;

use app\common\controller\Frontend;

/**
 * 部分业绩
 *
 * @icon fa fa-circle-o
 */
class Achievement extends Frontend
{

    protected $layout = '';

    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        $list = db('achievement')->where(['status'=>'normal'])->order('weigh desc')->select();
        $this->view->assign('list',$list);
        return $this->view->fetch();
    }

    public function details()
    {
        $id = input('id',0);
        $inf = db('achievement')->where(['id'=>$id,'status'=>'normal'])->find();
        $this->view->assign('inf',$inf);
        return $this->view->fetch();
    }

}
