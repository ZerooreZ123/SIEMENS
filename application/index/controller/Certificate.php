<?php

namespace app\index\controller;

use app\common\controller\Frontend;

/**
 * 资质证书
 *
 * @icon certificate
 */
class Certificate extends Frontend
{

    protected $layout = '';

    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        //证书列表
        $list = db('certificate')->where(['status'=>'normal'])->order('weigh desc')->select();

        $res = [];
        if (!empty($list) && is_array($list)){

            foreach ($list as $value){
                $img_arr = explode ( ',', $value['images']);
                $value['images'] = array_slice($img_arr,0,2);
                $res[] = $value;
            }
            $list = $res;
        }

        $this->view->assign("list", $list);
        return $this->view->fetch();
    }

}
