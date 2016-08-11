<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id$

return [
    'url_route_on' => true,
    'log'=>[
        'type'=>'file',
        'path'=> LOG_PATH,
    ],
    'default_module'        => 'api',
    'default_controller'     => 'api',
    'empty_controller'       => 'register',
    'show_error_msg'        =>  true,    // 显示错误信息
    'WEB_URL'               =>'http://api.admin.livexk.com',

    "default_json_error"=>['error'=>"请求出错,稍后再试","status"=>0],

    // 默认输出类型
//    'default_return_type'    => 'json',
];
