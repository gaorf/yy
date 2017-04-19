<?php
namespace Yy\Controller;
use Common\Controller\YyController;
class CompanyController extends YyController{
    
    public function index(){
        $Company  = M('Company');
        $list = $Company->select();
        $list = int_to_string($list, ['status'=>['1'=>'启用','-1'=>'<span class="c-error">禁用</span>']]);
        $this->list = $list;
        $this->display();
    }
    
    
    public function addCompany(){ 
        $this->show_nav = 1;
        $this->display('company');
    }
    
    public function eidtCompany(){
        $Company = M('Company');
        $id = I('get.id');
        $row = $Company->where(array('id'=>$id))->find();
        $this->row = $row;
        $this->show_nav = 1;
        $this->header_title = '编辑企业';
        $this->display('company');
    }
    
    public function writeCompany(){
        $Company = D('Company');
        $data = $Company->create();
        if($data){
            if(empty($data['id'])){
                $r = $Company->add($data);
            }else{
                $r = $Company->save($data);
            }
            if($r===false){
                $this->error('操作失败'.$Company->getError());
            } else {
                $this->success('操作成功!',U('index'));
            }
        }else{
            $this->error('操作失败'.$Company->getError());
        }
    }
    
    function deleteCompany(){
        $Company = M('Company');
        $id = I('get.id');
        if($Company->where(['id'=>$id])->delete()){
            $this->success('操作成功!',U('index'));
        }else{
            $this->error('操作失败');
        }
    }
    
}