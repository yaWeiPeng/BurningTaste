<?php
namespace app\common\exception;

use think\exception\Handle;

class ApiHandle extends Handle{
    public $httpCode = 500;

    public function Handle(\Exception $e){
        return apishow(0 , $e->getMessage() , [] , $this->httpCode);
    }
}