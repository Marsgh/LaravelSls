<?php
/**
 * Created by PhpStorm.
 * User: lilp08
 * Date: 2018/11/6
 * Time: 13:56
 */
namespace AliYunSls\Facades;

use Illuminate\Support\Facades\Facade;

class AliYunSls extends  Facade{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'aliyun.sls';
    }

}