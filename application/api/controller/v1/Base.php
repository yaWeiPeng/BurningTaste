<?php

namespace app\api\controller\v1;

use think\Controller;
use app\common\exception\ApiException;
use think\Session;

class Base extends Controller
{
    public function _initialize(){
        // $this->checkRequestAuth();
    }

    public function checkRequestAuth(){
        $headers = request()->header();
        if(empty($headers['sign'])){
            echo json_encode(['status'=>0,'message'=>'sign不存在','data'=>[]]);exit;
        }
        ksort($headers);
        $res = encrypt(http_build_query($headers));
        halt($res);
    }
}
