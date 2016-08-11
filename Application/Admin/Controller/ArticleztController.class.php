<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Admin\Model\AuthGroupModel;
use Think\Page;

/**
 * 后台内容控制器
 * @author huajie <banhuajie@163.com>
 */
class ArticleztController extends AdminController {

    public $model = "post_category_content";
    private $model_id = 21;

    public function _initialize()
    {
        parent::_initialize();

    }

    public function index(){

            $map['id'] = array("neq", 0);
            $cate_content_data = M("document_project_category");
            $cate_content_data = $this->lists($cate_content_data, $map, 'create_time desc', '', '');
      //  print_r($data);exit;

          /*  foreach ($cate_content_data as $key => $val) {
                $cate_content_data[$key]['img'] = get_post($val['fit_img']);
            }*/

            $this->cate_content_data = $cate_content_data;
            $this->meta_title = '文章专题';
            $this->display();
    }


    //添加专题分类
    public function cate_add()
    {

        if (IS_POST) {
            if (empty($_POST['title'])) {
                $this->error("标题不能为空");
            }
            if (empty($_POST['pro_img'])) {
                $this->error("图片不能为空");
            }
            $document = D("document_project_category");
            $_POST['uid'] = UID;
            $_POST['create_time'] = time();
            if ($document->create() && $document->add()) {
                $this->success("添加成功", U('Articlezt/index'));
            } else {
                $this->error($document->getError());
            }
        } else {
            $this->meta_title = "增加分类";
            $this->display();
        }
    }

    //编辑专题分类
    public function cate_edit(){
        $id=I('request.ids');
      //  echo $id;
        $model=D('document_project_category');
        $map=['id'=>$id];
        if(IS_POST){
            if($model->where($map)->save()){
                $this->success('更新成功','Articlezt/index');
            }else{
                $this->error($model->getError());
            }
        }else{
            $data=M('document_project_category')->where($map)->find();
            $this->data = $data;
            $this->meta_title = "增加分类";
            $this->display();
        }

    }

    //删除 文章专题分类
    public function cate_del(){

        $ids = array_unique((array)I('ids', 0));

        if (empty($ids)) {
            $this->error('请选择要操作的数据!');
        }else{
            $model=D('document_project_category');
         //   $map=array('in',$ids);
            $map = array('id' => array('in', $ids));
            if ($model->where($map)->delete()) {
                $this->success('删除成功');
            } else {
                $this->error('删除失败！');
            }
        }
    }

    //文章专题禁用
    public function cate_setStatus(){
        $id=I('request.ids');
        $status=I('request.status');
        $map=['id'=>$id];
        switch($status){
            case 1;
                $data=['status'=>1];
                break;
            case 0;
                $data=['status'=>0];
                break;
            case -1;
                $data=['status'=>-1];
                break;
            default:
                $this->error('参数错误');
        }
        $i=M('document_project_category')->where($map)->save($data);
        if($i>0){
            $this->ajaxReturn(array('status' => 1, 'info' => '操作成功!!'));
        }else{
            $this->ajaxReturn(array('status' => 0, 'info' => '操作失败!!'));
        }
    }



    public function indexzt($title=''){
        if (isset($title)) {
            $map['title'] = array("like", "%$title%");
        }
        $id=I('request.id');
        $map['id'] = array("neq", 0);
        $map['category_id'] = array("eq", $id);
        $cate_content_data = M("document_project");
        $cate_content_data = $this->lists($cate_content_data, $map, 'create_time desc', '', '');
        //  print_r($data);exit;

        /*  foreach ($cate_content_data as $key => $val) {
              $cate_content_data[$key]['img'] = get_post($val['fit_img']);
          }*/
        $this->cate_content_data = $cate_content_data;
        $this->meta_title = '文章专题';
        $this->display();
    }


    //添加
    public function add()
    {
        $head=I('get.head');
        if (IS_POST) {
            if (empty($_POST['title'])) {
                $this->error("标题不能为空");
            }
            if (empty($_POST['cover_id'])) {
                $this->error("图片不能为空");
            }
            $document=D("document_project");

            $_POST['uid'] = UID;
            $_POST['create_time'] = time();
            if ($document->create() && $document->add()) {

                $this->success("添加成功", U('Articlezt/indexzt?id='.$_POST['category_id'].'&head='.$head));
            } else {
                $this->error($document->getError());
            }
        } else {
            $this->meta_title = "增加文章";
            $this->display();
        }
    }


    //编辑
    public function edit(){
        $id=I('request.ids');
       // print_r($id);exit;
        $map=['id'=>$id];
        $table="document_project";
        if(IS_POST){

            if(D($table)->where($map)->save()){
                $this->success('更新成功');
            }else{
                $this->error(D($table)->getError());
            }

        }else{
            $data=M($table)->where($map)->find();
            $this->data=$data;
            $this->meta_title="编辑文章";
            $this->display();
        }
    }

    //删除
    public function del(){
        $id=array_unique(I('ids'),0);
        $map['id']=array('in',$id);
        $model=D('document_project');
        if($model->where($map)->delete()){
            $this->success('删除成功');
        }else{
            $this->error($model->getError());
        }
    }


    //文章禁用
    public function setStatus(){
        $id=I('request.ids');
        $status=I('request.status');
        $map=['id'=>$id];
        switch($status){
            case 1;
                $data=['status'=>1];
                break;
            case 0;
                $data=['status'=>0];
                break;
            case -1;
                $data=['status'=>-1];
                break;
            default:
                $this->error('参数错误');
        }
        $i=M('document_project')->where($map)->save($data);
        if($i>0){
            $this->ajaxReturn(array('status' => 1, 'info' => '操作成功!!'));
        }else{
            $this->ajaxReturn(array('status' => 0, 'info' => '操作失败!!'));
        }
    }



}