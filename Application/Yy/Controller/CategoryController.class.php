<?php
namespace Yy\Controller;
use Common\Controller\YyController;
class CategoryController extends YyController{
    
    public function index(){
        
        $Category = M('Category');
        $data = $Category->order('sort_order ASC,id ASC')->select();
        $category_data = [];
        foreach ($data as $key=>$v){
            $v['str_manage'] = '<a href="'.U('Category/addCategory',array('pid'=>$v['id'])).'">添加子分类</a> | <a href="'.U('Category/editCategory',array('id'=>$v['id'])).'">修改</a> | <a href="'.U('Category/deletCategory',array('id'=>$v['id'])).'" onClick="return layer_del(this);">删除</a>';
            $category_data[] = $v;
        }
        $category_data = int_to_string($category_data,['is_nav'=>['1'=>'是','-1'=>'<span class="c-error">否</span>'],'status'=>['1'=>'正常'],'-1'=>'<span class="c-error">禁用</span>']);
        $str = "<tr>
            		<td class='text-c'><input type='text' name='listorders[\$id]' style='width:50px;' value='\$sort_order' class='input-text size-S text-c'/></td>
            		<td class='text-c'>\$id</td>
            		<td>\$spacer\$cat_name</td>
            		<td class='text-c'>\$is_nav</td>
            		<td class='text-c'>\$status</td>
            		<td class='text-c'>\$str_manage</td>
            	</tr>";
        $tree = new \Common\Util\Tree($category_data,array('&nbsp;&nbsp;&nbsp;│','&nbsp;&nbsp;&nbsp;├─','&nbsp;&nbsp;&nbsp;└─'),'&nbsp;&nbsp;&nbsp;');
        
        $select_category = $tree->getTree(0,$str);
        $this->select_category = $select_category;
        $this->display();
    }
    
    
    public function addCategory(){
        $Category = M('Category');
        $pid = I('get.pid',0);
        $data = $Category->select();
        $str  = "<option value='\$id' \$selected>\$spacer \$cat_name </option>";
        $tree = new \Common\Util\Tree($data);
        $select_category = $tree->getTree(0,$str,$pid);
        $this->select_category = $select_category;
        $this->show_nav = 1;
        $this->header_title = '添加分类';
        $this->display('category');
    }
    
    public function editCategory(){
    
        $Category = M('Category');
        $id = I('get.id');
        $row = $Category->where(array('id'=>$id))->find();
        $data = $Category->select();
        $str  = "<option value='\$id' \$selected>\$spacer \$cat_name </option>";
        $tree = new \Common\Util\Tree($data);
        $select_category = $tree->getTree(0,$str,$row['pid']);
        $this->select_category = $select_category;
        $this->row = $row;
        $this->show_nav = 1;
        $this->header_title = '编辑分类';
        $this->display('category');
    }
    
    public function writeCategory(){
        
        $Category = D('Category');
        $data = $Category->create();

        if($data){
            if(empty($data['id'])){
                $r = $Category->add($data);
            }else{
                $r = $Category->save($data);
            }
            if($r===false){
                $this->error('操作失败'.$Category->getError());
            } else {
                $this->success('操作成功!',U('index'));
            }
        }else{
            $this->error('操作失败,'.$Category->getError());
        }
    }
    
    public function deleteCategory(){
        $id = I('get.id');
        $result = M('Category')->where(array('id'=>$id))->delete();
        if($result){
            $this->success('操作成功~');
        }else{
            $this->error('操作失败~');
        }
    }
    
    public function listorder(){
        $ids = I('post.listorders');
        foreach ($ids as $id=>$val){
            M('Category')->where(array('id'=>$id))->save(array('sort_order'=>$val));
        }
        $this->success('更新成功！');
    }
}