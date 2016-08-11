<?php
/**
 * Created by PhpStorm.
 * User: yunian
 * Date: 2016/3/31
 * Time: 11:19
 */

namespace app\api\controller;

use app\api\model\article;


class  Document extends App
{

    protected $model;

    /**
     * 构造函数初始化
     * Document constructor.
     * @param string $action
     */
    public function __construct($action)
    {
        $this->model = new article();
        // self::$model=new article();
        $this->$action();
    }


    /**
     * 文章首页
     *
     */
    protected function document()
    {
        $rules = ['p', 'count','category_id'];
        if (true == static::is_empty($rules)) {
            $data = $this->model->document(I('post.p'), I('post.count'), I('post.uid'),I('category_id'));
            $this->send($data["data"], $data['status']);
        }

    }



    /**
     * 文章详情页
     *
     */
    protected function document_details()
    {
        $rules = ['id'];
        if (true == static::is_empty($rules)) {

            $data = $this->model->details(I('post.id'), I('post.uid'));
            $this->send($data["data"], $data['status']);
        }
    }

    /**
     * 文章专题首页
     *
     */
    protected function document_project()
    {
        $rules = ['p', 'count'];
        if (true == static::is_empty($rules)) {
            $data = $this->model->document_project(I('post.p'), I('post.count'), I('post.uid'),I('cate_id'));
            $this->send($data["data"], $data['status']);
        }

    }


    /**
     * 文章专题详情页
     *
     */
    protected function document_project_details()
    {
        $rules = ['id'];
        if (true == static::is_empty($rules)) {

            $data = $this->model->project_details(I('post.id'), I('post.uid'));
            $this->send($data["data"], $data['status']);
        }
    }

    /**
     * 文章发表评论
     *
     */
    protected function push_document()
    {
        $rules = ['uid', 'content', 'art_id'];
        if (true == static::is_empty($rules)) {
            $data = $this->model->push_comment("document", "document_comment", I('post.uid'), I('post.picture'), I('post.content'), I('post.pid'), I('post.art_id'));
            // $this->send($data);
            if ($data == true) {
                $this->send($data);
            } else {
                $this->send("错误", 0);
            }
        }
    }


    /**
     * 文章显示评论
     *
     */
    protected function document_comment()
    {
        $rules = ['id'];
        if (true == static::is_empty($rules)) {
            $data = $this->model->article_comment("document_comment", I('post.id'), I('post.p'), I('post.count'), 'document');
            $this->send($data["data"], $data['status']);
        }
    }

    /**
     * 点赞数(文章)
     *
     */
    public function document_like()
    {
        $rules = ['id', 'uid'];
        if (true == static::is_empty($rules)) {
            $data = $this->model->like("document_like", I('post.id'), I('post.uid'), I('post.type'), "document");
            if ($data) {
                $this->send($data);
            } else {
                $this->send("错误", 0);
            }

        }
    }


    /**
     * 发评论(动态)
     *
     */
    public function push_circle()
    {
        $rules = ['uid', 'content', 'art_id'];
        if (true == static::is_empty($rules)) {
            $data = $this->model->push_comment("circle", "circle_comment", I('post.uid'), I('post.picture'), I('post.content'), I('post.pid'), I('post.art_id'));
            // $this->send($data);
            if ($data == true) {
                $this->send($data);
            } else {
                $this->send("错误", 0);
            }
        }
    }

    /**
     * 显示评论(动态)
     *
     */
    protected function circle_comment()
    {
        $rules = ['id'];
        if (true == static::is_empty($rules)) {
            $data = $this->model->article_comment("circle_comment", I('post.id'), I('post.p'), I('post.count'), 'circle');
            $this->send($data['data'], $data['status']);
        }
    }


    /**
     * 显示(动态)信息
     *
     */
    public function circle()
    {
        $rules = ['p', 'count'];
        if (true == static::is_empty($rules)) {
            $data = $this->model->circle('circle', I('post.p'), I('post.count'), I('post.uid'), 'circle_like');
            $this->send($data['data'], $data['status']);
        }
    }

    /**
     * 显示(动态)详细信息
     *
     */
    public function circle_details()
    {
        $rules = ['id'];
        if (true == static::is_empty($rules)) {
            $data = $this->model->post_details("circle", "circle_comment", I('post.id'), I('post.uid'), "circle_like");
            //   $data=M('circle')->select();
            $this->send($data['data'], $data['status']);
        }
    }

    /**
     * 点赞数(动态)
     *
     */
    public function circle_like()
    {
        $rules = ['id', 'uid'];
        if (true == static::is_empty($rules)) {
            $data = $this->model->like("circle_like", I('post.id'), I('post.uid'), I('post.type'), "circle");
            if ($data) {
                $this->send($data);
            } else {
                $this->send("错误", 0);
            }

        }
    }

