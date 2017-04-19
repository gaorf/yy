<?php
namespace Yy\Model;
use Think\Model;
class CategoryModel extends Model{
    
   protected $_validate = array(
       array('cat_name','require','分类名称必须填写~'),
       array('sort_order','number','排序值必须是数字~')
   );
    
   protected $_auto = array(
       array('status','get_switch',self::MODEL_BOTH,'function'),
       array('is_nav','get_switch',self::MODEL_BOTH,'function')
   );
   
   
   public function getCategoryTree($pid=0,$sid=0){
       $data = $this->where(array('pid'=>$pid))->select();
       $tree = new \Common\Util\Tree($data);
       $str = "<option value='\$id'>\$cat_name</option>";
       $select_category = $tree->getTree($pid,$str,$sid);
       return $select_category;
   }
    
}