<?php
/**
 * 密码sha1加密
 * @param unknown $str
 * @param unknown $key
 */
function password_sha1($str,$key){
    return ''===$str ? '' : sha1(md5($str).$key);
}
