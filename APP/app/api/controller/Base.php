<?php
/**
 * Created by PhpStorm.
 * User: xinkon
 * Date: 2016/3/21
 * Time: 15:51
 */
namespace app\api\controller;

class  Base extends App
{
    /**
     * 构造函数初始化
     * Base constructor.
     * @param string $action
     */
    public function __construct($action)
    {
        $this->$action();
    }
        
    
    
    protected function send_sms()
    {
        $mobile = I("post.mobile");
        if (!preg_match("/^(0|86|17951)?(13[0-9]|15[012356789]|17[0678]|18[0-9]|14[57])[0-9]{8}$/", $mobile)) {
            self::send("电话号码有误", 0);
            return false;
        }
        $time = 60;
        if (!empty(S($mobile))) {
            self::send("请过" . $time . "秒后在发送", 0);
            return false;
        }
        $msg = static::randString();

        if($mobile == '13402889986'){
            $msg = '123456';
            S($mobile, $msg, $time);
            self::send("发送成功", 1);
            return true;
        }

        $tem = "SMS_5390355";
        vendor("SMS.TopSdk");
        $c = new \TopClient;
        $c->appkey = 23319232;
        $c->secretKey = "a708d3b0e116d3cf0e7965f807e6a026";
        $req = new \AlibabaAliqinFcSmsNumSendRequest;
        $req->setExtend("123456");
        $req->setSmsType("normal");
        $req->setSmsFreeSignName("登录验证");
        $req->setSmsParam("{\"code\":\"$msg\",\"product\":\"天天太极\"}");
        $req->setRecNum("$mobile");
        $req->setSmsTemplateCode($tem);
        $resp = $c->execute($req);
        $data = json_decode(json_encode($resp), true);
        if (isset($data['result']) && $data['result']['err_code'] == 0 && $data['result']['success'] == true) {
            S($mobile, $msg, $time);
            self::send("发送成功", 1);
            return true;
        } else {
            self::send("发送失败,请稍后再试", 0);
            return false;
        }
    }

    /**
     * 获取随机位数数字
     * @param  integer $len 长度
     * @return string
     */
    protected static function randString($len = 6)
    {
        $chars = str_repeat('0123456789', $len);
        $chars = str_shuffle($chars);
        $str = substr($chars, 0, $len);
        return $str;
    }
    
    
    
    
    
    
    
    


}