<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * 登录中心
 */
class LoginController extends Controller {
    /**
     * [index 登录页面]
     * @return null
     */
    public function index(){
        if(IS_POST){
            //用户登录验证模型
            $member = D('Member');
            if(!$member->create($_POST,4)){
                $this->error($member->getError());
            } else {
                $where_sql = array(
                    'username' => $member->username,
                    'password' => $member->password
                );
                $result = $member->field('password',true)->where($where_sql)->find();
                if(!$result['status']){
                    $this->error('该用户已被管理员禁用',U('Login/index'));
                }
                if(!$result['user_type']){
                    $this->error('该类型用户禁止在后台登录',U('Login/index'));
                }
                //保存最后登录IP与时间
                $result['last_login_ip'] = ip2long(get_client_ip(0,true));
                $result['last_login_time'] = time();
                $member->save($result);

                //记录用户登录通关令牌
                session('ADMIN_USER_TOKEN',$result);
                //用户登录后，最新活动时间
                session('LOGIN_TIME',time());

                $this->success('成功登录系统，正在转向系统页面',U('Index/index'));
            }
        }
        $this->display();
    }

    /**
     * [logout 退出登录]
     * @return null
     */
    public function logout(){
        session(null);
        $this->success('成功退出登录，正在转向登录页面',U('Login/index'));
    }
}