<?php
namespace Admin\Controller;
use Think\Controller;

class CheckLoginController extends Controller {
    public function _initialize(){
        $admin_user_token = session("ADMIN_USER_TOKEN");
        if(!$admin_user_token){
            $this->redirect('Login/index', '', 0, '您还未登录,页面跳转中！');
        }
        //用户登录后，最新活动时间
		session('LOGIN_TIME', time());
    }
}