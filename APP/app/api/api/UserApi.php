<?php
namespace app\api\api;

use app\api\model\member;

class UserApi extends Base
{
    static $data = [];

    protected function _init()
    {
        self::$data = ['status' => 0, 'info' => "默认出错"];
        $this->model = new member();
    }

    /**
     * 获取用户信息
     * @param $uid
     * @bool $type+
     * @return mixed
     *created  by  "新&空"
     * @: xk@livexk.com
     */
    public function get_info($uid, $type = true, $field = true)
    {
        return $this->model->get_user_info($uid, $type, $field);
    }


    /**
     * 注册
     * @param $username  string 用户名
     * @param int $type 类型(1手机注册 2 qq)
     * @param array $user_data 用户信息(当为qq等注册时不能为空)
     * @return array   返回用户数据
     *created  by  "新&空"
     * @: xk@livexk.com
     */
    public function register($username, $type = 1, $openid)
    {
        if (IS_POST) {
            $data = $this->model->register($username, $type, $openid);
            if ($data['uid'] > 0) {
                self::$data['status'] = true;
                self::$data['exist'] = $data['exist'];
                self::$data['uid'] = $data['uid'];
                if(isset($_POST['c_id'])){
                    $this->model->save_cid(self::$data['uid'],$_POST['c_id']);
                }
                return self::$data;
            } else {
                $data['info'] = $this->model->getError();
                return self::$data;
            }
        }
    }

    /**
     * 关注 /取消关注
     * @param $uid
     * @param $v_uid
     * @param int $type
     * @return array
    create  新&空
     */
    public function follow($uid, $v_uid, $type = 1)
    {
        return $this->model->follow($uid, $v_uid, $type);
    }

    /**
     * 获取绑定信息
     * @param $uid
     * @return mixed
     */
    public function get_bind_info($uid){
        return $this->model->get_bind_info($uid);
    }

    /**
     * 关注,粉丝列表
     * @param $uid
     * @param $type
     * @param $p
     * @param $count
     */
    public function follow_list($uid, $type, $p = 1, $count = 10)
    {

        return $this->model->follow_list($uid, $type, $p, $count);
    }

    /**
     * 修改用户信息
     * @param $data
     * @param $uid
     * @return mixed
     *  Author:  新&空 <xk@livexk.com>
     */
    public function edit_user_field($data, $uid)
    {
        return $this->model->edit_info($data, $uid);
    }

    /**
     * 添加收藏
     * @param $id
     * @param $uid
     * @return mixed
     */
    public function add_collection($id, $uid)
    {
        return $this->model->add_collection($id, $uid);

    }

    /**取消收藏
     * @param $id
     * @param $uid
     * @return mixed
     */
    public function cancel_collection($id, $uid)
    {
        return $this->model->cancel_collection($id, $uid);
    }

    /**显示收藏
     * @param $uid
     * @param $p
     * @param $count
     * @return mixed
     */
    public function collection($uid, $p, $count)
    {
        return $this->model->collection($uid, $p, $count);
    }

    /**显示收藏
     * @param $uid
     * @param $v_uid
     * @return mixed
     */
    public function visit_user($uid, $v_uid)
    {
        return $this->model->visit_user($uid, $v_uid);
    }

    /**
     * 绑定账号
     */
    public function bind_member($uid, $openid, $type)
    {
        return $this->model->bind_member($uid, $openid, $type);
    }

}