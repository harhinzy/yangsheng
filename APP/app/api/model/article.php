<?php
/**
 * Created by PhpStorm.
 * User: yunian
 * Date: 2016/4/5
 * Time: 14:13
 */
namespace app\api\model;

use app\api\controller\Localcity;
use app\api\controller\Message;
use app\api\controller\Push;
use think\Model;


class article extends Model
{

    protected $tableName = "document";

    private $res = ['status' => 0, 'data' => []];


    /**
     * 获取文章首页
     * @param int $p
     * @param int $count
     * @param int $uid
     * @param string $model
     * @return mixed
     */
    public function document($p = 1, $count = 10, $uid, $category)
    {
        $map=['category_id'=>$category];

        if($category==40){
            $field = 'id,title,create_time';
            $data=$this->category($map,$field,$p);
            print_r($data);exit;
        }else {
            $field = 'id,title,view,cover_id,description,like_num,create_time';
            $data = $this->where($map)->field($field)->page($p, $count)->order('create_time desc')->select();

        }
        if (empty($data)) {
            $this->res['data'] = "没有数据了";
        } else {
            $data = $this->document_each($data, $uid,'document_like');
            $this->res['status'] = 1;
            $this->res['data'] = $data;
        }
        return $this->res;

    }


    private function category($map,$field,$p){

        $data = $this->where($map)->field($field)->page($p, 10)->order('create_time desc')->select();
        for ($row = 0; $row <  5; $row++) {

            for ($col = 0; $col <  5; $col++) {
                echo $data[$row][$col];
            }
        }
        exit;
        return $data;
    }





    /**文章图片
     * @param $data
     * @param $uid
     * @return mixed
     */
    protected function document_each($data, $uid,$model)
    {

        foreach ($data as $k => $v) {
            //看登录人是否喜欢该贴
            $data[$k]['is_like'] = $this->check_like($uid, $v['id'],$model);
         //   $data[$k]['share']=get_share_url($v['id']);
            //如果有封面图片信息
            if($v['cover_id']){
                $data[$k]['img'] = get_post($v['cover_id']);
            }
            //销毁图片id
            unset($data[$k]['cover_id']);
        }
        return $data;
    }

    /**
     * 获取文章详情
     * @param int $id
     * @param int $uid
     * @return mixed
     */
    public function details($id, $uid)
    {
        $map = ['id' => $id];
        $data = $this->field('id,comment')->where($map)->find();
        if (empty($data)) {
            $this->res['data'] = "没有数据了";
        } else {

            $data['content']=get_url($id);
            $data['is_like'] = $this->check_like($uid, $id,'document_like');
       //     $data['share']=get_share_url($id);

            $this->res['data'] = $data;
            $this->res['status'] = 1;
        }
        /* 更新浏览数 */
        $this->where($map)->setInc('view');
        return $this->res;
    }


    /**获取文章专题首页
     * @param int $p
     * @param int $count
     * @param $uid
     * @param $cate_id
     * @return array
     */
    public function document_project($p = 1, $count = 10, $uid, $cate_id)
    {
        $article=M('document_project');
        $category=M('document_project_category');

        if($cate_id>0){
            $map=['category_id'=>$cate_id];
            $field = 'id,title,cover_id,view,like_num,create_time';

            $data = $article->where($map)->field($field)->page($p, $count)->order('create_time desc')->select();
         //   print_r($data);exit;
            foreach($data as $key=>$val){
                $data[$key]['img']=get_post($val['cover_id']);
                unset($data[$key]['cover_id']);
            }

            //增加浏览数
            $category->where(['id'=>$cate_id])->setInc('view');
        }else{
            $data=$category->field('id,title,view,like_num,pro_img')->page($p, $count)->select();
            foreach($data as $key=>$val){
                $data[$key]['img']=get_post($val['pro_img']);
                unset($data[$key]['pro_img']);
            }
        }

        if (empty($data)) {
            $this->res['data'] = "没有数据了";
        } else {

            $this->res['status'] = 1;
            $this->res['data'] = $data;
        }
        return $this->res;

    }

    /**
     * 获取文章专题详情
     * @param int $id
     * @param int $uid
     * @return mixed
     */
    public function project_details($id, $uid)
    {
        $article=M('document_project');
        $map = ['id' => $id];
        $data = $article->field('id,category_id,comment')->where($map)->find();
        if (empty($data)) {
            $this->res['data'] = "没有数据了";
        } else {

            $data['content']=get_urlzt($id);
            $data['is_like'] = $this->check_like($uid, $id,'document_like');
            //     $data['share']=get_share_url($id);

            $this->res['data'] = $data;
            $this->res['status'] = 1;
        }
        /* 更新浏览数 */
        $article->where($map)->setInc('view');
        M('document_project_category')->where(['id'=>$data['category_id']])->setInc('view');
        unset($data['category_id']);
        return $this->res;
    }



    /**
     * 看登录人是否喜欢该贴
     * @param $uid
     * @param $post_id
     * @param $table
     * @return array|mixed
     */
    private function check_like($uid, $post_id, $table='')
    {
        if (empty($uid) || empty($post_id)) {
            return 0;
        }
        $map = ['uid' => $uid, 'art_id' => $post_id];

        return M($table)->where($map)->count() > 0 ? 1 : 0;
    }



}