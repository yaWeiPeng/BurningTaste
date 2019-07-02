<?php

namespace app\api\controller\v1;

use think\Controller;
use think\Db;

class SingIn extends Base
{
    /**
     * 签到查询
     */
    public function SignIn(){
        $data = ['']
        $res = Db::name('account_log')->where('desc','签到奖励')->select();
        return apishow('1','ok',$res,200);
    }
    /**
     * 签到奖励
     */
}
