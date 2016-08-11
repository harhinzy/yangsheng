<?php
/**
 * Created by PhpStorm.
 * User: ys
 * Date: 16-3-23
 * Time: 下午5:02
 */

namespace app\api\controller;


use think\controller\Rest;

class Api extends Rest
{
    protected static $class;
    protected static $action;


    /**
     * Api constructor.
     */
    public function __construct()
    {
        parent::__construct();
        self::$action = [

            'Document' => ['document','document_details','document_project','document_project_details'],

        ];
    }


    /**统一接口调用
     * @param string $action 接口名
     */
    public function index($action = "")
    {
     //   echo 1;exit;
      /*  $data=M('member')->select();
        print_r($data);exit;*/

        if ($this->_method !== "post") {
            $this->send("只接收[post]参数", 0);
            return;
        }
        if (empty($action)) {
            $this->send("请求参数 [action]参数不能为空", 0);
            return;
        }

        foreach (self::$action as $k => $v) {
            if (in_array($action, $v)) {
                $this->new_data($k, $action);
                return;
            }
        }
        $this->send("请求参数 [" . $action . "] 接口不存在", 0);
    }


    /**
     * 实例化类
     * @param $k  类名
     * @param $action  方法名
     */
    protected static function new_data($k, $action)
    {
        switch ($k) {
            case  "User";
                self::$class = New User($action);
                break;
            case  "Base";
                self::$class = New Base($action);
                break;
            case  "Document";
                self::$class = New Document($action);
                break;
            case  "Push";
                self::$class = New Push($action);
                break;
        }
    }
}

