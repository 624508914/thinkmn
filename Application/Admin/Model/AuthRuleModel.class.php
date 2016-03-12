<?php
namespace Admin\Model;
use Think\Model;

class AuthRuleModel extends Model{
    //自动验证规则
    protected $_validate = array(
        array('title','','已经存在该菜单名称',self::EXISTS_VALIDATE,'unique',self::MODEL_BOTH),
        array('name','','已经存在该菜单路径',self::EXISTS_VALIDATE,'unique',self::MODEL_BOTH),
        array('pid','check_pid','上级菜单数据校验失败',self::EXISTS_VALIDATE,'callback',self::MODEL_BOTH)
    );

    public function check_pid($pid){
        if(!$pid){
            return true;
        }
        $result = $this->find($pid);
        if(!$result){
            return false;
        }
    }
    
    //删除对应菜单以及所有下级子菜单
    public function del_son_menu($id){
        $where_sql['id'] = array('in',implode(',',$this->get_son_menu($id)));
        $result = $this->where($where_sql)->delete();
        return $result;
    }
    
    //获取下级菜单一维数组方式
    public function get_son_menu($id){
        $result[] = $id;
        $where_sql['pid'] = $id;
        $result_menu = $this->where($where_sql)->select();
        if(count($result_menu)){
            foreach($result_menu as $k => $v){
                $temp_menu = $this->get_son_menu($v['id']);
                foreach($temp_menu as $k => $v){
                    $result[] = $v;
                }
            }
        }
        return $result;
    }

}