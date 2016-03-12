<?php
namespace Admin\Controller;

class MenuController extends CheckAuthController {
    /**
     * [Manage 菜单管理]
     * @return null
     */
    public function Manage(){
        //获取菜单树形结构带顶级菜单项
        if(IS_POST && IS_AJAX && I('combotree') == 'true'){
            $auth_rule = M("AuthRule");
            $core = new \Admin\Api\Core();
            $data = $auth_rule->field('*,title as text')->order("sort asc")->select();
            $result = array();
            $result[0] = array(
                'id' => 0,
                'text' => '顶级菜单',
                'iconCls' => 'fa fa-home',
                'children' => $core->get_menu_tree($data)
            );
            $this->ajaxReturn($result);
        }
    	//获取树形菜单列表，无限极
        if(IS_POST && IS_AJAX){
            $core = new \Admin\Api\Core();
            $result = $core->get_son_menu(I('id/d'),true);
            $this->ajaxReturn($result);
        }
        $this->display();
    }

    /**
     * [ViewMenu 查看查单]
     * @return  null
     */
    public function ViewMenu(){
        if(IS_AJAX){
            $auth_rule = M('AuthRule');
            $this->result = $auth_rule->find(I('id/d'));
            $this->display();
        }
    }

    /**
     * [AddMenu 添加菜单]
     * @return  null
     */
    public function AddMenu(){
        if(IS_POST && IS_AJAX){
            $auth_rule = D('AuthRule');
            //数据自动验证
            if(!$auth_rule->create()){
                $this->error($auth_rule->getError());
            }

            $result = $auth_rule->add();
            if($result){
                $this->success('成功添加菜单');
            } else {
                $this->error('添加菜单失败，未知的原因');
            }
        }
        $this->pid = I('id',0,'intval');
        $this->display();
    }

    /**
     * [EditMenu 编辑菜单]
     * @return  null
     */
    public function EditMenu(){
        if(IS_POST && IS_AJAX){
            $auth_rule = D('AuthRule');
            //数据自动验证
            if(!$auth_rule->create()){
                $this->error($auth_rule->getError());
            }

            $result = $auth_rule->save();
            if($result !== false){
                $this->success('成功编辑菜单');
            } else {
                $this->error('编辑菜单失败，未知的原因');
            }
        }
        $auth_rule = M('AuthRule');
        $this->result = $auth_rule->find(I('id/d'));
        $this->display();
    }

    /**
     * [DelMenu 删除菜单]
     * @return  null
     */
    public function DelMenu(){
        if(IS_POST && IS_AJAX){
            $core = new \Admin\Api\Core();
            if($core->uid !== 1){
                $this->error('只允许超级管理员进行操作');
            }

            $auth_rule = D('AuthRule');
            $id = I('id/d');

            if(!$id){
                $this->error('未指定要删除的菜单');
            } else {
                $result = $auth_rule->del_son_menu($id);
                if($result){
                    $this->success('成功删除所选菜单及其下所有子菜单');
                } else {
                    $this->error('删除菜单失败，系统未知原因');
                }
            }
        }
    }

    /**
     * [SortMenu 排序菜单]
     * @return  null
     */
    public function SortMenu(){
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
            $auth_rule = M('AuthRule');
            foreach($sort_list as $k => $v){
                $where_sql = array(
                    'id' => $k,
                    'sort' => $v
                );
                $result = $auth_rule->save($where_sql);
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