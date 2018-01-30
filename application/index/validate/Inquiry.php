<?php

namespace app\index\validate;

use think\Validate;

class Inquiry extends Validate
{
    /**
     * 验证规则
     */
    protected $rule = [
        'title'    => 'require|max:25',
        'username' => 'require|max:25',
        'phone'    => 'require|regex:(1[3-8])[0-9]{9}',
        'Model'    => 'require',
    ];
    /**
     * 提示消息
     */
    protected $message = [
        'title.require' => '请填写物品名称',
        'title.max' => '物品名称最多不能超过25个字符',
        'username.require'  => '请填写姓名',
        'username.max'  => '姓名最多不能超过25个字符',
        'phone.require'  => '请填写手机号',
        'phone.regex'  => '请填写正确的手机号',
        'Model.require' => '请选择询价型号',
    ];
    /**
     * 验证场景
     */
    protected $scene = [

    ];
    
}
