<?php

namespace app\api\v1\controller;

use think\Controller;
use think\Session;
use app\api\validate\User as uval;

class User extends Base
{
    /**
     * 验证码
     */
    public function SeedsMsg(){
        $phone = input('phone');
        return yzx($phone);
    }
    /**
     * 用户注册操作
     */
    public function Reg(){
        $data = input('post.');
        $validate = new uval();
        if(!$validate->scene('reg')->check($data)){
            return apishow(0,'fail',$validate->getError(),200);
        }
        $phone = Session::get('user');
        if(!empty($phone)){
            //这里判断验证码是否过期
            // if(time() - $phone['time'] > 60){
            //     Session::delete('user');
            //     return apishow(0,'fail','验证码错误',200);
            // }else{
                if($data['code'] != $phone['yzm']){
                    return apishow(0,'fail','验证码错误',200);
                }else{
                    unset($data['re_password']);
                    unset($data['code']);
                    $data['reg_time'] = time();
                    $data['password'] = md5($data['password']);
                    if(M('Users')->save($data)){
                        session('user',null);
                        return apishow(1,'ok','恭喜注册成功',200);
                    }else{
                        session('user',null);
                        return apishow(0,'fail','注册失败',200);
                    }
                }
            // }
        }else{
            return apishow(0,'fail','验证码错误',200);
        }
    }

    /**
     * 用户登录操作
     */
    public function Login(){
        $data = ['mobile'=>input('mobile'),'password'=>md5(input('password'))];
        $res = M('Users')->where($data)->find();
        if(!empty($res)){
            Session::set('user',$res);
            return apishow(1,'ok','登录成功',200);
        }else{
            return apishow(0,'fail','账户或者密码填错啦',200);
        }
    }
    /**
     * 用户退出登录操作
     */
    public function Loginout(){
        session('user',null);
        return apishow(1,'ok','退出成功',200);
    }

    /**
     * 用户修改密码操作
     */
    public function EditPassword(){
        $data = input('post.');
        $validate = new uval();
        if(!$validate->scene('editpassword')->check($data)){
            return apishow(0,'fail',$validate->getError(),200);
        }
        $phone = Session::get('user');
        if(!empty($phone)){
            //这里判断验证码是否过期
            // if(time() - $phone['time'] > 60){
            //     Session::delete('user');
            //     return apishow(0,'fail','验证码错误',200);
            // }else{
                if($data['code'] != $phone['yzm']){
                    // Session::clear();
                    return apishow(0,'fail','验证码错误',200);
                }else{
                    unset($data['re_password']);
                    unset($data['code']);
                    $data['password'] = md5($data['password']);
                    if(M('Users')->where('user_id',$data['id'])->update(['password'=>$data['password']])){
                        session('user',null);
                        return apishow(1,'ok','恭喜修改密码成功',200);
                    }else{
                        session('user',null);
                        return apishow(0,'fail','修改密码失败,不能和上一个密码相同',200);
                    }
                }
            // }
        }else{
            return apishow(0,'fail','验证码错误',200);
        }
    }
}
