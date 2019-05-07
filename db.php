<?php
// pdo数据接口
//1. 为什么选择PDOS
//2. 如何查找PDO的官方手册
//3. PDO的设计是面向对象的： 类 和 方法
$usr='root';
$pwd='hsl991002962464';
$port='3306';
$host='localhost';
$dbname='baidu';

//1. 连接到数据库
$pdo = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $usr, $pwd);
//var_dump($pdo);
//重置所有的连接字符为utf8
$pdo->query('set names utf8');
//设置错误控制方式
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
//2. fun
//2.1 执行查询语句并返回结果
//@param dataType 数据类型： 2二维数组 1一维数组 0单值
//@param revType 返回类型: array返回， object返回
function get_all( $sql, array $data=[], $dataType=2, $revType='array' )
{
	//1.取 pdo
	global $pdo;
	//2.1预处理sql语句
	//'select t_tiwen where id>? and stat>?'
	$stmt=$pdo->prepare($sql);
	//2.2数据绑定
	for($i=0 ; $i<count($data); $i++){
		$stmt -> bindValue($i+1,$data[$i]);
	}
	//2.3执行SQL，得到结果集$stmt
	$stmt->execute();

	//3.返回结果
	$revType = $revType=='array' ? PDO::FETCH_ASSOC : PDO::FETCH_OBJ;
	
	switch($dataType)
	{
		// 返回一维数组
		case 1:
			return $stmt->fetch($revType);
		// 返回单值
		case 0:
			return $stmt->fetchColumn();
		// 默认返回二维数组
		default:
			return $stmt->fetchAll($revType);
	}

}

//2.1 执行操作语句并返回影响行数
function get_count($sql,array $data=[]) :int
{
	// 取 pdo
	global $pdo;
	//2.1预处理sql语句
	//'select t_tiwen where id>? and stat>?'
	$stmt=$pdo->prepare($sql);
	//2.2数据绑定
	for($i=0 ; $i<count($data); $i++){
		$stmt -> bindValue($i+1,$data[$i]);
	}
	//2.3执行SQL，得到结果集$stmt
	$stmt->execute();
	//3.返回结果
	return $stmt->rowCount();
}
