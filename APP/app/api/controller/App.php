<?php
namespace app\api\controller;

use think\controller\Rest;

class App extends Rest
{

    protected $class;
    protected $action;

    public function _initialize()
    {
    }


    /**
     * 检测数据
     * @param $rules
     * @param $data
     * @return array
     */
    protected function is_empty($rules, $data = "")
    {
        $data = empty($data) ? $_POST : $data;

        foreach ($rules as $k => $v) {
            if (isset($v, $data)) {
                if (empty($data[$v]) || $data[$v] == "") {
                    $this->send( "[" . $v . "]参数不能为空",0);
                    return false;
                }
            } else {
                $this->send("[" . $v . "]键值不存在", 0);
                return false;
            }
        }
        return true;
    }

    public function fsockopen($data)
    {
        $data['md5'] = md5("md5");
        $post = http_build_query($data);
        $len = strlen($post);
        //发送
        $host = "api.livexk.com";
        $path = "/index.php";
        $fp = fsockopen($host, 80, $errno, $errstr, 30);
        if (!$fp) {
            return false;
        } else {
            stream_set_blocking($fp, 0);
            $out = "POST $path HTTP/1.1\r\n";
            $out .= "Host: $host\r\n";
            $out .= "Content-type: application/x-www-form-urlencoded\r\n";
            $out .= "Connection: Close\r\n";
            $out .= "Content-Length: $len\r\n";
            $out .= "\r\n";
            $out .= $post . "\r\n";
            fwrite($fp, $out);
            fclose($fp);
            return true;
        }
    }
}
