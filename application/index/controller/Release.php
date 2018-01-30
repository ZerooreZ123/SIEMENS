<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\Article;
use think\Request;
use think\Session;

/**
 * 发布产品
 *
 * @icon fa fa-circle-o
 */
class Release extends Frontend
{

    protected $layout = '';

    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        // 未登录
        $userInfo = Session::get('wechat_user');
        if (empty($userInfo)) {
            //网页授权
            $config = [
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
            ];
            $app = new Application($config);
            $oauth = $app->oauth;
//            exit();
//            return $oauth->redirect();
            // 这里不一定是return，如果你的框架action不是返回内容的话你就得使用
            $oauth->redirect()->send();
        }

        //询价型号
        $pmodel = db('pmodel')->limit(2)->select();
        $this->view->assign('pmodel',$pmodel);

        return $this->view->fetch();
    }

    public function release()
    {
        $data =  [
            'title'      => input('title',null),
//            'pmodel_id'  => input('pmodel_id',null),
            'content'    => input('content',null,null),
            'image'      => input('image',null),
//            'createtime' => time(),
//            'updatetime' => time(),
        ];

        $result = $this->validate($data,'Release');
        if(true !== $result){
            // 验证失败 输出错误信息
//            dump($result);
            $this->error($result);
        }else{
//            $res = db('product')->insertGetId($data);
//            if ($res){
                /*群发微信消息*/
                //实例化类
                /*$options = [
                    'debug'     => true,
                    'app_id'    => 'wx361547ce36eb2185',
                    'secret'    => '17fa4725b493ac5477c9ba174fd2456f',
                    'token'     => 'easywechat',
                    'log' => [
                        'level' => 'debug',
                        'file'  => '/tmp/easywechat.log',
                    ],
                    'guzzle' => [
                        'timeout' => 3.0, // 超时时间（秒）
                        'verify' => false, // 关掉 SSL 认证（强烈不建议！！！）
                    ],
                    // ...
                ];
                $app = new Application($options);

                // 永久素材
                $material = $app->material;

                //上传图片
                $uploadImage = ROOT_PATH.'public'.$data['image'];
                $result = $material->uploadImage($uploadImage);
                $mediaId = $result->media_id;

                // 上传图文
                $article = new Article([
                    'title' => $data['title'],
                    'thumb_media_id' => $mediaId,
                    'source_url' => url('Inquiry/index',['id'=>$res],'html',true),
                    'content' => $data['content'],
                    'show_cover' => 1,
                ]);
                $resData = $material->uploadArticle($article);

                //群发图文消息
                $broadcast = $app->broadcast;
                $broadcast->sendNews($resData->media_id);*/

                $this->success('消息推送成功');
            /*}else{
                $this->error('信息提交失败');
            }*/
        }
    }

    //上传文章图片
    public function uploadArticleImage()
    {
        $temp = input('path',null);
        $path = ROOT_PATH.'public'.$temp;

        $options = [
            'debug'     => true,
            'app_id'    => 'wx361547ce36eb2185',
            'secret'    => '17fa4725b493ac5477c9ba174fd2456f',
            'token'     => 'easywechat',
            'log' => [
                'level' => 'debug',
                'file'  => '/tmp/easywechat.log',
            ],
            'guzzle' => [
                'timeout' => 3.0, // 超时时间（秒）
                'verify' => false, // 关掉 SSL 认证（强烈不建议！！！）
            ],
            // ...
        ];
        $app = new Application($options);

        // 永久素材
        $material = $app->material;

        //上传图片
        $result = $material->uploadArticleImage($path);
        $url = $result->url;
        return $url;

        /*$this->success('', null, [
            'url' => $url
        ]);*/
    }

    //授权回调页
    public function oauth_callback()
    {
        $config = [
            'debug'     => false,
            'app_id'    => 'wx361547ce36eb2185',
            'secret'    => '17fa4725b493ac5477c9ba174fd2456f',
            'token'     => 'easywechat',
            /*'log' => [
                'level' => 'debug',
                'file'  => '/tmp/easywechat.log',
            ],*/
        ];
        $app = new Application($config);
        $oauth = $app->oauth;

        // 获取 OAuth 授权结果用户信息
        $user = $oauth->user();
        $userInf = $user->toArray();
        Session::set('wechat_user',$userInf);

        $this->redirect('Release/index');
    }
}
