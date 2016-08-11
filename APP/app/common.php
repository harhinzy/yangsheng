<?php
/**
 * Created by PhpStorm.
 * User: ys
 * Date: 16-3-22
 * Time: 下午12:29
 */

function check_mobile($mobile, $verify)
{
    $tem = S($mobile);
    if (!empty($tem) && $tem == $verify) {
        return true;
    }
    return false;
}

/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @return mixed
 */
function get_client_ip($type = 0)
{
    $type = $type ? 1 : 0;
    static $ip = NULL;
    if ($ip !== NULL) return $ip[$type];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos = array_search('unknown', $arr);
        if (false !== $pos) unset($arr[$pos]);
        $ip = trim($arr[0]);
    } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u", ip2long($ip));
    $ip = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}

/**
 * 获取帖子图片
 * @param int $id
 * @param string $field
 * @return 完整的数据  或者  指定的$field字段值
 * @author yunian
 */
function get_post($id)
{
    if (empty($id)) {
        return null;
    }
    $picture = M('picture')->field('path,height,width')->where(array('status' => 1))->getById($id);
    /* if($field == 'path'){
         if(!empty($picture['url'])){
             $picture['path'] = $picture['url'];
         }else{
             $picture['path'] = __ROOT__.$picture['path'];
         }
     }*/
    return empty($field) ? $picture : $picture[$field];
}

/**
 * 分割图片
 * @param int $arr
 * @param string $img_id
 * @return 完整的数据  或者  指定的$field字段值
 * @author yunian
 */
function arr_to_str($arr, $img_id)
{
    $str = explode($arr, $img_id);
    $count = count($str);
    if (empty($str[$count - 1])) {
        unset($str[$count - 1]);
    }
    return $str;

}

/**
 * @param 下载头像
 * @param string $url
 * @param string $filename
 * @return bool|string
 */
function down_img($url = "", $filename = "")
{
    if ($url == '' || $filename == "") {
        return false;
    }
    //文件保存路径
    $ch = curl_init();
    $timeout = 15;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $img = curl_exec($ch);
    curl_close($ch);
//    $size = strlen($img);
    //文件大小
    $fp2 = @fopen($filename, 'a');
    fwrite($fp2, $img);
    fclose($fp2);
    return substr($filename, 1);
}

/**
 * @ 生成二维码
 * @param $data
 * @param $size
 * @param string $error
 * @return string
create  新&空
 */
function crate_qr($data, $size, $error = "L")
{
    return \QRcode::png($data, "base64", $error, $size, 2);
}

/**
 * @param $str
 * @return bool
 *  Author:  新&空 <xk@livexk.com>
 */
function is_json($str)
{
    return is_null(json_decode($str));
}

/**
 * 扫码登陆
 * @param $host
 * @param $port
 * @param $str
 * @param int $back
 * @return bool
 */
function sendSocketMsg($host, $port, $str, $back = 1)
{
    $socket = socket_create(AF_INET, SOCK_STREAM, 0);
    if ($socket < 0) return false;
    $result = @socket_connect($socket, $host, $port);
    if ($result == false) return false;

    socket_write($socket, $str, strlen($str));
    if ($back != 0) {
        return socket_read($socket, 1024);
    }
    socket_close($socket);
}

function get_user_info($uid, $field = true)
{
    $m = new \app\api\model\member();
    return $m->get_user_info($uid, $type = true, $field);
}

//获取链接
function get_url($id)
{
    return "http://yangsheng.lizardmind.com?id=".$id;
}

//获取链接
function get_urlzt($id)
{
    return "http://yangsheng.lizardmind.com/index.php?s=/home/index/indexzt/id/".$id;

}


//获取文章分享链接
function get_share_url($id)
{
    return "http://api.admin.livexk.com/index.php?s=/home/index/share/id/".$id;
}


