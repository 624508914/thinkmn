<?php if (!defined('THINK_PATH')) exit();?><form action="javascript:void(0)" class="table_form">
    <table class="table_list">
        <tr>
            <th>ID：</th>
            <td width="100"><?php echo ($result["id"]); ?></td>
            <th>名称：</th>
            <td width="100"><?php echo ($result["title"]); ?></td>
        </tr>
        <tr>
            <th>状态：</th>
            <td><span class="<?php switch($result["status"]): case "0": ?>fa fa-remove<?php break; case "1": ?>fa fa-check<?php break; endswitch;?>"></span></td>
            <th>路径：</th>
            <td><input type="text" name="key" class="easyui-textbox" data-options="disabled:true" style="width:100%;height:25px;" value="<?php echo ($result["name"]); ?>" /></td>
        </tr>
        <tr>
            <th>条件状态：</th>
            <td><span class="<?php switch($result["type"]): case "0": ?>fa fa-remove<?php break; case "1": ?>fa fa-check<?php break; endswitch;?>"></span></td>
            <th>条件：</th>
            <td><input type="text" name="key" class="easyui-textbox" data-options="disabled:true" style="width:100%;height:25px;" value="<?php echo ($result["condition"]); ?>" /></td>
        </tr>
        <tr>
            <th>排序：</th>
            <td><?php echo ($result["sort"]); ?></td>
            <th>图标：</th>
            <td><span class="<?php echo ($result["style"]); ?>"></span></td>
        </tr>
        <tr>
            <th>上级菜单：</th>
            <td><?php echo (get_menu_info($result["rule_id"],'title')); ?></td>
            <th>打开方式：</th>
            <td>
                <?php switch($result["open_type"]): case "0": ?>Ajax<?php break;?>
                    <?php case "1": ?>Iframe<?php break; endswitch;?>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <button type="button" class="table_form_close_dialog" style="float:right">关闭</button>
            </td>
        </tr>
    </table>
</form>