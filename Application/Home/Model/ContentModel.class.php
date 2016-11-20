<?php
namespace Home\Model;
use Think\Model;
class ContentModel extends Model {

    //文章列表
    public function article_datalist(){
        $field = "id,cid,title,is_hot,is_top";
        $res = $this->field($field)->order("id asc")->where("status = 1")->select();
        return $res;
    }

    //内容详情
    public function article_detail($id){
        $field = "id,cid,title,status,is_hot,is_top,content,create_time";
        $condition = array("id"=>$id);
        $res = $this->field($field)->where($condition)->find();
        return $res;
    }
}
