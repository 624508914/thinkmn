<?php if (!defined('THINK_PATH')) exit();?><form action="<?php echo U('Menu/EditMenu');?>" method="POST" class="table_form">
    <table class="table_list">
        <tr>
            <th>名称：</th>
            <td width="100"><input type="text" name="title" class="easyui-textbox" data-options="required:true" value="<?php echo ($result["title"]); ?>" style="width:100%;height:25px;" /></td>
            <th>路径：</th>
            <td width="100"><input type="text" name="name" class="easyui-textbox" data-options="required:true" value="<?php echo ($result["name"]); ?>" style="width:100%;height:25px;" /></td>
        </tr>
        <tr>
            <th>状态：</th>
            <td><label for="status_on"><input type="radio" id="status_on" name="status" value="1" <?php switch($result["status"]): case "1": ?>checked<?php break; endswitch;?> /> 启用</label><label for="status_off"><input type="radio" id="status_off" name="status" value="0" <?php switch($result["status"]): case "0": ?>checked<?php break; endswitch;?> /> 禁用</label></td>
            <th>打开方式：</th>
            <td><label for="open_type_on"><input type="radio" id="open_type_on" name="open_type" value="0" <?php switch($result["open_type"]): case "0": ?>checked<?php break; endswitch;?> /> Ajax</label><label for="open_type_off"><input type="radio" id="open_type_off" name="open_type" value="1" <?php switch($result["open_type"]): case "1": ?>checked<?php break; endswitch;?> /> Iframe</label></td>
        </tr>
        <tr>
            <th>条件状态：</th>
            <td><label for="type_on"><input type="radio" id="type_on" name="type" value="1" <?php switch($result["type"]): case "1": ?>checked<?php break; endswitch;?> /> 启用</label><label for="type_off"><input type="radio" id="type_off" name="type" value="0" <?php switch($result["type"]): case "0": ?>checked<?php break; endswitch;?> /> 禁用</label></td>
            <th>条件：</th>
            <td><input type="text" name="condition" class="easyui-textbox" data-options="" value="<?php echo ($result["condition"]); ?>" style="width:100%;height:25px;" /></td>
        </tr>
        <tr>
            <th>排序：</th>
            <td><input type="text" name="sort" class="easyui-textbox" data-options="required:true" value="<?php echo ($result["sort"]); ?>" style="width:100%;height:25px;" /></td>
            <th>图标：</th>
            <td><input type="text" name="iconcls" class="easyui-textbox" data-options="required:true" value="<?php echo ($result["iconcls"]); ?>" style="width:100%;height:25px;" /></td>
        </tr>
        <tr>
            <th>上级菜单：</th>
            <td colspan="3"><input type="text" name="pid" class="easyui-combotree" data-options="url:'<?php echo U('Menu/Manage');?>',queryParams:{combotree:true},required:true" value="<?php echo ($result["pid"]); ?>" style="width:100%;height:25px;" /></td>
        </tr>
        <tr>
            <td colspan="4">
                <input type="button" value="编辑" class="table_form_submit_dialog" style="float:right;margin-right:0px;" />
                <button type="button" class="table_form_close_dialog" style="float:right;">取消</button>
            </td>
        </tr>
    </table>
    <input type="hidden" name="id" value="<?php echo ($result["id"]); ?>" />
</form>