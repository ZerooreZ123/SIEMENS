<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use EasyWeChat\Foundation\Application;

/**
 * 联系我们
 *
 * @icon fa fa-circle-o
 */
class Contact extends Frontend
{

    protected $layout = '';

    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        $options = [
            'debug'     => false,
            'app_id'    => 'wx361547ce36eb2185',
            'secret'    => '17fa4725b493ac5477c9ba174fd2456f',
            'token'     => 'easywechat',
            'aes_key'   => '', // EncodingAESKey，安全模式下请一定要填写！！！
            /*'log' => [
                'level' => 'debug',
                'permission' => 0777,
                'file'  => '/tmp/easywechat.log',
            ],*/
            'guzzle' => [
                'timeout' => 3.0, // 超时时间（秒）
                'verify' => false, // 关掉 SSL 认证（强烈不建议！！！）
            ],
            'oauth' => [
                'scopes'   => ['snsapi_base'],
                'callback' => url('Release/oauth_callback','','',true),
            ],
            // ..
        ];
        $app = new Application($options);
        $js = $app->js;
        $this->view->assign("js", $js);

        $list = db('company')->where(['status'=>'normal'])->order('weigh desc')->select();
        $this->view->assign("list", $list);

        return $this->view->fetch();
    }

    public function getLocation()
    {
        $address = input('address',null);

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,'http://apis.map.qq.com/ws/geocoder/v1/?address='.$address.'&key=XKWBZ-FD5CR-HQWWE-WVGNZ-D5SMK-W3FFS');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $res = curl_exec($ch);
        curl_close($ch);

        return $res;
    }

}
