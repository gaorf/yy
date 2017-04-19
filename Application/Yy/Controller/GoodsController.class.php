<?php
namespace Yy\Controller;
use Common\Controller\YyController;
class GoodsController extends YyController{
    
    
    public function index(){
        
        
        $this->display();
    }
    
    public function addGoods(){
        
        
        
        $Company_list = M('Company')->where(['status'=>1])->select();
        $this->Company_list = $Company_list;
        
        $this->show_nav = 1;
        $this->header_title = '添加产品';
        $this->display();
    }
    
    
    public function getCompanyBrand(){
        $company_id = I('get.company_id');
        $list = D('Brand')->getCompanyBrand($company_id);
        return $this->ajaxReturn($list);
    }
    
    
    public function getCategory(){
       $pid = I('get.pid');
       $sid = I('get.sid');
       $list = D('Category')->getCategoryTree($pid,$sid);
       echo $list;
    }
    
}