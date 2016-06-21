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
    注意：
    <pre style='color:#55cc66;background:#001800;'>
    mysql_query()仅对SELECT，SHOW，DESCRIBE，EXPLAIN和其他语句 语句返回一个 resource，如果查询出现错误则返回false。
    对于其他类型的SQL语句，比如INSERT，UPDATE，DELETE，DROP，mysql_query()在执行成功时返回 TRUE，出错时返回 FALSE。
    返回的结果资源应该传递给 mysql_fetch_array() 和其他函数来处理结果表，取出返回的数据。
    假定查询成功，可以调用 mysql_num_rows() 来查看对应于 SELECT 语句返回了多少行，或者调用 mysql_affected_rows()来查看对应于 DELETE，INSERT，REPLACE 或 UPDATE语句影响到了多少行。
    如果没有权限访问查询语句中引用的表时，mysql_query() 也会返回 false。
    </pre>
    1、mysql
    <xmp></xmp>
    2、mysqli
    <xmp></xmp>
    3、pdo
    <xmp></xmp>
</pre>
</body>
</html>