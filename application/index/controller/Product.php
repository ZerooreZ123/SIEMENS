<?php

namespace app\index\controller;

use app\common\controller\Frontend;

/**
 * 产品介绍
 *
 * @icon fa fa-circle-o
 */
class Product extends Frontend
{

    protected $layout = '';

    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        //产品模型列表
        $pmodel = db('pmodel')->select();

        //产品列表
        $product = [];
        $arr = [];
        if(!empty($pmodel) && is_array($pmodel)){
            foreach ($pmodel as $value){
                $inf = db('product')->where(['pmodel_id'=>$value["id"],'status'=>'normal'])->order('weigh desc')->select();
                $arr[] = $inf;
            }
            $product = $arr;
        }

        $this->view->assign("pmodel", $pmodel);
        $this->view->assign("product", $product);
        return $this->view->fetch();
    }

}
