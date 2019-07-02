<?php
namespace app\common\yzm;

use think\Session;
use app\common\yzm\Ucpaas;

class Yzx{
    public function seed($phone){
        //初始化必填
        //填写在开发者控制台首页上的Account Sid
        $options['accountsid']='e4c725f7d7112163550968a6382b010e';
        //填写在开发者控制台首页上的Auth Token
        $options['token']='7501edddf7d247f36530e8c69a999157';

        //初始化 $options必填
        $ucpass = new Ucpaas($options);
        $appid = "1c5ab5f19402425b8f2e73eca358ec34";    //应用的ID，可在开发者控制台内的短信产品下查看
        $templateid = "481049";    //可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
        $param = rand(100000,999999); //多个参数使用英文逗号隔开（如：param=“a如：param=“a,b,c”），如为参数则留空
        $data = ['yzm'=>$param,'time'=>time()];
        Session::set($phone,$data);
        $mobile = $phone;
        $uid = "";

        //70字内（含70字）计一条，超过70字，按67字/条计费，超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。

        echo $ucpass->SendSms($appid,$templateid,$param,$mobile,$uid);   
    }
}
        