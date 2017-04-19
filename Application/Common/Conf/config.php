<?php
return array(
	//'配置项'=>'配置值'
	'DEFAULT_MODULE' => 'Index',
    /*加密因子*/
    'DATA_AUTH_KEY' => 't2m*[Z(ba`.!@y9MJ1#qRnEuo]eSrWdHhKLI+OAU', //默认数据加密KEY
    /*超级管理员ID*/
    'USER_ADMINISTRATOR' => 1, //管理员用户ID
    //'DEFAULT_TIMEZONE'=>'Asia/chongqing',
    //数据库
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'yy', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => '123456', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'yy_', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集
    //session
    'SESSION_OPTIONS'=>array(
        'name'=>'YYSESSION',
        'expire' => 3600
    ),
    'SESSION_TYPE' => 'Mysqli',
    
    'TAGLIB_BUILD_IN'    =>    'cx,Common\Tag\MyHtml'
);