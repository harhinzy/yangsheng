<?php
/**
 * Created by PhpStorm.
 * User: xinkon
 * Date: 2016/3/21
 * Time: 14:23
 */
namespace app\api\api;

abstract class  Base
{
    protected $model;

    public function __construct()
    {
        $this->_init();
    }

    abstract protected function _init();
}