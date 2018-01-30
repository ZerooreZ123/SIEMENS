<?php

namespace app\index\controller;

use app\common\controller\Frontend;

/**
 * 公司简介
 *
 * @icon fa fa-circle-o
 */
class Company extends Frontend
{

    protected $layout = '';

    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        //列表信息
        $list = db('company')->where(['status'=>'normal'])->order('weigh desc')->select();
        $this->view->assign('list',$list);

        return $this->view->fetch();
    }

    public function details()
    {
        //公司详情
        $id = input('id',0);
        $inf = db('company')->where(['status'=>'normal','id'=>$id])->find();
        $this->view->assign('inf',$inf);

        return $this->view->fetch();
    }

    public function dialog()
    {
        //产品详情
        $id = input('id',0);
        $inf = db('product')->where(['id'=>$id])->find();
        $this->view->assign("inf", $inf);

        //询价型号
        $pmodel = db('pmodel')->limit(2)->select();
        $this->view->assign('pmodel',$pmodel);

        return $this->view->fetch();
    }
}
