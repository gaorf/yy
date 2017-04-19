<?php
namespace User\Api;
define('UC_CLIENT_PATH', dirname(dirname(__FILE__)));

require_cache(UC_CLIENT_PATH . '/Common/config.php');
//载入函数库文件
require_cache(UC_CLIENT_PATH . '/Common/common.php');
use User\Model\UcenterMemberModel;
class UserApi
{
    protected $model;
    public function __construct(){
        $this->model = new UcenterMemberModel();
    }
    
    public function login($username,$password,$type=1){
        return $this->model->login($username, $password,$type);
    }
    
    public function register($username,$password){
        return $this->model->register($username, $password);
    }
    
    public function updateInfo($uid, $password, $data,$type=true){
        if($this->model->updateUserFields($uid, $password, $data,$type) !== false){
            $return['status'] = true;
        }else{
            $return['status'] = false;
            $return['info'] = $this->model->getError();
        }
        return $return;
    }
    
  
}