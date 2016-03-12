<?php if (!defined('THINK_PATH')) exit();?><form action="<?php echo U('Person/EditPassword');?>" method="post" class="table_form">
    <table class="table_list">
        <tr>
            <th width="70">当前密码:</th>
            <td><input type="password" name="old_password" class="easyui-textbox" data-options="required:true" style="height:30px;"></td>
        </tr>
        <tr>
            <th>新密码:</th>
            <td><input type="password" name="new_password" id="new_password" class="easyui-textbox" data-options="required:true" style="height:30px;"></td>
        </tr>
        <tr>
            <th>重复密码:</th>
            <td><input type="password" name="affirm_password" class="easyui-textbox" data-options="required:true,validType:['equals[\'#new_password\']']" style="height:30px;"></td>
        </tr>
        <tr>
            <th></th>
            <td><input type="button" value="立即修改" class="table_form_submit_tabs"></td>
        </tr>
    </table>
</form>