    /**
     * 发帖子(动态)
     *
     */
    protected function circle_post()
    {
        $rules = ['uid', 'content', 'cate'];
        if (true == static::is_empty($rules)) {
            $data = $this->model->push_post("circle", I('post.uid'), I('post.content'), I('post.cate'));
            if ($data == true) {
                $this->send($data);
            } else {
                $this->send("错误", 0);
            }
        }
    }


    /**
     * 发评论(解惑)
     *
     */
    public function push_answer()
    {
        $rules = ['uid', 'content', 'art_id'];
        if (true == static::is_empty($rules)) {
            $data = $this->model->push_comment("circle", "circle_comment", I('post.uid'), I('post.picture'), I('post.content'), I('post.pid'), I('post.art_id'));
            if ($data == true) {
                $this->send($data);
            } else {
                $this->send("错误", 0);
            }

        }
    }

    /**
     * 发帖子(解惑)
     *
     */
    protected function answer_post()
    {
        $rules = ['uid', 'content', 'cate'];
        if (true == static::is_empty($rules)) {
            $data = $this->model->push_post("circle", I('post.uid'), I('post.content'), I('post.cate'));
            if ($data == true) {
                $this->send($data);
            } else {
                $this->send("错误", 0);
            }
        }
    }

    /**
     * 显示评论(解惑)
     *
     */
    protected function answer_comment()
    {
        $rules = ['id'];
        if (true == static::is_empty($rules)) {
            $data = $this->model->article_comment("circle_comment", I('post.id'), I('post.p'), I('post.count'), 'circle');
            $this->send($data['data'], $data['status']);
        }
    }


    /**
     * 显示(解惑)信息
     *
     */
    public function answer()
    {
        $rules = ['p', 'count'];
        if (true == static::is_empty($rules)) {
            $data = $this->model->answer("circle", I('post.p'), I('post.count'), I('post.uid'), I('post.type'), 'circle_like');
            $this->send($data['data'], $data['status']);
        }
    }

    /**
     * 显示(解惑)详细信息
     *
     */
    public function answer_details()
    {
        $rules = ['id'];
        if (true == static::is_empty($rules)) {
            $data = $this->model->post_details("circle", "circle_comment", I('post.id'), I('post.uid'), "circle_like");
            $this->send($data['data'], $data['status']);
        }
    }

    /**
     * 点赞数(解惑)
     *
     */
    public function answer_like()
    {
        $rules = ['id', 'uid'];
        if (true == static::is_empty($rules)) {
            $data = $this->model->like("circle_like", I('post.id'), I('post.uid'), I('post.type'), "circle");
            if ($data) {
                $this->send($data);
            } else {
                $this->send("错误", 0);
            }
        }
    }

    /**
     *接受c_id
     */
    public function get_c_id(){
        $rules = ['uid','c_id'];
        if (true == static::is_empty($rules)) {
            $data = $this->model->get_c_id(I('post.uid'), I('post.c_id'));
            if ($data) {
                $this->send("添加成功");
            }else {
                $this->send("错误", 0);
            }
        }
    }

    /**
     *个人显示
     */
    public function user_post()
    {
        $rules = ['uid', 'p', 'count'];
        if (true == static::is_empty($rules)) {
            $data = $this->model->user_post(I('post.uid'), I('post.p'), I('post.count'));
            $this->send($data['data'], $data['status']);
        }
    }

    /**
     *查看别人个人显示
     */
    public function v_user_post()
    {
        $rules = ['uid', 'p', 'count'];
        if (true == static::is_empty($rules)) {
            $data = $this->model->v_user_post(I('post.uid'), I('post.p'), I('post.count'));
            $this->send($data['data'], $data['status']);
        }
    }


    /**
     * 搜索文章标题
     */
    public function document_search()
    {
        $rules = ['uid', 'title'];
        if (true == static::is_empty($rules)) {
            $data = $this->model->document_search(I('post.uid'), I('post.title'), I('post.p'), I('post.count'));
            $this->send($data['data'], $data['status']);
        }
    }


    /**
     * 显示举报
     *
     */
    public function report()
    {
        $data = $this->model->report();
        $this->send($data['data'], $data['status']);
    }

    /**
     * 接收举报
     *
     */
    public function push_report()
    {
        $rules = ['uid','v_uid','report_id','content_id', 'type'];
        if (true == static::is_empty($rules)) {
            $data = $this->model->push_report(I('post.uid'),I('post.v_uid'),I('post.report_id'),I('post.content_id'), I('post.type'));
            if ($data == true) {
                $this->send("举报成功");
            } else {
                $this->send("错误", 0);
            }
        }
    }


}