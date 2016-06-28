<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <xmp></xmp>
    <pre style='color:#55cc66;background:#001800;'></pre>
    <pre style='color:#d1d1d1;background:#000000;'></pre>
    <pre style='color:#000020;background:#f6f8ff;'></pre>
    <pre style='color:#000000;background:#f1f0f0;'></pre>
    1、mysql 面向过程：
    <pre style='color:#000020;background:#f1f0f0;'>
    <span style="color:red;">mysql链接：</span>
    //1.连接
    $link=mysqli_connect('localhost','root','root','test') or die('Connect Error:'.mysqli_connect_errno().":".mysqli_connect_error());

    //2.设置编码方式
    mysqli_set_charset($link,'UTF8');

    //3.执行SQL查询
    $sql="INSERT user(username,password,age) VALUES('imooc1','imooc1',22);";
    $res=mysqli_query($link, $sql);
    if($res){
    	echo 'AUTO_INCREMENT:'.mysqli_insert_id($link);
    	echo 'AFFECTED ROWS:'.mysqli_affected_rows($link);
    }else{
    	echo 'ERROR:';
    	echo mysqli_errno($link).':'.mysqli_error($link);
    }

    $sql="UPDATE user SET age=age+10 WHERE id=41;";
    $sql.="DELETE FROM user WHERE id=40";
    $res=mysqli_multi_query($link, $sql);	//执行多条语句查询
    var_dump($res);

    //4.关闭连接
    mysqli_close($link);
    ============================================================================
    //执行SQL查询
    $sql="SELECT id,username,password,age FROM user";
    $result=mysqli_query($link,$sql);
    if($result && mysqli_num_rows($result)>0){
    	while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
    		//print_r($row);
    		$rows[]=$row;
    	}
    }
    //print_r($rows);
    //释放结果集
    mysqli_free_result($result);
    mysqli_close($link);
</pre>
</body>
</html>