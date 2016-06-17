<?php
namespace Home\Controller;
use Think\Controller;
/**
 * EmptyController
 * 空控制器
 */
class EmptyController extends Controller
{
    /**
    *空控制器处理
    * @return
    */
    public function index(){
        return $this->error('亲，您访问的页面不存在 :(');
    }

}
