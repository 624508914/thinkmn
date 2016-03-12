<?php
namespace Admin\Controller;

class UserController extends CheckAuthController{
	/**
	 * [Manage 用户管理]
	 * @return null
	 */
	public function Manage(){
		if(IS_POST && IS_AJAX){
			$member = M('Member');
			$where_sql = array();
			$result = $member->field('password',true)->where($where_sql)->order("uid asc")->page(I('page'),I('rows'))->select();
			foreach($result as $k=>$v){
				$result[$k]['birthday'] = date('Y-m-d',$v['birthday']);
				$result[$k]['reg_ip'] = long2ip($v['reg_ip']);
				$result[$k]['reg_time'] = date('Y-m-d H:i:s',$v['reg_time']);
				$result[$k]['last_login_time'] = date('Y-m-d H:i:s',$v['last_login_time']);
				$result[$k]['last_login_ip'] = long2ip($v['last_login_ip']);
			}
			$data = array(
				"total" => $member->where($where_sql)->count(),
				"rows" => $result
			);
			$this->ajaxReturn($data);
		}
		$this->display();
	}

	public function ViewUser(){
		if(IS_AJAX){
			$core = new \Admin\Api\Core();
	        $this->user_info = $core->get_user_info(I('id/d'));
	        
	        $this->display();
		}
	}

	public function AddUser(){
		if(IS_POST && IS_AJAX){
			$member = D("Member");
			$data = array(
            	'username' => I('username'),
            	'password' => I('password',0,'md5'),
            	'nickname' => I('nickname'),
            	'sex' => I('sex'),
            	'birthday' => I('birthday',0,'strtotime'),
            	'email' => I('email'),
            	'qq' => I('qq'),
            	'mobile' => I('mobile'),
            	'score' => I('score',0,'intval'),
            	'gold' => I('gold',0,'intval'),
            	'status' => I('status',0,'intval'),
            	'user_type' => 1,
            	'reg_ip' => ip2long(get_client_ip()),
            	'reg_time' => time(),
            	'group_id' => I('group_id')
            );
			//数据自动验证
            if(!$member->create($data)){
                $this->error($member->getError());
            }
            $result = $member->add();
            if($result){
                if(!$member->add_group_access($result,$data['group_id'])){
                	$member->delete($result);
	                $this->error('授权角色失败，请联系管理员');
                }
                $this->success('添加角色成功');
            } else {
                $this->error('添加角色失败，未知的原因');
            }
		}
		$this->groups = M('AuthGroup')->field('rules',true)->select();
		$this->display();
	}
}