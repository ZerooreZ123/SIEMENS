<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use EasyWeChat\Foundation\Application;
use think\Session;

/**
 * 我要询价
 *
 * @icon fa fa-circle-o
 */
class Inquiry extends Frontend
{

    protected $layout = '';

    public function _initialize()
    {
        parent::_initialize();
    }

    //产品详情页
    public function index()
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

    //询价信息提交
    public function inquiry()
    {
        //询价数据
        $data =  [
            'title'    => input('title',''),
            'username' => input('username',''),
            'phone'    => input('phone',''),
            'Model'    => input('Model',''),
            'createtime' => time(),
            'updatetime' => time(),
        ];
        //校验数据
//        $result = $this->validate($data,'Inquiry');
//        if(true !== $result){
        if(true !== true){// 验证失败 输出错误信息
            $this->error($result);
        }else{// 验证成功
            //向数据库添加询价信息
            $res = db('inquiry')->insert($data);
            //数据添加成功
            if ($res) {
                /*向管理员发送模板消息*/
                //获取管理员信息（openid）
                $userInf = Session::get('wechat_user');
                if (!empty($userInf)) {//管理员信息存在
                    //easywechat配置
                    $options = [
                        'debug' => true,
                        'app_id' => 'wx361547ce36eb2185',
                        'secret' => '17fa4725b493ac5477c9ba174fd2456f',
                        'token' => 'easywechat',
                        'log' => [
                            'level' => 'debug',
                            'file' => '/tmp/easywechat.log',
                        ],
                        'guzzle' => [
                            'timeout' => 3.0, // 超时时间（秒）
                            'verify' => false, // 关掉 SSL 认证（强烈不建议！！！）
                        ],
                        // ...
                    ];
                    //实例化easywechat
                    $app = new Application($options);
                    //调用模板消息类
                    $notice = $app->notice;
                    //发送模板消息
                    $notice->send([
                        'touser' => $userInf['id'],//管理员openid
                        'template_id' => 'VZXH5esdAAFisRwxL2ZuOV4t6vo3nL_k5S8_5x0aedM-id',//模板id
                        'data' => [//发送数据
                            "first" => "客户询价提醒！",
                            "keyword1" => "询价客户姓名" . $data['username'],
                            "keyword2" => "手机号" . $data['phone'],
                            "keyword3" => "询价产品" . $data['title'],
                            "remark" => "询价型号：" . $data['Model'],
                        ]
                    ]);
                }
            }
        }
        //返回首页
        return $this->view->fetch('index/index');
    }

}
