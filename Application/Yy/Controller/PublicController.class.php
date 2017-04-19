<?php
namespace Yy\Controller;
use Think\Controller;
class PublicController extends Controller {
    /**
     * 登录
     */
    public function login($username='', $password='', $verify=''){
        if (IS_AJAX){
            if (!check_verify($verify)){
                $this->error('验证码错误!');
            }
            $uc = new \User\Api\UserApi();
            $uid = $uc->login($username, $password);
            if(0<$uid){
                $manager = D('Manager');
                if($manager->login($uid)){
                    $this->success('登录成功！',U('Index/index'));
                }else{
                    $this->error($manager->getError());
                }
            }else{
                switch($uid) {
                    case -1: $error = '用户不存在或被禁用！'; break;
                    case -2: $error = '密码错误！'; break;
                    default: $error = '未知错误！'; break;
                }
                $this->error($error);
            }
            
        }else{
            if(is_login()){
                $this->redirect('Index/index');
            }
            $this->display();
        }
    }
    public function logout(){
        D('Manager')->logout();
        session('[destroy]');
        $this->redirect('Public/login');
    }
    /**
     * 验证码
     */
    public function verify(){
        $Verify = new \Think\Verify();
        $Verify->length=4;
        $Verify->fontSize = 16;
        //$Verify->imageW = ;
        //$Verify->imageH=;
        $Verify->entry();
    }
}