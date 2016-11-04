<?php
namespace Home\Controller;
use Think\Controller;
use Think\Cache\Driver\Redis;
class RedisController extends Controller {

    public function index(){
		header("Content-type: text/html; charset=utf-8"); 
		$redis = new Redis();
		$result = $redis->get("user2");
		var_dump($result);
		if(!$result){
			$redis->set('user2','ck');
			$user = $redis->get("user2");
			echo '读取数据库user :'.$user;
		}else{
			echo '读取缓存user :'.$redis->get('user2');
		}
		
		exit;
    }
}
