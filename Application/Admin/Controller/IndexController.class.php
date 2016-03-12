<?php
namespace Admin\Controller;

/**
 * 后台中心
 */
class IndexController extends CheckLoginController {
    /**
     * [index 后台首页]
     * @return null
     */
    public function index(){
        $core = new \Admin\Api\Core();
        $this->user_info = $core->get_user_info();
        $this->top_menu = $core->get_top_menu();
        
        $this->display();
    }
    /**
     * [Main 系统主页]
     * @return null
     */
    public function Main(){
        $core = new \Admin\Api\Core();
        $this->user_info = $core->get_user_info();
        
        $this->display();
    }
    
    /**
     * [getSonMenu 获取下级菜单]
     * @return json
     */
    public function getSonMenu(){
        if(IS_POST && IS_AJAX){
            $core = new \Admin\Api\Core();
            $result = $core->get_son_menu(I('id/d'));
            $this->ajaxReturn($result);
        }
    }
}