<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Author: IT宇宙人
 * Date: 2015-09-09
 */
namespace app\common\model;

use think\Db;
use think\Model;

class AccountLog extends Model {
    

    define("SIGN_POINT",'签到奖励');
    define("PAY_POINT",'消费抵扣');
    define("ORDER_POINT",'订单奖励');

    protected $table = 'account_log';


    /**
     * 积分增加
     */
    public function increase_integral($user_id , $pay_points , $desc){
        $pay_points = '+'.$pay_points;
        $data = ['user_id'=>$user_id,'pay_points'=>$pay_points,'desc'=>$desc,'change_time'=>time()];
        $this->save($data);
    }

    /**
     * 积分减少
     */
    public function reduce_integral($user_id , $pay_points , $desc){

    }

}
