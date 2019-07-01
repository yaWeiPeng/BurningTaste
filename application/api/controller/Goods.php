<?php

namespace app\api\controller;

use think\Controller;
use think\Db;
use think\Session;

class Goods extends Base
{
    /**
     * 商品列表
     */
    public function goodsList(){
        $goodsList = M('Goods')->select();
        return apishow(1,'ok',$goodsList,200);
    }
    
    /**
     * 商品详情
     */
    public function goodsInfo(){
        $goods_id = input('id');
        $goods_info = M('Goods')->where('goods_id', $goods_id)->find(); //商品详情
        $goods_info['comment'] = Db::name('comment')->where('goods_id', $goods_id)->select(); //评论
        if(!empty(session('user'))){
            $user_id = session::get('user.user_id');
            $collect = Db::name('goods_collect')->where(['user_id'=>$user_id,'goods_id'=>$goods_id])->find();
            if(!empty($collect)){
                $goods_info['collect'] = 1;
            }else{
                $goods_info['collect'] = 0;
            }
        }else{
            $goods_info['collect'] = 0;
        }
        return apishow(1,'ok',$goods_info,200);
    }
}
