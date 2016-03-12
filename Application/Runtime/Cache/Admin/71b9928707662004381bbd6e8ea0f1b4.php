<?php if (!defined('THINK_PATH')) exit();?><form action="<?php echo U('Menu/AddMenu');?>" method="POST" class="table_form">
    <table class="table_list">
        <tr>
            <th>名称：</th>
            <td width="100"><input type="text" name="title" class="easyui-textbox" data-options="required:true" style="width:100%;height:25px;" /></td>
            <th>路径：</th>
            <td width="100"><input type="text" name="name" class="easyui-textbox" data-options="required:true" style="width:100%;height:25px;" /></td>
        </tr>
        <tr>
            <th>状态：</th>
            <td><label for="status_on"><input type="radio" id="status_on" name="status" value="1" checked /> 启用</label><label for="status_off"><input type="radio" id="status_off" name="status" value="0" /> 禁用</label></td>
            <th>打开方式：</th>
            <td><label for="open_type_on"><input type="radio" id="open_type_on" name="open_type" value="0" checked /> Ajax</label><label for="open_type_off"><input type="radio" id="open_type_off" name="open_type" value="1" /> Iframe</label></td>
        </tr>
        <tr>
            <th>条件状态：</th>
            <td><label for="type_on"><input type="radio" id="type_on" name="type" value="1" checked /> 启用</label><label for="type_off"><input type="radio" id="type_off" name="type" value="0" /> 禁用</label></td>
            <th>条件：</th>
            <td><input type="text" name="condition" class="easyui-textbox" data-options="" style="width:100%;height:25px;" /></td>
        </tr>
        <tr>
            <th>排序：</th>
            <td><input type="text" name="sort" class="easyui-textbox" data-options="required:true" value="50" style="width:100%;height:25px;" /></td>
            <th>图标：</th>
            <td><input type="text" name="iconcls" class="easyui-textbox" data-options="required:true" value="fa fa-home" style="width:100%;height:25px;" /></td>
        </tr>
        <tr>
            <th>上级菜单：</th>
            <td colspan="3"><input type="text" name="pid" class="easyui-combotree" data-options="url:'<?php echo U('Menu/Manage');?>',queryParams:{combotree:true},required:true" value="<?php echo ($pid); ?>" style="width:100%;height:25px;" /></td>
        </tr>
        <tr>
            <td colspan="4">
                <input type="button" value="添加" class="table_form_submit_dialog" style="float:right;margin-right:0px;" />
                <button type="button" class="table_form_close_dialog" style="float:right;">取消</button>
            </td>
        </tr>
    </table>
</form>