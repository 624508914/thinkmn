<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>
	<title>通用后台管理系统</title>
	<script src="/thinkmn/Public/Static/js/jquery.min.js"></script>
    <link rel="stylesheet" href="/thinkmn/Public/Easyui/1.4.4/themes/bootstrap/easyui.css">
    <link rel="stylesheet" href="/thinkmn/Public/Easyui/1.4.4/themes/icon.css">
    <script src="/thinkmn/Public/Easyui/1.4.4/jquery.easyui.min.js"></script>
    <script src="/thinkmn/Public/Easyui/1.4.4/locale/easyui-lang-zh_CN.js"></script>
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="/thinkmn/Public/Admin/js/jquery.all.event.js"></script>
    <script src="/thinkmn/Public/Admin/js/jquery.admin.js"></script>
    <link href="/thinkmn/Public/Admin/css/main.css" rel="stylesheet">
    <script src="/thinkmn/Public/Admin/js/main.js"></script>
</head>
<body class="easyui-layout" data-url="">
<div id="body-lock-screen-loading">
    <table width="100%" height="100%" align="center">
        <tbody>
            <tr>
                <td><i class="fa fa-spinner fa-spin" style="font-size: 36px"></i></td>
            </tr>
        </tbody>
    </table>
</div>
<!--顶部 Start-->
<div id="north" data-options="region: 'north'" style="height:80px;overflow:hidden;">
    <ul class="north-head">
        <li class="pull-left"><h1>通用后台管理系统</h1></li>
        <li class="pull-right">
            <a class="easyui-linkbutton window-open" data-options="plain:true,iconCls:'fa fa-globe'" data-href="/">访问首页</a>
            <a class="easyui-splitbutton" data-options="menu:'#ID-FB03-F3BD-D9D2-4CF1',iconCls:'fa fa-user'"><?php echo ($user_info["info"]["nickname"]); ?></a>
            <a class="easyui-splitbutton" data-options="menu:'#ID-DE01-DD0C-13C4-8397',iconCls:'fa fa-question-circle'">帮助中心</a>
        </li>
    </ul>
    
    <div class="north-navbar">
        <ul>
            <?php if(is_array($top_menu)): foreach($top_menu as $key=>$nav): ?><li><a class="navbar-button" data-href="<?php echo U('Index/getSonMenu');?>" data-id="<?php echo ($nav["id"]); ?>" data-level="1" data-icon="<?php echo ($nav["iconcls"]); ?>"><?php echo ($nav["title"]); ?></a></li><?php endforeach; endif; ?>
        </ul>
    </div>
</div>
<!--顶部 End-->
<!--左侧 Start-->
<div id="west" data-options="region: 'west',title:'左侧菜单',tools: [{iconCls:'fa fa-refresh',handler:function(){$.Admin.reload_all_left_menu();}},{   iconCls:'fa fa-folder-o',handler:function(){$.Admin.collapse_all_left_menu();}},{iconCls:'fa fa-folder-open-o',handler:function(){$.Admin.expand_all_left_menu();}}]" style="width:170px;">
    <div id="left" class="easyui-accordion" data-options="fit:false,border:false"></div>
</div>
<!--左侧 End-->
<!--右边 Start-->
<div id="center" data-options="region:'center'">
    <div id="layout-tabs" class="easyui-tabs" data-options="tabPosition:'top',fit:true,border:false,plain:false">
        <div data-options="title: '欢迎页面', href: '<?php echo U('Index/Main');?>', iconCls: 'fa fa-home', closable: true, cache: true, tools:[{iconCls:'icon-mini-refresh',handler:function(){$.Admin.refresh_tabs();}}]"></div>
    </div>

</div>
<!--右边 End-->
<!--底部 Start-->
<div id="south" data-options="region:'south'" style="height:30px;line-height:30px;text-align:center;overflow:hidden;">@2016 版权所有 通用后台管理系统</div>
<!--底部 End-->
<div id="ID-FB03-F3BD-D9D2-4CF1">
    <?php if(is_array($user_info['groups'])): foreach($user_info['groups'] as $key=>$vo): ?><div iconCls="fa fa-group" data-width="400" data-height="280"><?php echo ($vo["title"]); ?></div><?php endforeach; endif; ?>
    <div class="menu-sep"></div>
    <div iconCls="fa fa-edit" data-href="/admin/index/public_userinfo.html" data-width="400" data-height="280">个人信息</div>
    <div iconCls="fa fa-key" data-href="/admin/index/public_userpwd.html" data-width="400" data-height="250">修改密码</div>
    <div class="menu-sep"></div>
    <div class="window-location-confirm" iconCls="fa fa-sign-out"  data-msg="确定要退出系统吗？" data-href="<?php echo U('Login/logout');?>">退出登录</div>
</div>
<div id="ID-DE01-DD0C-13C4-8397">
    <div iconCls="fa fa-trash-o" data-href="/admin/index/public_clearcatche.html" data-width="350" data-height="200">清除缓存</div>
    <div iconCls="fa fa-bar-chart" data-href="/admin/index/public_sysinfo.html" data-width="600" data-height="400">系统信息</div>
    <div iconCls="fa fa-send-o" data-href="/admin/index/public_feedback.html" data-width="400" data-height="300">留言反馈</div>
    <div class="menu-sep"></div>
    <div iconCls="fa fa-book" data-type="iframe" data-href="http://www.jeasytp.com/doc.html">开发文档</div>
    <div iconCls="fa fa-globe" data-type="iframe" data-href="http://www.jeasytp.com">官方网站</div>
    <div class="menu-sep"></div>
    <div iconCls="fa fa-expand">全屏模式</div>
    <div iconCls="fa fa-info-circle" data-href="/admin/index/public_about.html" data-width="400" data-height="300">关于系统</div>
</div>
<div id="dialog-box"></div>
</body>
</html>