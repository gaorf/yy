<?php
namespace User\Model;
use Think\Model;
class UcenterMemberModel extends Model
{
    /* 用户模型自动验证 */
    protected $_validate = array(
        /* 验证用户名 */
        array('username', '1,30', -1, self::EXISTS_VALIDATE, 'length'), //用户名长度不合法
        array('username', 'checkDenyMember', -2, self::EXISTS_VALIDATE, 'callback'), //用户名禁止注册
        array('username', '', -3, self::EXISTS_VALIDATE, 'unique'), //用户名被占用
        array('username', 'email', -12, self::EXISTS_VALIDATE), //用户名必须是邮箱
    
        /* 验证密码 */
        array('password', '6,30', -4, self::EXISTS_VALIDATE, 'length'), //密码长度不合法
    
        /* 验证邮箱 */
        array('email', 'email', -5, self::EXISTS_VALIDATE), //邮箱格式不正确
        array('email', '1,32', -6, self::EXISTS_VALIDATE, 'length'), //邮箱长度不合法
        array('email', 'checkDenyEmail', -7, self::EXISTS_VALIDATE, 'callback'), //邮箱禁止注册
        array('email', '', -8, self::EXISTS_VALIDATE, 'unique'), //邮箱被占用
    
        /* 验证手机号码 */
        array('mobile', '//', -9, self::EXISTS_VALIDATE), //手机格式不正确 TODO:
        array('mobile', 'checkDenyMobile', -10, self::EXISTS_VALIDATE, 'callback'), //手机禁止注册
        array('mobile', '', -11, self::EXISTS_VALIDATE, 'unique'), //手机号被占用
    );
    
    /* 用户模型自动完成 */
    protected $_auto = array(
        array('password', 'password_sha1', self::MODEL_BOTH, 'function', UC_AUTH_KEY),
        array('reg_time', NOW_TIME, self::MODEL_INSERT),
        array('reg_ip', 'get_client_ip', self::MODEL_INSERT, 'function', 1),
        array('update_time', NOW_TIME),
        array('status', 'getStatus', self::MODEL_BOTH, 'callback'),
    );
    /**
     * 检测用户名是不是被禁止注册
     * @param  string $username 用户名
     * @return boolean          ture - 未禁用，false - 禁止注册
     */
    protected function checkDenyMember($username){
        return true; 
    }
    /**
     * 根据配置指定用户状态
     * @return integer 用户状态
     */
    protected function getStatus(){
        return true; 
    }
    /**
     * 添加用户
     * @param string $username
     * @param string $password
     */
    public function register($username,$password){
        $data = array(
            'username' => $username,
            'password' => $password
        );
        
        /* 添加用户 */
        if($this->create($data)){
            $uid = $this->add();
            return $uid ? $uid : 0; //0-未知错误，大于0-注册成功
        } else {
            return $this->getError(); //错误详情见自动验证注释
        }
    }
    /**
     * 登录
     * @param unknown $username
     * @param unknown $password
     * @param number $type 1表示用户名登录
     */
    public function login($username,$password,$type=1){
    	$map = array();
		switch ($type) {
			case 1:
				$map['username'] = $username;
				break;
			case 2:
				$map['email'] = $username;
				break;
			case 3:
				$map['mobile'] = $username;
				break;
			case 4:
				$map['id'] = $username;
				break;
			default:
				return 0; //参数错误
		}

		/* 获取用户数据 */
		$user = $this->where($map)->find();
		if(is_array($user) && $user['status']){
			/* 验证用户密码 */
			if( password_sha1($password, UC_AUTH_KEY) === $user['password'] ){
				$this->updateLogin($user['id']); //更新用户登录信息
				return $user['id']; //登录成功，返回用户ID
			} else {
				return -2; //密码错误
			}
		} else {
			return -1; //用户不存在或被禁用
		}
    }
    
    /**
     * 更新用户登录信息
     * @param  integer $uid 用户ID
     */
    protected function updateLogin($uid){
        $data = array(
            'id'              => $uid,
            'last_login_time' => NOW_TIME,
            'last_login_ip'   => get_client_ip(1),
        );
        $this->save($data);
    }
    
    
    /**
     * 更新用户信息
     * @param unknown $uid
     * @param unknown $password
     * @param unknown $data
     */
    public function updateUserFields($uid, $password, $data,$type){
        if(empty($uid) || empty($data)){
            $this->error = '参数错误！';
            return false;
        }
    
        //更新前检查用户密码
        //如果type 为false 则不验证//供后台使用
        if($type===true){
            if(!$this->verifyUser($uid, $password)){
                $this->error = '验证出错：密码不正确！';
                return false;
            }
        }
    
        //更新用户信息
        $data = $this->create($data);
        if($data){
            return $this->where(array('id'=>$uid))->save($data);
        }
        return false;
    }
    /**
     * 验证用户密码
     * @param int $uid 用户id
     * @param string $password_in 密码
     * @return true 验证成功，false 验证失败
     */
    protected function verifyUser($uid, $password_in){
        $password = $this->getFieldById($uid, 'password');
        if(password_sha1($password_in, UC_AUTH_KEY) === $password){
            return true;
        }
        return false;
    }
}