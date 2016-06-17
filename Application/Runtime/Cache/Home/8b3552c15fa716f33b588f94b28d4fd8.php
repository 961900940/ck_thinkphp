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
    1、数据库操作
    <xmp>
    $this->load->database();
      原生sql:
            $query = $this->db->query('select * from onethink_action');
            $res = $query-> result_array();         // 返回一个带下标的数组
            结果：二维数组   $query->result();       //返回一个对象的数组
      框架执行:
            /* $this->db->where('id',1);
            $this->db->select('*'); */
            $res2=$this-> db->get( 'action');       //action为onethink_action表名
            var_dump($res2->result());
      多数据库操作：(切换数据库)
            $db2 = $this->load->database('default', TRUE);
            $res3 = $db2->query( 'select * from onethink_action where id=2');
            var_dump($res3->result());
      查询绑定(防注入)：
            $sql = "SELECT * FROM some_table WHERE id = ? AND status = ? AND author = ?";
            $this->db->query($sql, array(3, 'live', 'Rick'));

       如果你的查询可能不返回结果，我们建议你先使用 num_rows()函数
           单结果标准查询（对象形式）, row()函数返回一个 对象
                                  （数组形式）， row_array()函数返回一个 数组
           快速插入： echo $this->db->affected_rows();
    </xmp>
    2、数据库快捷操作语句
    <pre style='color:#55cc66;background:#001800;'>
    查询辅助函数
    关于执行查询的信息:
    $this->db->last_query();          //最后执行的sql语句
    $this->db->insert_id()             //当执行 INSERT 语句时，这个方法返回新插入行的ID。
    $this->db->affected_rows()    // 当执行 INSERT、UPDATE 等写类型的语句时，这个方法返回受影响的行数。
    关于数据库的信息:
    $this->db->count_all()            // 该方法用于获取数据表的总行数，第一个参数为表名
    $this->db->platform()            // 该方法输出你正在使用的数据库平台（MySQL，MS SQL，Postgres 等）:
    $this->db->version()              // 该方法输出你正在使用的数据库版本:
    </pre>
    3、DSN必然通过以下方式实现：
    <xmp>
    $dsn = 'dbdriver://username:password@hostname/database';
    $this->load->database($dsn);
    </xmp>
</body>
</html>