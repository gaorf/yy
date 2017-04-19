<?php
namespace Yy\Model;
use Think\Model\RelationModel;
class BrandModel extends RelationModel{
    
    protected $_link = array(
        'Company'=>array(
            'mapping_type'=>self::BELONGS_TO,
            'class_name'=>'Company',
            'foreign_key'=>'company_id',
            'mapping_fields'=>'company_name',
            'as_fields'=>'company_name'
        )
    );
    
    
    /**
     * 获取对应企业的品牌
     * @param integer $company_id
     */
    public function getCompanyBrand($company_id){
        $list = $this->where(array('company_id'=>$company_id,'status'=>1))->select();
        return $list;
    }
    
}