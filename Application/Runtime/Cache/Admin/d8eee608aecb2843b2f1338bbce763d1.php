<?php if (!defined('THINK_PATH')) exit();?><div style="width:100%">
    <table class="table_list">
        <tr>
            <th width="70">UID:</th>
            <td><?php echo ($user_info["info"]["uid"]); ?></td>
            <th width="80">登录名:</th>
            <td><?php echo ($user_info["info"]["username"]); ?></td>
        </tr>
        <tr>
            <th>昵称:</th>
            <td><?php echo ($user_info["info"]["nickname"]); ?></td>
            <th>头像:</th>
            <td><?php echo ($user_info['info']['face'] ? $user_info['info']['face'] : '<span class="text-warning">未上传</span>'); ?></td>
        </tr>
        <tr>
            <th>性别:</th>
            <td>
                <?php switch($user_info["info"]["sex"]): case "0": ?>保密<?php break;?>
                    <?php case "1": ?>男<?php break;?>
                    <?php case "2": ?>女<?php break; endswitch;?>
            </td>
            <th>生日:</th>
            <td><?php echo date('Y-m-d',$user_info['info']['birthday']);?></td>
        </tr>
        <tr>
            <th>邮箱:</th>
            <td><?php echo ($user_info["info"]["email"]); ?></td>
            <th>QQ:</th>
            <td><?php echo ($user_info['info']['qq'] ? $user_info['info']['qq'] : '<span class="text-warning">未填写</span>'); ?></td>
        </tr>
        <tr>
            <th>手机号:</th>
            <td><?php echo ($user_info['info']['mobile'] ? $user_info['info']['mobile'] : '<span class="text-warning">未填写</span>'); ?></td>
            <th>状态:</th>
            <td><?php echo ($user_info['info']['status'] ? '<span class="text-success">正常</span>' : '<span class="text-danger">禁用</span>'); ?></td>
        </tr>
        <tr>
            <th>积分:</th>
            <td><?php echo ($user_info["info"]["score"]); ?></td>
            <th>金币:</th>
            <td><?php echo ($user_info["info"]["gold"]); ?></td>
        </tr>
        <tr>
            <th>授权角色：</th>
            <td colspan="3">
                <?php if(is_array($user_info["groups"])): foreach($user_info["groups"] as $k=>$vo): if($k): ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php endif; ?><a href="javascript:void(0)"><?php echo ($vo["title"]); ?></a><?php endforeach; endif; ?>
            </td>
        </tr>
        <tr>
            <th>授权部门：</th>
            <td colspan="3">
                
            </td>
        </tr>
        <tr>
            <th>授权栏目：</th>
            <td colspan="3">
                
            </td>
        </tr>
        <tr>
            <th>注册IP:</th>
            <td><?php echo long2ip($user_info['info']['reg_ip']);?></td>
            <th>注册时间:</th>
            <td><?php echo date('Y-m-d H:i:s',$user_info['info']['reg_time']);?></td>
        </tr>
        <tr>
            <th>最后登录IP:</th>
            <td><?php echo long2ip($user_info['info']['last_login_ip']);?></td>
            <th>最后登录时间:</th>
            <td><?php echo date('Y-m-d H:i:s',$user_info['info']['last_login_time']);?></td>
        </tr>
    </table>
</div>