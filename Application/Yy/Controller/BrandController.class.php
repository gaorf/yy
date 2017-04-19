<?php
namespace Yy\Controller;
use Common\Controller\YyController;
class BrandController extends YyController{
    
    public function index(){
        $Brand  = D('Brand');
        $list = $Brand->relation(true)->select();
        $list = int_to_string($list, ['status'=>['1'=>'启用','-1'=>'<span class="c-error">禁用</span>']]);
        $this->list = $list;
        $this->display();
    }
    
    
    public function addBrand(){
        $Company_list = M('Company')->where(['status'=>1])->select();
        $this->Company_list = $Company_list;
        
        $this->show_nav = 1;
        $this->header_title = '添加品牌';
        $this->display('brand');
    }
    
    public function eidtBrand(){
        $Brand = D('Brand');
        $id = I('get.id');
        $row = $Brand->relation(true)->where(array('id'=>$id))->find();
        $this->row = $row;
        
        $Company_list = M('Company')->where(['status'=>1])->select();
        $this->Company_list = $Company_list;
        
        
        $this->show_nav = 1;
        $this->header_title = '编辑品牌';
        $this->display('brand');
    }
    
    public function writeBrand(){
        $Brand = D('Brand');
        $data = $Brand->create();
        if($data){
            if(empty($data['id'])){
                $r = $Brand->add($data);
            }else{
                $r = $Brand->save($data);
            }
            if($r===false){
                $this->error('操作失败'.$Brand->getError());
            } else {
                $this->success('操作成功!',U('index'));
            }
        }else{
            $this->error('操作失败'.$Brand->getError());
        }
    }
    
    function deleteBrand(){
        $Brand = M('Brand');
        $id = I('get.id');
        if($Brand->where(['id'=>$id])->delete()){
            $this->success('操作成功!',U('index'));
        }else{
            $this->error('操作失败');
        }
    }
    
}