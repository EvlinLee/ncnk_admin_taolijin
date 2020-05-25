<?php


namespace app\admin\controller;
use think\Controller;
use think\App;
use think\facade\Cookie;
use app\common\util\ReturnCode;
use app\common\model\User as UserModel;

class Base extends Controller
{
    protected $userInfo = [];
    protected $data;

    public function __construct(App $app){
        parent::__construct($app);
        if (!Cookie::has("ncnk_taolijin_user")){
            $this->redirect("Login/index");
            exit;
        }
        $this->userInfo();
    }

    /**
     * 获取用户信息
     */
    protected function userInfo(){
        $account = Cookie::get("ncnk_taolijin_user");
        $user = new UserModel();
        $userinfo = $user->where("account", $account)->find();
        if (!$userinfo){
            $this->redirect("Login/index");
        }
        $this->userInfo = $userinfo->toArray();
    }

    // 给data赋值
    protected function setData(String $key, $value)
    {
        $this->data[$key] = $value;
    }

    //
    public function buildSuccess($data = [], $msg = '操作成功', $code = ReturnCode::SUCCESS) {
        $return = [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data
        ];

        return $return;
    }

    public function buildFailed($code, $msg = '操作失败', $data = []) {
        $return = [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data
        ];

        return $return;
    }
}