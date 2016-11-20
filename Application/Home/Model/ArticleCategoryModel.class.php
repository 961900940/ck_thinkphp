<?php
namespace Home\Model;
use Think\Model;
class ArticleCategoryModel extends Model {
    protected $tablePrefix = 'ks_';
    protected $tableName = 'article_category';
    protected $trueTableName = 'ks_article_category';

    //文章分类列表
    public function article_category_list($is_display=false){
        $field = "cid,category_name,sort,is_new,is_open,create_time";
        if($is_display){
            $res = $this->field($field)->order("sort asc")->select();
        }else{
            $res = $this->field($field)->order("sort asc")->where("is_display = 1")->select();
        }
        return $res;
    }
}
