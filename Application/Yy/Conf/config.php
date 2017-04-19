<?php
return array(
    //'配置项'=>'配置值'
    'TMPL_PARSE_STRING' => array(
        '__PUBLIC__' => __ROOT__ . '/Public/Yy/',
        '__HUI__'=>__ROOT__.'/Public/Yy/hui/',
        '__CSS__' => __ROOT__ . '/Public/Yy/css/',
        '__JS__' => __ROOT__ . '/Public/Yy/js/',
        '__IMG__' => __ROOT__ . '/Public/Yy/images/',
        '__STATICS__' => __ROOT__ . '/Public/Statics/'
    ),
    'TMPL_ACTION_SUCCESS'   =>  APP_PATH.'Tpl/dispatch_jump.tpl', // 默认成功跳转对应的模板文件
);