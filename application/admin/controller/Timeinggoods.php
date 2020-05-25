<?php


namespace app\admin\controller;
use app\common\model\Goods as GoodsModel;
use app\common\service\Commodity;
use app\common\util\ReturnCode;
use app\common\util\ReturnDesc;
use dataoke\CheckSign;

class Timeinggoods
{
    /**
     * 商品入库
     */
    public function dataokeGoods(){
        $dataoke = config("dataoke.");
        $c = new CheckSign;
        $c->host = 'https://openapi.dataoke.com/api/goods/get-ranking-list'; // 接口地址 必填
        $c->appKey = $dataoke["APP_KEY"];
        $c->appSecret = $dataoke["APP_SECRET"];
        $c->version = 'v1.1.2'; // 版本号 必填
        // 请求参数
        $params = array();
        $params['rankType'] = 1; // 实时榜
        $request = $c->request($params);
        $res = json_decode($request, true);
        if ($res["code"]!=0 && $res["msg"]!="成功") {
            return json(["code"=>ReturnCode::ERROR, "msg"=>ReturnDesc::TAOTAOKE_REQUEST_API, "res"=>$res]);
        }
        $commodity = new Commodity();
        $res = $commodity->commodityStorage($res["data"]);
        return $res;
    }

    /**
     * 清空商品库
     */
    public function emptyGoods(){
        $time = strtotime("-1 day");
        $start_data = date("Y-m-d 00:00:00", $time);
        $end_data = date("Y-m-d 23:59:59", $time);
        $goods = new GoodsModel();
        $goods->whereBetweenTime("create_time", $start_data, $end_data)->delete();

        return json(["code"=>ReturnCode::SUCCESS, "msg"=>"清除成功"]);
    }

}