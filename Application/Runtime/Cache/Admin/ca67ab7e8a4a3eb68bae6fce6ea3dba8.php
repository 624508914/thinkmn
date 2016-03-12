<?php if (!defined('THINK_PATH')) exit();?>﻿<div class="easyui-panel" title="<?php echo ($Position); ?>" data-options="border:false,fit:true">
    <div style="width:100%">
        <form action="<?php echo U('Person/EditProfile');?>" method="post" class="table_form">
            <table class="table_list">
                <tr>
                    <th width="70">UID:</th>
                    <td><?php echo ($user_info["info"]["uid"]); ?></td>
                </tr>
                <tr>
                    <th>账号:</th>
                    <td><?php echo ($user_info["info"]["username"]); ?></td>
                </tr>
                <tr>
                    <th>头像:</th>
                    <td></td>
                </tr>
                
                <tr>
                    <th>昵称:</th>
                    <td><?php echo ($user_info["info"]["nickname"]); ?></td>
                </tr>
                <tr>
                    <th>性别:</th>
                    <td>
                        <select class="easyui-combobox" value="<?php echo ($user_info["info"]["sex"]); ?>" style="height:30px;">
                            <option value="0">保密</option>
                            <option value="1">男</option>
                            <option value="2">女</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>生日:</th>
                    <td><input type="text" name="birthday" class="easyui-datebox" data-options="required:true" style="height:30px;" value="<?php echo date('Y-m-d',$user_info['info']['birthday']);?>"></td>
                </tr>
                <tr>
                    <th>邮箱:</th>
                    <td><input type="text" name="email" class="easyui-textbox" data-options="required:true" style="height:30px;" value="<?php echo ($user_info["info"]["email"]); ?>"></td>
                </tr>
                <tr>
                    <th>QQ:</th>
                    <td><input type="text" name="qq" class="easyui-textbox" data-options="required:true" style="height:30px;" value="<?php echo ($user_info["info"]["qq"]); ?>"></td>
                </tr>
                <tr>
                    <th>手机号:</th>
                    <td><input type="text" name="mobile" class="easyui-textbox" data-options="required:true" style="height:30px;" value="<?php echo ($user_info["info"]["mobile"]); ?>"></td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="button" value="立即修改" class="table_form_submit_tabs"></td>
                </tr>
            </table>
        </form>
    </div>
</div>