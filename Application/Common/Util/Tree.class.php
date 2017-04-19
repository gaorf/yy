<?php
namespace Common\Util;
class Tree{
    private $arr = array();
    private $icon = array('│','├','└');
	private $nbsp = "";
	private $ret = '';
	
	public function __construct(array $arr,$icon=array('│','├','└'),$nbsp="&nbsp;"){
	    $this->arr = $arr;
	    $this->icon = $icon;
	    $this->nbsp = $nbsp;
	    $this->ret = '';
	}
	
	/**
	 * 获取当前ID的子级数组
	 * @param integer $pid
	 * @return array
	 */
	public function getChild($myid){
	    $newArr = array();
	    if(is_array($this->arr)){
	        foreach ($this->arr as $id=>$val){
	            if($val['pid']==$myid) $newArr[$id] = $val; 
	        }
	    }
	    return $newArr?$newArr:false;
	}
	/**
	 * 获取属性结构
	 * @param int $myid 获取该PID下的数据
	 * @param string $str 生成树型结构的基本代码，例如："<option value=\$id \$selected>\$spacer\$name</option>"
	 * @param int $sid 默认选中ID
	 * @param string $adds
	 * @param string $pk
	 */
	public function getTree($myid,$str,$sid = 0, $adds = '',$pk="id"){
	    $number = 1;
	    $child = $this->getChild($myid);
	    if(is_array($child)){
	        $total = count($child);
	        foreach ($child as $id=>$val){
	            $j=$k='';
	            if($total == $number){
	                $j .= $this->icon[2];
	            }else{
	                $j .= $this->icon[1];
	                $k = $adds ? $this->icon[0] : '';
	            }
	            $spacer = $adds ? $adds.$j : '';
				$selected = $val[$pk]==$sid ? 'selected' : '';
	            extract($val);
	            eval("\$nstr = \"$str\";");
	            $this->ret .= $nstr;
	            $nbsp = $this->nbsp;
	            $this->getTree($id, $str, $sid, $adds.$k.$nbsp,$pk);
	            $number++;
	        }
	    }
	    return $this->ret;
	}
}