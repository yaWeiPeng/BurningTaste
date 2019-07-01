<?php
namespace app\common\lib;

class IAuth{
    public static function setSign($data=[]){
        ksort($data);
    }
}