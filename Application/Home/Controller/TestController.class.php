<?php
namespace Home\Controller;
use Think\Controller;
class TestController extends Controller {
	
	
	/**开启了事务，就必须commit**/
    public function index(){
	
		$Info = M("Test"); // 实例化Info对象
		$Info->startTrans(); 
		
		$sql = "insert into ks_test (title) values ('11111111111'),('222222222222')";
    	$res = $Info->execute($sql);    //写入 update insert delete

    	var_dump($res);
    	var_dump($Info->getLastSql());
    	exit;
    	$sql = "insert into ks_test (title2) values ('3333333333'),('4444444444')";
    	$res2 = $Info->execute($sql);    //写入 update insert delete

		if ($res){
		    // 提交事务
		    echo "插入成功";
		    $Info->commit(); 
		}else{
		   // 事务回滚
		   echo '回滚';
		   $Info->rollback(); 
		}
    }
}
