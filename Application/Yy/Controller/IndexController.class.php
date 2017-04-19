<?php
namespace Yy\Controller;
use Common\Controller\YyController;
class IndexController extends YyController {
    
    public function index(){
       
        $this->display();
    }
    public function welcome(){
        
        
        $info = M('Manager')->where(array('uid'=>UID))->find();
        
        $this->userinfo = $info;
        $this->display();
    }
}