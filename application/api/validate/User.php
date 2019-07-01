<?php
namespace app\api\validate;

use think\Validate;
use think\Db;

class User extends Validate
{
    //验证字段
    protected $scene=[
        'reg'=>['mobile','user_name','password','re_password','sex','birthday','code'],
        'editpassword' => ['password','re_password','code'],
    ];

    // 验证规则
    protected $rule = [
        'mobile' => 'require|unique:user',
        'sex' => 'require',
        'password' => 'require',
        're_password' => 'require|confirm:password',
        'user_name' => 'require',
        'birthday' => 'require',
        'code' => 'require',
    ];
    //错误信息
    protected $message = [
        'mobile.require' => '手机号码不能为空',
        'mobile.unique' => '手机号码已被注册',
        'sex.require' => '性别不能为空',
        'password.require' => '密码不能为空',
        're_password.require' => '重复密码不能为空',
        're_password.confirm' => '两次密码不一致',
        'user_name.require' => '用户名不能为空',
        'birthday.require' => '填上生日吧',
        'code.require' => '验证码不能为空',
    ];

}