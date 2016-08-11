<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/9
 * Time: 13:28
 */
namespace Admin\Controller;
class PictureController extends AdminController
{
    public function index()
    {
        $picture = M("picture");
        $res = $this->lists($picture, '', "create_time desc", "", 30);
        $this->list = $res;
        $this->meta_title = "图片管理";
        $this->display();
    }

    public function del($id = '')
    {
        $type=I('request.type');
     //   print_r($type);exit;
        if (empty($id)) {
            $this->error("请选择要删除的数据");
        }
        $picture = M("picture");
        $res = $picture->find($id);
        if (empty($res)) {
            $this->error("图片不存在");
        } else {
           /* switch($type){
                case 1;

                    break;
            }*/
            $count =M("document_project_category")->where(array("cover_id" => $id))->count();
            if ($count > 0 ) {
                $this->error("图片被引用,不能删除");
            } else {
                $file = $_SERVER['DOCUMENT_ROOT'] . __ROOT__ . $res['path'];
                @unlink($file); //删除源文件
                $picture->where(array("id" => $id))->delete();
                $this->success("操作成功~");
            }
        }
    }

    public function clear()
    {
        $url = $_SERVER['SERVER_NAME'];
        if($url !== "120.25.226.231"){
            $this->error("当前环境不能操作!");
        }
        $picture = M("picture");
        $res = $picture->select();
        foreach ($res as $k => $v) {
            $file = $_SERVER['DOCUMENT_ROOT'] . __ROOT__ . $v['path'];
            if (!file_exists($file)) {
                M("picture")->where(array("id" => $res[$k]['id']))->delete();
                unset($res[$k]);
            }
        }

        $this->success("操作成功~");
    }

}