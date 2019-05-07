<?php
//判断/验证 传入数据
$err = '未传入 完整参数';
if(empty($_POST['tit'] && $_POST['cnt'])){
    exit($err);
}
else{echo 'ok';}
//写入数据表
include 'db.php';
$uid=rand(10000,99999);
$c = get_count("insert into t_tiwen (tit, cnt, uid) values('$_POST[tit]','$_POST[cnt]',$uid);");

// echo $c==1 ? 'yes' : 'no';
