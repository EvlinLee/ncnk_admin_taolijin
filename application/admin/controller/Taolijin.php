<?php


namespace app\admin\controller;
use app\common\model\Tbgift as TbgiftModel;

class Taolijin extends Base
{
    public function index(){
        return view("index");
    }
    public function tableTaolijin(){
        $where = [
            "uid"=>["=", $this->userInfo["id"]],
        ];
        $type = $this->request->param("type");
        $value = $this->request->param("value");
        if ($type && $value){
            $where[$type] = ["like", "%". $value ."%"];
        }
        $page = $this->request->param("page", 1);
        $limit = $this->request->param("limit", 10);
        $taolijin = new TbgiftModel();
        $list = $taolijin->where($where)->order("createdt desc")->page($page, $limit)->select();
        $count = $taolijin->where($where)->count();
        return json(["code"=>0, "msg"=>"淘礼金使用记录", "count"=>$count, "data"=>$list]);
    }
}