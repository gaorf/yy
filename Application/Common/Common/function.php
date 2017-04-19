<?php
/**
 * 验证码验证
 * @param string $code
 * @param string $id
 * @return boolean
 */
function check_verify($code,$id=''){
    $verify = new \Think\Verify();
    return $verify->check($code,$id);
}
/**
 * 是否登录
 * @return integer
 */
function is_login(){
    $user = session('user_auth');
    if (empty($user)) {
        return 0;
    } else {
        return $user['uid'] ? $user['uid'] : 0;
    }
}
/**
 * 是否为超级管理员
 * @param integer $uid
 */
function is_administrator($uid = null){
    $uid = is_null($uid) ? is_login() : $uid;
    return $uid && (intval($uid) === C('USER_ADMINISTRATOR'));
}