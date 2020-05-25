<?php


namespace app\admin\controller;

use app\common\model\Deduct as DeductModel;
use app\common\model\User as UserModel;
use app\common\util\ReturnCode;
use think\Controller;
use think\facade\Cookie;

class Login extends Controller
{
    /**
     * 登录页面
     */
    public function index(){
        return view("index");
    }

    /**
     * 登录，存缓存
     */
    public function login(){
        $account = $this->request->param("account");
        $token = $this->request->param("token");
        // 检测是否创建账户
        $this->checkUserInfo($account, $token);

        Cookie::set("ncnk_taolijin_user", $account, 12*60*60);

        return json(["code"=>ReturnCode::SUCCESS, "msg"=>"成功"]);
    }

    /**
     * 退出
     */
    public function logout(){
        Cookie::delete("ncnk_taolijin_user");
        $this->redirect("Login/index");
    }

    /**
     * 检测是否创建账户
     * @param $account
     * @param $token
     */
    private function checkUserInfo($account, $token){
        $user = new UserModel();
        $userInfo = $user->where("account", $account)->find();
        if (!$userInfo){
            $this->getMain($account, $token);
        }
    }

    /**
     * 获取主账户信息
     * @param $account
     * @param $token
     */
    private function getMain($account, $token){
        if (!$token || !$account){
            return json(["code"=>ReturnCode::ERROR, "msg"=>"创建账户信息失败"]);
        }
        $url = "https://cloudmanage.nianchu.net/api/5c9d81486c58f";
        $headers = [];
        $headers[] = ["key"=>"version","value"=>"v3.0"];
        $headers[] = ["key"=>"user-token","value"=>$token];
        $request = httpsRequest($url, [], $headers, "get");
        $res = json_decode($request, true);
        if ($res["code"] != 1 && $res["data"]["code"] != 1){
            return json(["code"=>ReturnCode::ERROR, "msg"=>"创建账户信息失败"]);
        }
        $main_id = $res["data"]["data"]["user"]["id"];
        $this->createUserInfo($account, $main_id);
    }

    /**
     * 创建账户 和 抵扣比例
     * @param $account
     */
    private function createUserInfo($account, $main_id){
        //创建账户
        $user = new UserModel();
        $user->main_id = $main_id;
        $user->account = $account;
        $user->status = 1;
        $user->create_time = date("Y-m-d H:i:s");
        $user->save();
        //创建抵扣比例，默认50
        $deduct = new DeductModel();
        $deduct->uid = $user->id;
        $deduct->proportion = 50;
        $deduct->save();
    }
}