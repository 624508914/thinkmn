<?php
namespace Admin\Controller;
use Think\Controller;

class CheckAuthController extends Controller {
    public function _initialize(){
        $admin_user_token = session("ADMIN_USER_TOKEN");
        if(!$admin_user_token){
            header("content-type:text/html; charset=utf-8");
			$this->redirect('Login/index', '', 0, '您还未登录,页面跳转中！');
        }
        //用户登录后，最新活动时间
		session('LOGIN_TIME',time());
        
        $core = new \Admin\Api\Core();
        $groups_rules = $core->get_groups_rules();
        
        //返回当前位置
        $this->assign('Position',$core->get_current_position());
        
		//超级管理员用户与角色跳过验证
		if($core->uid == 1 || in_array(1,$groups_rules['group_ids'])){
			//管理员用户行为检测记录
			//writeBehaviorLog();
			return true;
		}
        
        //检查普通用户权限
        $result = $core->check_rule();
        //未通过权限认证
        if(!$result){
            if(IS_GET || (IS_GET && IS_AJAX)){
                echo "<div style='padding:10px;'>权限不足</div>";
                exit;
            } else {
                $this->error('权限不足');
            }
        }
        //通过规则验证的用户行为检测记录
        //writeBehaviorLog();
    }
}