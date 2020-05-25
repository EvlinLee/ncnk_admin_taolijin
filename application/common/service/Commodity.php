<?php

namespace app\common\service;
use app\common\model\Goods as GoodsModel;
use app\common\util\ReturnCode;
use app\common\util\ReturnDesc;

class Commodity
{
    /**
     * 商品定时入库
     * @param array $data
     * @return \think\response\Json
     * @throws \Exception
     */
    public function commodityStorage($data=[]){
        if (!is_array($data) || empty($data)){
            return json(["code"=>ReturnCode::ERROR, "msg"=>ReturnDesc::TAOTAOKE_REQUEST_DATA]);
        }
        $list_goods = $this->checkGoods();
        $list = [];
        $status = 1;
        $create_time = date("Y-m-d H:i:s");
        foreach ($data as $k=>$v){
            if (in_array($v["goodsId"], $list_goods)) continue;
            if ($v["couponReceiveNum"] == $v["couponTotalNum"]) continue;
//            $list[$k]["id"] = randomString(8);
            $list[$k]["goodsid"] = $v["goodsId"];
            $list[$k]["dtkgoodsid"] = $v["id"];
            $list[$k]["dtitle"] = $v["dtitle"];
            $list[$k]["title"] = $v["title"];
            $list[$k]["desc"] = $v["desc"];
            $list[$k]["main_pic"] = $v["mainPic"];
            $list[$k]["imgs"] = $v["imgs"];
            $list[$k]["original_price"] = $v["originalPrice"];
            $list[$k]["actual_price"] = $v["actualPrice"];
            $list[$k]["coupon_price"] = $v["couponPrice"];
            $list[$k]["coupon_conditions"] = $v["couponConditions"];
            $list[$k]["coupon_link"] = $v["couponLink"];
            $list[$k]["commission_type"] = $v["commissionType"];
            $list[$k]["commission_rate"] = $v["commissionRate"];
            $list[$k]["yunfeixian"] = $v["yunfeixian"];
            $list[$k]["status"] = $status;
            $list[$k]["create_time"] = $create_time;
        }
        // 商品入库
        $goods = new GoodsModel();
        $ret_save = $goods->saveAll($list, false);
        if($ret_save){
            return json(["code"=>ReturnCode::SUCCESS, "msg"=>"入库成功"]);
        }else{
            return json(["code"=>ReturnCode::ERROR, "msg"=>"入库失败"]);
        }
    }

    /**
     * 获取当前商品列表
     * @return array
     */
    public function checkGoods(){
        $goods = new GoodsModel();
        $list = $goods->column("goodsid");
        if (!$list) return [];
        return $list;
    }
}