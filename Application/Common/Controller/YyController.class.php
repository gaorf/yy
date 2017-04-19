<?php
namespace Common\Controller;
use Think\Controller;
class YyController extends Controller{
    
    public function _initialize(){
        
        defined('UID') || define('UID', is_login());
        defined('IS_ROOT') ||  define('IS_ROOT', is_administrator());
        if( !UID ){// 还没登录 跳转到登录页面
            $this->redirect('Public/login');
        }
        
        
    }
    
    
    
}