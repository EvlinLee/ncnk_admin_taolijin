<?php


namespace app\admin\controller;
use app\common\util\ReturnCode;
use app\common\model\Deduct as DeductModel;

//抵扣比例
class Deduct extends Base
{
    // 抵扣比例页面
    public function index(){
        $uid = $this->userInfo["id"];
        $deduct = new DeductModel();
        $dataObj = $deduct->where("uid", $uid)->find();
        $data = $dataObj->toArray();
        $this->setData("data", $data);
        return view("index", $this->data);
    }

    // 修改抵扣比例
    public function setDeduct(){
        $uid = $this->userInfo["id"];
        $proportion = $this->request->post("proportion");
        $deduct = new DeductModel();
        $dataObj = $deduct->where("uid", $uid)->find();
        if (!$dataObj){
            return json(["code"=>"-1", "msg"=>"抵扣比例获取失败"]);
        }
        $dataObj->proportion = $proportion;
        $save = $dataObj->save();
        if (!$save) return $this->buildFailed(ReturnCode::ERROR, "修改失败");
        return $this->buildSuccess();
    }
}