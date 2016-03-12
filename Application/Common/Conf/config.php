<?php
return array(
	//'配置项'=>'配置值'
    
    //系统框架配置项
    'DEFAULT_MODULE' => 'Admin',
    'URL_MODEL' => '2',
    
    //表单令牌配置项
    //'TOKEN_ON'      =>    true,  // 是否开启令牌验证 默认关闭
    //'TOKEN_NAME'    =>    '__hash__',    // 令牌验证的表单隐藏字段名称，默认为__hash__
    //'TOKEN_TYPE'    =>    'md5',  //令牌哈希验证规则 默认为MD5
    //'TOKEN_RESET'   =>    true,  //令牌验证出错后是否重置令牌 默认为true
    
    //数据库配置项
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => '127.0.0.1', // 服务器地址
    'DB_NAME'   => 'localhost82', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => 'root', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PARAMS' =>  array(), // 数据库连接参数
    'DB_PREFIX' => 'cms_', // 数据库表前缀 
    'DB_CHARSET'=> 'utf8', // 字符集
    'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
    
    //AUTH认证配置
    'AUTH_CONFIG'=>array(
		'AUTH_ON' => true, //认证开关
		'AUTH_TYPE' => 1, // 认证方式，1为时时认证；2为登录认证。
		'AUTH_GROUP' => 'cms_auth_group', //用户组数据表名
		'AUTH_GROUP_ACCESS' => 'cms_auth_group_access', //用户组明细表
		'AUTH_RULE' => 'cms_auth_rule', //权限规则表
		'AUTH_USER' => 'cms_admin'//用户信息表
	),

);