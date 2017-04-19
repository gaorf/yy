<?php
namespace Yy\Model;
use Think\Model;
class ManagerModel extends Model{
    
    /**
     * 登录
     * @param integer $uid
     */
    public function login($uid){
        $user = $this->field(true)->find($uid);
        if(!$user || 1 != $user['status']){
            $this->error = '用户不存在或已被禁用！';
            return false;
        }
        $this->autoLogin($user);
        
        return true;
    }
    /**
     * 注销当前用户
     * @return void
     */
    public function logout(){
        session('user_auth', null);
    }
    
    /**
     * 自动登录用户
     * @param  integer $user 用户信息数组
     */
    private function autoLogin($user){
        /* 更新登录信息 */
        $data = array(
            'uid'             => $user['uid'],
            'login'           => array('exp', '`login`+1'),
            'last_login_time' => NOW_TIME,
            'last_login_ip'   => get_client_ip(1),
        );
        $this->save($data);
    
        /* 记录登录SESSION和COOKIES */
        $auth = array(
            'uid'             => $user['uid'],
            'username'        => $user['nickname'],
            'real_name'       => $user['real_name'],
            'last_login_time' => $user['last_login_time']
        );
    
        session('user_auth', $auth);
        //session('user_auth_sign', data_auth_sign($auth));
    }
    
}