<?php
namespace Admin\Controller;

/**
 * 个人中心
 */
class PersonController extends CheckAuthController {
    /**
     * [Profile 用户资料]
     * @return null
     */
    public function Profile(){
        $core = new \Admin\Api\Core();
        $this->user_info = $core->get_user_info();
        
        $this->display();
    }
    
    /**
     * [EditPassword 修改密码]
     * @return null
     */
    public function EditPassword(){
        if(IS_POST && IS_AJAX){
            $member = D('Member');
            if(!$member->create()){
                $this->error($member->getError());
            }
            exit;
            $core = new \Admin\Api\Core();
            $result = $member->find($core->uid);
            if($result['password'] != $post_data['old_password']){
                $this->error('当前密码输入错误');
            } else {
                $result['password'] = $post_data['new_password'];
                $result = $member->save($result);
                if($result !== false){
                    $this->success('恭喜修改密码成功，请牢记新密码：'.I('new_password'));
                } else {
                    $this->error('修改密码失败，系统故障');
                }
            }
        }
        $this->display();
    }
    
    /**
     * [EditProfile 修改资料]
     * @return null
     */
    public function EditProfile(){
        $core = new \Admin\Api\Core();
        
        if(IS_POST && IS_AJAX){
            $data = array(
                'uid' => $core->uid,
                'sex' => I('sex',0,'intval'),
                'birthday' => strtotime(I('birthday')),
                'email' => I('email'),
                'qq' => I('qq'),
                'mobile' => I('mobile')
            );

            $member = D('Member');
            if(!$member->create($data)){
                $this->error($member->getError());
            }
            $result = $member->save();
            if($result !== false){
                $this->success('恭喜修改资料成功');
            } else {
                $this->error('修改资料失败，系统故障');
            }
        }
        
        $this->user_info = $core->get_user_info();
        $this->display();
    }
}