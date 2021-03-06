<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>
    <title>通用后台管理系统</title>
    <script src="/thinkmn/Public/Static/js/jquery.min.js"></script>
    <link href="/thinkmn/Public/Bootstrap/V3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <script src="/thinkmn/Public/Bootstrap/V3.3.5/js/bootstrap.min.js"></script>
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="/thinkmn/Public/Admin/js/jquery.all.event.js"></script>
    <style>
    /*登录样式 Start*/
    body{margin:0px;padding:0px;font: 13px "Microsoft Yahei", "宋体", "Arial Narrow", HELVETICA !important;width: 100%;}
    .login{margin-top:150px;}
    .login .panel-heading{padding:15px 15px 0;font-size:18px;font-weight:bold;}
    .login .input-group-addon .fa{width:30px;}
    .login .btn{width:100%;margin-bottom:15px;}
    /*登录样式 End*/
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <div class="panel panel-primary login">
                <div class="panel-heading">
                    <div class="pull-left">通用后台管理系统</div>
                    <div class="pull-right"><a href="#" class="btn btn-info">返回主页</a></div>    
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <div class="login-tips"></div>
                    <form method="post" action="<?php echo U('Login/index');?>">
                        <div class="form-group form-group-lg">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="fa fa-2x fa-user"></span></div>
                                <input type="text" class="form-control" name="username" placeholder="账号">
                            </div>
                        </div>
                        <div class="form-group form-group-lg">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="fa fa-2x fa-lock"></span></div>
                                <input type="password" class="form-control" name="password" placeholder="密码">
                            </div>
                        </div>
                        <div class="form-group form-group-lg">
                            <div class="input-group">
                                <input type="text" class="form-control" name="code" placeholder="验证码">
                                <div class="input-group-addon" style="padding:0px;"><img src="<?php echo U('Verify/getCode');?>" id="getCode" height="44" /></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <button type="button" class="btn btn-default btn-lg">忘记密码</button>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <button type="button" class="btn btn-primary btn-lg" id="login-btn">立即登录</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="panel-footer text-right">@2016版权所有 吉安大众网</div>
            </div>
        </div>
    </div>
</div>
<script src="/thinkmn/Public/Admin/js/login.js"></script>
</body>
</html>