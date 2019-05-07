<?php

//查询数据表
include 'db.php';
$r = get_all('select * from t_tiwen ');
$r = json_encode($r);
echo $r;
