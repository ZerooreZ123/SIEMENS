<?php

namespace app\admin\controller;

use app\common\controller\Backend;

use think\Controller;
use think\Request;

/**
 * 测试管理
 *
 * @icon fa fa-circle-o
 */
class Test extends Backend
{
    
    /**
     * Test模型对象
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('Test');
        $this->view->assign("weekList", $this->model->getWeeklist());
        $this->view->assign("flagList", $this->model->getFlaglist());
        $this->view->assign("genderdataList", $this->model->getGenderdatalist());
        $this->view->assign("hobbydataList", $this->model->getHobbydatalist());
        $this->view->assign("statusList", $this->model->getStatuslist());
        $this->view->assign("stateList", $this->model->getStatelist());
    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个方法
     * 因此在当前控制器中可不用编写增删改查的代码,如果需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    

}
