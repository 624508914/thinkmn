<?php
function check_verify($code, $id = ''){    
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

function is_email($email){
    return (ereg("^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+",$email));
}

/**
 * [get_menu_info 获取菜单字段信息]
 * @param  [integer] $id    [菜单id]
 * @param  [string]  $field [字段信息]
 * @return [string]         [返回字段文本信息]
 */
function get_menu_info($id,$field=''){
    if(!$id){
        return '顶级菜单';
    } else {
        $auth_rule = M('AuthRule');
        $result = $auth_rule->find($id);
        if($field != ''){
            $result = $result[$field];
        }
        return $result;
    }
}