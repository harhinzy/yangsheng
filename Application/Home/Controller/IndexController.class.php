<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends HomeController {

	//系统首页
    public function index(){
        $id=I('get.id');
        $type=I('get.type');
     //    $data['contentzt']=M('document_project')->where(['id'=>$id])->getField('content');
         $data['content']=M('document_article')->where(['id'=>$id])->getField('content');

        $this->assign('data',$data);
        $this->display();
    }

    //文章专题
    public function indexzt(){
        $id=I('get.id');
         $data['content']=M('document_project')->where(['id'=>$id])->getField('content');
        $this->assign('data',$data);
        $this->display();
    }

}