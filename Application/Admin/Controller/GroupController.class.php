<?php
namespace Admin\Controller;

class GroupController extends CheckAuthController {
    /**
     * [Manage 角色管理]
     * @return null
     */
    public function Manage(){
        //获取角色树形结构
        if(IS_POST && IS_AJAX && I('combotree') == 'true'){
            $auth_group = M("AuthGroup");
            $core = new \Admin\Api\Core();
            $data = $auth_group->field('*,title as text')->order("sort asc")->select();
            $result = $core->get_group_tree($data);
            $this->ajaxReturn($result);
        }
    	//获取角色树形列表，无限极
        if(IS_POST && IS_AJAX){
            $auth_group = M("AuthGroup");
            $core = new \Admin\Api\Core();
            $data = $auth_group->field('*,title as text')->order("sort asc")->select();
            $result = $core->get_group_tree($data);
            $this->ajaxReturn($result);
        }
        $this->display();
    }

    /**
     * [SortGroup 排序角色]
     * @return  null
     */
    public function SortGroup(){
        if(IS_POST && IS_AJAX){
            $sort_list = I('sort');
            $null_sort_id = array();
            $error_sort_id = array();
            foreach($sort_list as $k => $v){
                if($v == ''){
                    $null_sort_id[] = $k;
                }
            }
            if(count($null_sort_id)){
                $this->error('无法更新排序，排序项ID为： '.implode('，',$null_sort_id).' 出错，可能原因：该项排序值为空值');
            }
            $auth_group = M('AuthGroup');
            foreach($sort_list as $k => $v){
                $where_sql = array(
                    'id' => $k,
                    'sort' => $v
                );
                $result = $auth_group->save($where_sql);
                if($result === false){
                    $error_sort_id[] = $k;
                }
            }
            if(!count($error_sort_id)){
                $this->success('成功更新所有排序');
            } else {
                $this->error('更新部分ID项目成功，排序项ID为： '.implode('，',$error_sort_id).' 出错，可能原因：数据库写入失败');
            }
        }
    }
}