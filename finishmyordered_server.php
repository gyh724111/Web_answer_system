<?php

require_once 'functions.php';

if(empty($_POST['order_answer_id'])){
	echo "<script>alert('参数错误！'); history.go(-1);</script>"; 
	//die('请输入原密码');
}


$order_answer_id = $_POST['order_answer_id'];


connectDb();
mysql_query("set names 'utf8'");

$sqlcancel = "update order_answer set deleted = 1 where id = '".$order_answer_id."'";
mysql_query($sqlcancel);
if(mysql_errno()){
	echo "mysql_errno : ".mysql_errno();
}else{
	echo "<script>alert('完成预约');</script>";
	$sqluserinfo = "select u.id,u.username,u.user_type from user u,order_answer oa where oa.user_id = u.id and oa.id = '".$order_answer_id."'";
	$result_arr=mysql_fetch_assoc(mysql_query($sqluserinfo));
	$user_id = $result_arr['id'];
	$username = $result_arr['username'];
	$user_type = $result_arr['user_type'];
	
	header("Location: myordered.php?user_id=$user_id&username=$username&user_type=$user_type");
	exit;
}
?>
