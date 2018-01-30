<?php

namespace app\index\validate;

use think\Validate;

class Release extends Validate
{
    /**
     * 验证规则
     */
    protected $rule = [
        'title'     => 'require|max:25',
//        'pmodel_id' => 'require',
        'content'   => 'require',
        'image'     => 'require',
    ];
    /**
     * 提示消息
     */
    protected $message = [
        'title.require'     => '请填写标题',
        'title.max'         => '标题最多25个字符',
//        'pmodel_id.require' => '请选择产品型号',
        'content.require'   => '请填写内容',
        'image.require'     => '请上传消息封面缩略图',
    ];
    /**
     * 验证场景
     */
    protected $scene = [

    ];
    
}
