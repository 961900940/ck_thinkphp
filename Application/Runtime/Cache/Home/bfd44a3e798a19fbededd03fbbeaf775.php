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
    <xmp>
    插入单条记录，成功返回  主键id, 失败返回  false;
    插入多条数据，成功返回 插入第一条数据的id , 失败返回 false;
    </xmp>
    1、原生sql语句
    <pre style='color:#000000;background:#f1f0f0;'>
    $Model = new Model(); // 实例化一个空模型 $Model = M();
    $sql = "select * from mk_user";
    $res = $Model->query($sql);      //读取  select
    $sql = "insert into onethink_action (name,title) values ('12121212','111'),('1212121222','222')";
    $res = $Model->execute($sql);    //写入 update insert delete

    获取最新插入的id(两种方法):
    var_dump(mysql_insert_id());    // 第一种
    $res2= $Model->query("select last_insert_id()");
    var_dump($res2);                // 第二种

    echo $Model->getLastSql();     //返回最后一条执行语句
    </pre>
    2、框架sql语句
    <pre style='color:#55cc66;background:#001800;'>
    $info = $goods ->where("goods_price > 1000 and goods_name like '索%' ") ->select();//价格大于1000元的商品
    $info = $goods ->field("goods_id,goods_name") ->select(); //查询指定字段
    $info = $goods ->limit(5,5) ->select();//限制条数
    //分页page
    $data = M('User')->field('id,user_name')->order('id asc')->page(1,5)->select();
    //group分组操作:
    $data = M('User')->field('score,count(*) as total')->having('score >= 20')->group('score')->select();
    //多表查询 table方法   table(array('表名'=>'别名'))  表名需要加前缀
    $data = M()->table(array('mk_user'=>'user','mk_userinfo'=>'info'))->where('user.id=info.user_id')->select();
    //多表查询  join方法   join()支持字符串和数组(数组只能有一个join)
    $data = M('user')->join(array('mk_userinfo On mk_userinfo.user_id = mk_user.id'))->slect();
    $data = M('user')->join('mk_userinfo On mk_userinfo.user_id = mk_user.id')->slect();
    $data = M('user')->join('Right join mk_userinfo On mk_userinfo.user_id = mk_user.id')->slect();
    //多表查询  union查询  union('string array',true/false)  默认false
    $data = M('user')->field('user_name')->union('select user_name from mk_user2')->select();
    $data = M('user')->field('user_name')->union(array('field'=>'user_name','table'=>'mk_user2'))->select();
    //过滤查询  distinct
    $data = M('user')->distinct(true)->field('score')->union('score asc')->select();
    select * from ctwx_wxpay_notify where transaction_id in (select transaction_id from ctwx_wxpay_add)
    //查询同一字段不同值共多少个
    SELECT count(DISTINCT leaderid) as sum FROM `leaderfruits`
    </pre>
    3、防止sql注入
    <xmp>
    查询条件尽量使用数组方式，这是更为安全的方式；
    如果不得已必须使用字符串查询条件，使用预处理机制；
    使用自动验证和自动完成机制进行针对应用的自定义过滤；
    如果环境允许，尽量使用PDO方式，并使用参数绑定。
    </xmp>
    <pre style='color:#000000;background:#f1f0f0;'>
    【查询条件预处,理针对字符串条件】：
    where方法使用字符串条件的时候，支持预处理（安全过滤），并支持两种方式传入预处理参数，例如：
    $Model->where("id=%d and username='%s' and xx='%f'",array($id,$username,$xx))->select();
    $Model->where("id=%d and username='%s' and xx='%f'",$id,$username,$xx)->select();

    模型的query和execute方法 同样支持预处理机制
    $model->query('select * from user where id=%d and status=%d',$id,$status);
    $model->query('select * from user where id=%d and status=%d',array($id,$status));
    execute方法用法同query方法。
    【普通查询,数组条件】：
    $User = M("User");// 实例化User对象
    $map['name'] = 'thinkphp';
    $map['status'] = 1;
    // 把查询条件传入查询方法
    $User->where($map)->select();
    【表达式查询,数组条件】：
    $username = I('post.username');
    $Auth_admin = M('Auth_admin');
    $data['username'] =array('eq',$username);
    $info = $Auth_admin ->where($data)->select();
    </pre>
</body>
</html>