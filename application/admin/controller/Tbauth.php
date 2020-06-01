<?php


namespace app\admin\controller;
use app\common\util\ReturnCode;
use app\common\util\ReturnDesc;
use app\common\model\Tbauth as TbauthModel;

class Tbauth extends Base
{
    //淘礼金配置页
    public function index(){
        return view("index");
    }
    //淘礼金配置表格
    public function tableTbauth(){
        $where = [
            "uid"=>["=", $this->userInfo["id"]],
        ];
        $page = $this->request->param("page");
        $limit = $this->request->param("limit");
        $tbauth = new TbauthModel();
        $list = $tbauth->where($where)->order("create_dt desc")->page($page, $limit)->select();
        $count = $tbauth->where($where)->count();
        return json(["code"=>0, "msg"=>"淘礼金配置", "count"=>$count, "data"=>$list]);
    }
    //新增淘礼金配置页
    public function addTbauth(){
        return view("addTbauth");
    }
    //新增淘礼金
    public function addTbConfig(){
        $jiqiren_str = $this->request->post("jiqiren");
        if (!$jiqiren_str) return $this->buildFailed(ReturnCode::ERROR, "缺少参数jiqiren");
        $jiqiren_arr = explode("&&", $jiqiren_str);
        $appkey = $this->request->post("appkey");
        if (!$appkey) return $this->buildFailed(ReturnCode::ERROR, "缺少参数appkey");
        $appsecret = $this->request->post("appsecret");
        if (!$appsecret) return $this->buildFailed(ReturnCode::ERROR, "缺少参数appsecret");
        $pid = $this->request->post("pid");
        if (!$pid) return $this->buildFailed(ReturnCode::ERROR, "缺少参数pid");
        $remark = $this->request->post("remark");
        $tbauth = new TbauthModel();
        $data = [
            "uid"=>$this->userInfo["id"]
            ,"main_id"=>$jiqiren_arr[0]
            ,"sub_id"=>$jiqiren_arr[1]
        ];
        $tbauthObj = $tbauth->where($data)->find();
        if ($tbauthObj) return $this->buildFailed(ReturnCode::ERROR, "该机器人已存在配置");
        $dataDt = [
            "appkey"=>$appkey
            ,"appsecret"=>$appsecret
            ,"pid"=>$pid
            ,"remark"=>$remark
            ,"create_dt"=>date("Y-m-d H:i:s")
            ,"update_dt"=>date("Y-m-d H:i:s")
        ];
        $data = array_merge($data, $dataDt);
        $tbauth->data($data);
        $result = $tbauth->save();
        if (!$result) return $this->buildFailed(ReturnCode::ERROR, "添加失败");
        return $this->buildSuccess();
    }
    //编辑淘礼金配置页
    public function setTbauth(){
        $id = $this->request->get("id");
        $data = TbauthModel::get($id);
        if ($data) $data = $data->toArray();
        $this->setData("tbauth", $data);
        return view("setTbauth", $this->data);
    }
    //编辑淘礼金
    public function setTbConfig(){
        $id = $this->request->post("id");
        if (!$id) return $this->buildFailed(ReturnCode::ERROR, "缺少参数id");
        $appkey = $this->request->post("appkey");
        if (!$appkey) return $this->buildFailed(ReturnCode::ERROR, "缺少参数appkey");
        $appsecret = $this->request->post("appsecret");
        if (!$appsecret) return $this->buildFailed(ReturnCode::ERROR, "缺少参数appsecret");
        $pid = $this->request->post("pid");
        if (!$pid) return $this->buildFailed(ReturnCode::ERROR, "缺少参数pid");
        $remark = $this->request->post("remark");
        $tbauth = TbauthModel::get($id);
        if (!$tbauth) return $this->buildFailed(ReturnCode::ERROR, "未查询到指定配置");
        $tbauth->appkey = $appkey;
        $tbauth->appsecret = $appsecret;
        $tbauth->pid = $pid;
        $tbauth->remark = $remark;
        $tbauth->update_dt = date("Y-m-d H:i:s");
        $result = $tbauth->save();

        if (!$result) return $this->buildFailed(ReturnCode::ERROR, "修改失败");
        return $this->buildSuccess();
    }
    //删除淘礼金配置
    public function deleteTbConfig(){
        $id = $this->request->post("id");
        if (!$id) return $this->buildFailed(ReturnCode::ERROR, "缺少参数id");
        $tbauth = TbauthModel::get($id);
        $result = $tbauth->delete();
        if (!$result) return $this->buildFailed(ReturnCode::ERROR, "删除失败");
        return $this->buildSuccess();
    }
}