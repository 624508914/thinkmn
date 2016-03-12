<?php
namespace Admin\Api;
use Think\Auth;

class Core{
    //用户UID
    public $uid;
    //Auth认证类
    public $auth;
    
    /**
     * [__construct 构造方法]
     */
    public function __construct(){
        $admin_user_token = session('ADMIN_USER_TOKEN');
        $this->uid = intval($admin_user_token['uid']);
        $this->auth = new Auth();
    }

    /**
     * [get_user_info 获取用户信息 组信息 & 资料信息]
     * @param  integer $uid [用户UID]
     * @return array
     */
    public function get_user_info($uid = 0){
        //未指定ID为默认登录用户
        if(!$uid){
            $uid = $this->uid;
        }
        $admin = M('Member');
        $result = array(
            'groups' => $this->auth->getGroups($uid),
            'info' => $admin->field('password',true)->find($uid)
        );
        return $result;
    }
    
    /**
     * [check_rule 校验是否访问授权]
     * @return boolean
     */
    public function check_rule(){
        return $this->auth->check(CONTROLLER_NAME.'/'.ACTION_NAME,$this->uid);
    }
    
    /**
     * [get_groups_rules 获取用户 组ID & 规则信息]
     * @return array
     */
    public function get_groups_rules(){
        $result = array(
            'group_ids' => array(),
            'group_rules' => array()
        );
        $user_info = $this->get_user_info();
        foreach($user_info['groups'] as $v){
            $result['group_ids'][] = $v['group_id'];
            $result['group_rules'][] = $v['rules'];
        }
        //授权菜单去重复
        $result['group_rules'] = implode(',',$result['group_rules']);
        $result['group_rules'] = explode(',',$result['group_rules']);
        $result['group_rules'] = array_unique($result['group_rules']);
        return $result;
    }
    
    /**
     * [get_top_menu 获取顶级菜单]
     * @return array
     */
    public function get_top_menu(){
        $groups_rules = $this->get_groups_rules();
        $auth_rule = M('AuthRule');
        //区分管理员与非管理员角色用户
        if($this->uid == 1 || in_array(1,$groups_rules['group_ids'])){
            $where_sql = array(
                'pid' => 0,
                'name' => array('neq','DatabaseCenter')
            );
            $result = $auth_rule->where($where_sql)->order('sort asc')->select();
        } else {
            $where_sql = array(
                'id' => array('in',$groups_rules['group_rules']),
                'pid' => 0
            );
            $result = $auth_rule->where($where_sql)->order('sort asc')->select();
        }
        return $result;
    }
    
    /**
     * [get_son_menu 获取下级菜单]
     * @param  integer $pid 上级菜单ID
     * @param  boolean $level 获取下级菜单层级数，true：菜单管理，false：菜单获取
     * @return array
     */
    public function get_son_menu($pid,$level=false){
        $groups_rules = $this->get_groups_rules();
        $auth_rule = M('AuthRule');
        
        //区分管理员与非管理员角色用户
        if($this->uid == 1 || in_array(1,$groups_rules['group_ids'])){
            $where_sql = array(
                'pid' => $pid
            );
            $result = $auth_rule->field('*,title as text')->where($where_sql)->order('sort asc')->select();
        } else {
            $where_sql = array(
                'pid' => $pid
            );
            $result = $auth_rule->field('*,title as text')->where($where_sql)->order('sort asc')->select();
            //区分菜单管理请求
            if(!$level){
                foreach($result as $k=>$v){
                    //判断该用户角色是否进行授权
                    if(in_array($v['id'],$groups_rules['group_rules'])){
                        $result[$k]['status'] = 1;
                    } else {
                        $result[$k]['status'] = 0;
                    }
                }
            }
        }
        foreach($result as $k=>$v){
            $result[$k]['iconCls'] = $v['iconcls'];
            $result[$k]['url'] = U($v['name']);
            unset($result[$k]['iconcls']);
            //区分菜单管理请求
            if(!$level){
                $check_son_menu = $this->check_son_menu($v['pid']);
                if($check_son_menu){
                    $result[$k]['state'] = 'open';
                } else {
                    $result[$k]['state'] = 'closed';
                }
            } else {
                $where_sql = array('pid'=>$v['id']);
                $rs = $auth_rule->where($where_sql)->count();
                if(!$rs){
                    $result[$k]['state'] = 'open';
                } else {
                    $result[$k]['state'] = 'closed';
                }
            }
            
        }
        return $result;
    }
    
    /**
     * [check_son_menu 检查是否二、三级菜单]
     * @param  integer $id 菜单ID
     * @return array
     */
    public function check_son_menu($id){
        if(!$id){return false;}
        $auth_rule = M('AuthRule');
        $result = $auth_rule->find($id);
        if(!$result['pid']){
            return false;
        } else {
            return true;
        }
        
    }
    
    /**
     * [get_current_position 获取当前位置]
     * @param  string $delimiter 分隔符
     * @return string
     */
    public function get_current_position($delimiter = ' > '){
        $auth_rule = M('AuthRule');
        $where_sql = array('name'=>CONTROLLER_NAME.'/'.ACTION_NAME);
        $rule = $auth_rule->where($where_sql)->find();
        
        $result = $this->get_parent_rule($rule['pid']);
        
        $result = array_reverse($result);
        $result[] = $rule['title'];
        $result = '当前位置：'.implode($delimiter,$result);
        return $result;
    }
    
    /**
     * [get_parent_rule 递归获取当前位置数组]
     * @param  integer $pid    上级菜单ID
     * @param  array   $result 当前位置数组
     * @return array
     */
    public function get_parent_rule($pid = 0,$result = array()){
        $auth_rule = M('AuthRule');
        $where_sql = array('id'=>$pid);
        $rule = $auth_rule->where($where_sql)->find();
        $result[] = $rule['title'];
        
        if(!intval($rule['pid'])){
            return $result;
        } else {
            return $this->get_parent_rule($rule['pid'],$result);
        }
        
    }
    
    /**
     * [get_menu_tree 递归树形菜单数组]
     * @param  [array]    $data [树形菜单数组]
     * @param  [integer] $pid  [上级菜单ID]
     * @return [array]
     */
    public function get_menu_tree($data,$pid = 0){
        $tree = array();
        foreach($data as $v){
            $v['iconCls'] = $v['iconcls'];
            if($v['pid'] == $pid){
                $v['children'] = $this->get_menu_tree($data,$v['id']);
                $tree[] = $v;
            }
        }
        return $tree;
    }

    /**
     * [get_group_tree 递归树形角色数组]
     * @param  [array]    $data [树形角色数组]
     * @param  [integer] $pid  [上级角色ID]
     * @return [array]
     */
    public function get_group_tree($data,$pid = 0){
        $tree = array();
        foreach($data as $v){
            if($v['pid'] == $pid){
                $v['children'] = $this->get_group_tree($data,$v['id']);
                $tree[] = $v;
            }
        }
        return $tree;
    }
}