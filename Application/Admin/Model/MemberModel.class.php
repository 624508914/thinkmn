<?php
namespace Admin\Model;
use Think\Model;

class MemberModel extends Model{
	//自动验证
	protected $_validate = array(
		/*array('username','','该用户已经存在',0,'unique',1),
		array('nickname','','该昵称已被使用',self::EXISTS_VALIDATE,'unique',self::MODEL_BOTH),
		array('email','','该邮箱已被使用',self::EXISTS_VALIDATE,'unique',self::MODEL_BOTH),
		array('qq','','该QQ已被使用',self::EXISTS_VALIDATE,'unique',self::MODEL_BOTH),
		array('mobile','','该手机号已被使用',self::EXISTS_VALIDATE,'unique',self::MODEL_BOTH),
		array('repassword','password','确认密码不正确',self::EXISTS_VALIDATE,'confirm',self::MODEL_BOTH), 
		array('email','email','邮箱格式不正确',self::EXISTS_VALIDATE,'regex',self::MODEL_BOTH),
		array('qq','number','QQ号必须全为数字',self::EXISTS_VALIDATE,'regex',self::MODEL_BOTH),
		array('mobile','number','手机号必须全为数字',self::EXISTS_VALIDATE,'regex',self::MODEL_BOTH),
		array('sex',array(0,1,2),'性别校验不正确',self::EXISTS_VALIDATE,'in',self::MODEL_BOTH),
		array('status',array(0,1),'状态校验不正确',self::EXISTS_VALIDATE,'in',self::MODEL_BOTH),
		array('group_id','check_group_id','授权角色校验不正确',self::EXISTS_VALIDATE,'callback',self::MODEL_BOTH),
		*/
		//登录操作校验
		array('code','check_verify','验证码错误',1,'callback',4),
		array('username','check_username','登录名错误',1,'callback',4),
		array('password','check_password','密码错误',1,'callback',4),
		
		//字段空值校验
		array('username','require','用户名不能为空',0),
		array('password','require','密码不能为空',0),
		array('nickname','require','昵称不能为空',0),
		array('sex','require','性别不能为空',0),
		array('birthday','require','生日不能为空',0),
		array('email','require','邮箱不能为空',0),
		array('qq','require','QQ不能为空',0),
		array('mobile','require','手机号不能为空',0),
		array('score','require','积分不能为空',0),
		array('gold','require','金币不能为空',0),
		array('status','require','状态不能为空',0),
		array('face','require','头像不能为空',0),
		array('user_type','require','类型不能为空',0),
		array('reg_ip','require','注册IP不能为空',0),
		array('reg_time','require','注册时间不能为空',0),
		array('last_login_ip','require','最后登录IP不能为空',0),
		array('last_login_time','require','最后登录时间不能为空',0),

		//字段逻辑校验
		array('oldpassword','check_old_password','当前登录密码错误',0,'callback'),
		array('repassword','password','确认密码不正确',0,'confirm'),



	);

	//自动完成
	protected $_auto = array(
		array('password','md5',3,'function'),
	);

	public function check_verify($code){
        if(!check_verify($code)){
            return false;
        }
	}

	public function check_username($username){
		$where_sql = array(
			'username' => trim($username),
		);
		$rs = $this->where($where_sql)->find();
		if(!$rs){
			return false;
		}
	}

	public function check_password($password){
		$where_sql = array(
			'username' => $this->username,
			'password' => md5($password)
		);
		$rs = $this->where($where_sql)->find();
		if(!$rs){
			return false;
		}
	}

	public function check_old_password($password){
		$core = new \Admin\Api\Core();
		$result = $this->find($core->uid);
		if($result['password'] != md5($password)){
            return false;
        }
	}

	/*
	public function check_group_id($group_id){
		foreach($group_id as $k=>$v){
			if(!$v){
				unset($group_id[$k]);
				break;
			}
			$auth_group = M('AuthGroup');
			$result = $auth_group->find($v);
			if(!$result){
				return false;
			}
		}
	}

	public function add_group_access($uid,$group_id){
		$auth_group_access = M('AuthGroupAccess');
        $where_sql = array(
        	'uid' => $uid
        );
        $auth_group_access->where($where_sql)->delete();
        $data_list = array();
        foreach($group_id as $k=>$v){
        	$data_list[] = array('uid'=>$uid,'group_id'=>$v);
        }
        $result = $auth_group_access->addAll($data_list);
        return $result;
	}
	*/
}