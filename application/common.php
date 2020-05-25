<?php
use Curl\Curl;
// 应用公共文件

function httpsRequest($url,$data=[],$headers=[],$type="get")
{
    $curl = new Curl();
    $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false); // 规避SSL验证
    //$curl->setOpt(CURLOPT_SSL_VERIFYHOST, false); // 跳过HOST验证
    // 判断是否设置header
    if ($headers){
        foreach ($headers as $k=>$v){
            $curl->setHeader($v["key"],$v["value"]); // 设置header
        }
    }
    // 判断请求的类型
    switch ($type){
        case "get":
            $curl->get($url,$data);
            break;
        case "post":
            $curl->post($url,$data);
            break;
    }
    // 检测是否请求成功
    if ($curl->error){
        return json_encode(["code"=>$curl->errorCode, "msg"=>$curl->errorMessage]);
    }
    $res = json_decode(json_encode($curl->response), true);
    return json_encode(["code"=>1, "msg"=>"请求成功", "data"=>$res]);
}

function makeId($length, $time = true, $char = false)
{
    if ($time) {
        return time() . randomString($length, $char);
    } else {
        return randomString($length, $char);
    }
}
function randomString($length = 32, $char = false)
{
    if ($char) {
        $str = "a0b1c2d3eZ4YfX5WgV6UhT7SiR8QjP9NkMzLlKymJxInHwGpFvEqDuCrByAs";
    } else {
        $str = "0123456789";
    }
    $result = "";
    for ($i = 0; $i < $length; $i++) {
        $result .= $str[mt_rand(0, strlen($str) - 1)];
    }
    return $result;
}