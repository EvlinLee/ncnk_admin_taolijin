<?php


namespace app\admin\controller;
use app\common\model\Goods as GoodsModel;
//use think\Request;


class Goods extends Base
{
    public function index(){
        return view("index", $this->data);
    }

    /**
     * 商品表格
     */
    public function tableGoods(){
        $where = [
            "status"=>["=", 1],
        ];
        $page = $this->request->param("page");
        $limit = $this->request->param("limit");
        $goods = new GoodsModel();
        $list = $goods->where($where)->order("create_time asc")->page($page, $limit)->select();
        $count = $goods->where($where)->count();
        return json(["code"=>0, "msg"=>"商品列表", "count"=>$count, "data"=>$list]);
    }
}