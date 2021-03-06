<?php if (!defined('THINK_PATH')) exit();?><table id="AdminMenu"></table>
<script>
$.Admin.Menu = {
    //组件ID
    'id' : '#AdminMenu',
    
    //工具栏
    'tools' : [
        { text: '展开', iconCls: 'fa fa-folder-o', handler: function(){
                $.Admin.Menu.ExpandMenu();
            } 
        },
        { text: '收缩', iconCls: 'fa fa-folder-open-o', handler: function(){
                $.Admin.Menu.CollapseMenu();
            }
        },
        { text: '查看', iconCls: 'fa fa-search', handler: function(){
                $.Admin.Menu.ViewMenu();
            } 
        },
        { text: '添加', iconCls: 'fa fa-plus', handler: function(){
                $.Admin.Menu.AddMenu();
            } 
        },
        { text: '编辑', iconCls: 'fa fa-edit', handler: function(){
                $.Admin.Menu.EditMenu();
            } 
        },
        { text: '删除', iconCls: 'fa fa-remove', handler: function(){
                $.Admin.Menu.DelMenu();
            } 
        },
        { text: '排序', iconCls: 'fa fa-sort', handler: function(){
                $.Admin.Menu.SortMenu();
            } 
        }
    ],

    //展开菜单
    'ExpandMenu' : function(){
        var get_select_row = $($.Admin.Menu.id).treegrid('getSelected');
        if(get_select_row == null){
            $($.Admin.Menu.id).treegrid('expandAll');
        } else {
            $($.Admin.Menu.id).treegrid('expandAll',get_select_row.id);
        }
    },

    //收缩菜单
    'CollapseMenu' : function(){
        var get_select_row = $($.Admin.Menu.id).treegrid('getSelected');
        if(get_select_row == null){
            $($.Admin.Menu.id).treegrid('collapseAll');
        } else {
            $($.Admin.Menu.id).treegrid('collapseAll',get_select_row.id);
        }
    },
    
    //查看菜单
    'ViewMenu' : function(){
        var get_select_row = $($.Admin.Menu.id).treegrid('getSelected');
        if(get_select_row == null){
            $.Admin.tips('温馨提示信息', '请先选择 您要查看的数据行','error');
            return false;
        }
        var id = $.Admin.random_dialog();
        $(id).dialog({
            title: '查看菜单',
            iconCls: 'fa fa-search',
            queryParams: {id: get_select_row.id},
            href: '<?php echo U("Menu/viewMenu");?>',
            modal: true,
            width: 500,
            onClose : function(){
                $(this).dialog("destroy");
            },
            onOpen : function(){
                var top = $(this).offset().top-$(this).position().top;
                $(this).dialog('resize',{
                    top: (top/2)+'px'
                });
            }
        });
    },
    
    //添加菜单
    'AddMenu' : function(){
        var data = {};
        var getSelectedRow = $($.Admin.Menu.id).treegrid('getSelected');
        if(getSelectedRow != null){
            data = {id:getSelectedRow.id};
        }
        var id = $.Admin.random_dialog();
        $(id).dialog({
            title: '添加菜单',
            iconCls: 'fa fa-plus',
            queryParams: data,
            href: '<?php echo U("Menu/addMenu");?>',
            modal: true,
            width: 500,
            onClose : function(){
                $(this).dialog("destroy");
            },
            onOpen : function(){
                var top = $(this).offset().top-$(this).position().top;
                $(this).dialog('resize',{
                    top: (top/2)+'px'
                });
            }
        });
    },
    
    //编辑菜单
    'EditMenu' : function(){
        var data = {};
        var getSelectedRow = $($.Admin.Menu.id).treegrid('getSelected');
        if(getSelectedRow == null){
            $.Admin.tips('温馨提示信息', '请先选择 您要编辑的数据行','error');
            return false;
        }
        data = {id:getSelectedRow.id};
        var id = $.Admin.random_dialog();
        $(id).dialog({
            title: '编辑菜单',
            iconCls: 'fa fa-edit',
            queryParams: data,
            href: '<?php echo U("Menu/editMenu");?>',
            modal: true,
            width: 500,
            onClose : function(){
                $(this).dialog("destroy");
            },
            onOpen : function(){
                var top = $(this).offset().top-$(this).position().top;
                $(this).dialog('resize',{
                    top: (top/2)+'px'
                });
            }
        });
    },
    
    //删除菜单
    'DelMenu' : function(){
        var data = {};
        var get_select_row = $($.Admin.Menu.id).treegrid('getSelected');
        if(get_select_row == null){
            $.Admin.tips('温馨提示信息', '请先选择 您要删除的数据行','error');
            return false;
        }
        
        data = {id:get_select_row.id};
        $.messager.confirm('系统提示', '此次将删除该分类与其下所有子分类<br />请慎重考虑，是否继续？', function (res) {
            if(res){
                $.Admin.del_action('<?php echo U("Menu/DelMenu");?>',data);
            }
        });
    },
    
    //排序菜单
    'SortMenu' : function(){
        var sort_list = $($.Admin.Menu.id).parent().find(".sortbox-text").serialize();
        var temp_sort_lsit = sort_list.split('&');
        for(x in temp_sort_lsit){
            var temp_sort = temp_sort_lsit[x].split('=');
            if(temp_sort[1] == ''){
                $.Admin.tips('温馨提示信息', 'ID：'+temp_sort[0].split('%5B')[1].split('%5D')[0]+' 的菜单项排序值为空','error');
                return false;
            }
        }
        //ajax提交数据处理
        $.ajax({
            type: 'POST',
            url: '<?php echo U("Menu/SortMenu");?>',
            data: sort_list,
            dataType:"json",
            beforeSend: function(){
                $.messager.progress({text:'处理中，请稍候...'});
            },
            success: function(data){
                if(!data.status){
                    $.Admin.tips('失败提示信息', data.info,'error');
                } else {
                    $.Admin.tips('成功提示信息', data.info,'info');
                    $.Admin.refresh_tabs();
                }
            },
            error: function(data){
                $.Admin.tips('错误提示信息', data.responseText,'error');
            }
        });
    },
    
    //函数格式化
    'formatter' : {
        'type' : function(value,row,index){
            if(parseInt(value)){
                return "<span class='fa fa-check text-primary'></span>";
            } else {
                return "<span class='fa fa-remove text-danger'></span>";
            }
        },
        'status' : function(value,row,index){
            if(parseInt(value)){
                return "<span class='fa fa-check text-primary'></span>";
            } else {
                return "<span class='fa fa-remove text-danger'></span>";
            }
        },
        'sort' : function(value,row,index){
            return '<span class="textbox" style="margin:5px 0px;"><input type="text" name="sort['+row.id+']" class="textbox-text sortbox-text" style="text-align:center;color:#000;padding-top: 4px; padding-bottom: 4px;width:30px;" value="'+value+'" /></span>';
        },
        'iconCls' : function(value,row,index){
            return "<span class='"+value+"'></span>";
        },
        'open_type' : function(value,row,index){
            if(parseInt(value)){
                return "Iframe";
            } else {
                return "Ajax";
            }
        }
    }
}
//Menu Extends Admin End

