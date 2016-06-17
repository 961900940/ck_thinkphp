<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * EmptyController
 * 空控制器
 */
class EmptyController extends CommonController
{
    /**
    *空控制器
    * @return
    */
    public function index(){
        return $this->error('亲，您访问的页面不存在 :(');
    }

}
