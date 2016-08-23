<?php

namespace Admin\Util;

class Page {
    
    // 分页栏每页显示的页数
    public $rollPage = 5;
    // 页数跳转时要带的参数
    public $parameter  ;
    // 分页URL地址
    public $url     =   '';
    // 默认列表每页显示行数
    public $listRows = 25;
    // 起始行数
    public $firstRow    ;
    // 分页总页面数
    protected $totalPages  ;
    // 总行数
    protected $totalRows  ;
    // 当前页数
    protected $nowPage    ;
    // 分页的栏的总页数
    protected $coolPages   ;
    // 分页显示定制
    protected $config  =    array('header'=>'条数据','prev'=>'前一页','next'=>'后一页','first'=>'首页','last'=>'尾页','theme'=>'<div class="col-sm-6"><div class="dataTables_info"  role="alert" aria-live="polite" aria-relevant="all">共 %totalRow% %header% %nowPage%/%totalPage% 页</div></div><div class="col-sm-6"><div class="dataTables_paginate paging_full_numbers" ><ul class="pagination">%first% %upPage% %prePage% %linkPage% %downPage% %nextPage% %end% </ul></div></div>');
    // 默认分页变量名
    protected $varPage;
    /**
     * 架构函数
     * @access public
     * @param array $totalRows  总的记录数
     * @param array $listRows  每页显示记录数
     * @param array $parameter  分页跳转的参数
     */
    public function __construct($totalRows,$listRows='',$parameter='',$url='') {
        $this->totalRows    =   $totalRows;
        $this->parameter    =   $parameter;
        $this->varPage      =   C('VAR_PAGE') ? C('VAR_PAGE') : 'p' ;
        if(!empty($listRows)) {
            $this->listRows =   intval($listRows);
        }
        $this->totalPages   =   ceil($this->totalRows/$this->listRows);     //总页数
        $this->coolPages    =   ceil($this->totalPages/$this->rollPage);
        $this->nowPage      =   !empty($_GET[$this->varPage])?intval($_GET[$this->varPage]):1;
        if($this->nowPage<1){
            $this->nowPage  =   1;
        }elseif(!empty($this->totalPages) && $this->nowPage>$this->totalPages) {
            $this->nowPage  =   $this->totalPages;
        }
        $this->firstRow     =   $this->listRows*($this->nowPage-1);
        if(!empty($url))    $this->url  =   $url; 
    }
    public function setConfig($name,$value) {
        if(isset($this->config[$name])) {
            $this->config[$name]    =   $value;
        }
    }
    /**
     * 分页显示输出
     * @access public
     */
    public function show() {
        if(0 == $this->totalRows) return '';
        $p              =   $this->varPage;
        $nowCoolPage    =   ceil($this->nowPage/$this->rollPage);
       
        $parameter[$p]  =   '__PAGE__';
        $url            =   U('',$parameter);

        //上下翻页字符串
        $upRow          =   $this->nowPage-1;
        $downRow        =   $this->nowPage+1;  

        $preRow     =   $this->nowPage-$this->rollPage;
        $nextRow    =   $this->nowPage+$this->rollPage;
        $theEndRow  =   $this->totalPages;

        if($upRow == 0){
            //首页
            $theFirst   =   "<li class=\"paginate_button first disabled\" aria-controls=\"dataTables\" tabindex=\"0\"><a href='javascript:void(0);' >".$this->config['first']."</a></li>";
             //前一页
            $upPage     =    "<li class=\"paginate_button previous disabled\" aria-controls=\"dataTables\" tabindex=\"0\"><a href='javascript:void(0);'>".$this->config['prev']."</a></li>";
            //上多少页
            $prePage    =   "<li class=\"paginate_button disabled\" aria-controls=\"dataTables\" tabindex=\"0\"><a href='javascript:void(0);' >上".$this->rollPage."页</a></li>";
        }else{
            //首页
            $theFirst   =   "<li class=\"paginate_button first \" aria-controls=\"dataTables\" tabindex=\"0\"><a href='".str_replace('__PAGE__',1,$url)."' >".$this->config['first']."</a></li>";

            //前一页
            $upPage     =    "<li class=\"paginate_button previous \" aria-controls=\"dataTables\" tabindex=\"0\"><a href='".str_replace('__PAGE__',$upRow,$url)."'>".$this->config['prev']."</a></li>";
            //上多少页
            
            $prePage    =   "<li class=\"paginate_button \" aria-controls=\"dataTables\" tabindex=\"0\"><a href='".str_replace('__PAGE__',$preRow,$url)."' >上".$this->rollPage."页</a></li>";
        }



        if( $this->nowPage == $theEndRow){
            //后一页
            $downPage   =   "<li class=\"paginate_button next disabled\" aria-controls=\"dataTables\" tabindex=\"0\"><a href='javascript:void(0);'>".$this->config['next']."</a></li>";
            //下多少页
            $nextPage   =   "<li class=\"paginate_button disabled\" aria-controls=\"dataTables\" tabindex=\"0\"><a href='javascript:void(0);' >下".$this->rollPage."页</a></li>";

            //尾页
            $theEnd     =   "<li class=\"paginate_button last disabled\" aria-controls=\"dataTables\" tabindex=\"0\"><a href='javascript:void(0);' >".$this->config['last']."</a></li>";
            

        }else{
             //后一页
            $downPage   =   "<li class=\"paginate_button next \" aria-controls=\"dataTables\" tabindex=\"0\"><a href='".str_replace('__PAGE__',$downRow,$url)."'>".$this->config['next']."</a></li>";
            //下多少页
            $nextPage   =   "<li class=\"paginate_button \" aria-controls=\"dataTables\" tabindex=\"0\"><a href='".str_replace('__PAGE__',$nextRow,$url)."' >下".$this->rollPage."页</a></li>";

            //尾页
            $theEnd     =   "<li class=\"paginate_button last \" aria-controls=\"dataTables\" tabindex=\"0\"><a href='".str_replace('__PAGE__',$theEndRow,$url)."' >".$this->config['last']."</a></li>";
        }


        // 1 2 3 4 5
        $linkPage = "";
        for($i=1;$i<=$this->rollPage;$i++){
            $page       =   ($nowCoolPage-1)*$this->rollPage+$i;
            if($page!=$this->nowPage){
                if($page<=$this->totalPages){
                    $linkPage .= "<li class=\"paginate_button \" aria-controls=\"dataTables\" tabindex=\"0\"><a href='".str_replace('__PAGE__',$page,$url)."'>".$page."</a></li>";
                }else{
                    
                    break;
                }
            }else{
                
                $linkPage .= "<li class=\"paginate_button active\" aria-controls=\"dataTables\" tabindex=\"0\"><span class='active'>".$page."</span></li>";
                
            }
        }
        
         $pageStr     =   str_replace(
            array('%header%','%nowPage%','%totalRow%','%totalPage%','%upPage%','%downPage%','%first%','%prePage%','%linkPage%','%nextPage%','%end%'),
            array($this->config['header'],$this->nowPage,$this->totalRows,$this->totalPages,$upPage,$downPage,$theFirst,$prePage,$linkPage,$nextPage,$theEnd),$this->config['theme']);
        return $pageStr;
    }
}
