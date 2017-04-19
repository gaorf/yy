<?php
namespace Yy\Model;
use Think\Model;
class CompanyModel extends Model{

    protected $_auto = array(
        array('status','get_switch',self::MODEL_BOTH,'function')
    );    
}