$($.Admin.Menu.id).treegrid({
    title: '<?php echo ($Position); ?>',
    border: false,
    toolbar: $.Admin.Menu.tools,
    fitColumns: true,
    fit: true,
    ctrlSelect: true,
    singleSelect: false,
    rownumbers: true,
    animate: true,
    idField: 'id',
    treeField: 'title',
    url: "<?php echo U('Menu/Manage');?>",
    columns:[[
        {field:'ck',checkbox:true},    
        {field:'id',title:'ID',align:'center',width:20},
        {field:'title',title:'名称',width:100},
        {field:'name',title:'路径',width:100},
        {field:'type',title:'条件状态',align:'center',formatter:$.Admin.Menu.formatter.type,width:40},
        {field:'condition',title:'条件规则',width:80},
        {field:'status',title:'状态',align:'center',formatter:$.Admin.Menu.formatter.status,width:40},
        {field:'sort',title:'排序',align:'center',formatter:$.Admin.Menu.formatter.sort,width:40},
        {field:'iconCls',title:'图标',align:'center',formatter:$.Admin.Menu.formatter.iconCls,width:40},
        {field:'open_type',title:'打开方式',align:'center',formatter:$.Admin.Menu.formatter.open_type,width:40}
    ]],
    onDblClickRow: function(row){
        $.Admin.Menu.ViewMenu();
    },
    onContextMenu: function(e,row){
        e.preventDefault();//阻止浏览器捕获右键事件
        $(this).treegrid("unselectAll"); //取消所有选中项
        $(this).treegrid("select", row.id); //根据索引选中该行
        $('#AdminMenu_menu').menu('show',{
            left: e.pageX,
            top: e.pageY
        });
    }
});
</script>
<div id="AdminMenu_menu" class="easyui-menu" style="display:none;">
    <div data-options="iconCls:'fa fa-folder-o'" onclick="$.Admin.Menu.ExpandMenu()">展开</div>
    <div data-options="iconCls:'fa fa-folder-open-o'" onclick="$.Admin.Menu.CollapseMenu()">收缩</div>
    <div data-options="iconCls:'fa fa-search'" onclick="$.Admin.Menu.ViewMenu()">查看</div>
    <div data-options="iconCls:'fa fa-plus'" onclick="$.Admin.Menu.AddMenu()">添加</div>
    <div data-options="iconCls:'fa fa-edit'" onclick="$.Admin.Menu.EditMenu()">编辑</div>
    <div data-options="iconCls:'fa fa-remove'" onclick="$.Admin.Menu.DelMenu()">删除</div>
    <div data-options="iconCls:'fa fa-sort'" onclick="$.Admin.Menu.SortMenu()">排序</div>
</div>