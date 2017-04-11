<?php

require_once 'functions.php';

if(empty($_POST['user_id'])){
	echo "<script>alert('参数错误！'); history.go(-1);</script>"; 
	//die('user_id is empty');
}

if(empty($_POST['wait_answer_id'])){
	echo "<script>alert('参数错误！'); history.go(-1);</script>"; 
	//die('请输入新密码');
}
if(empty($_POST['order_detail'])){
	echo "<script>alert('请输入预定详情！'); history.go(-1);</script>"; 
	//die('请输入原密码');
}


$user_id = $_POST['user_id'];
$wait_answer_id = $_POST["wait_answer_id"];
$order_detail = $_POST["order_detail"];  


connectDb();
mysql_query("set names 'utf8'");
$sqltest = "select * from order_answer where user_id = '".$user_id."' and wait_answer_id = '".$wait_answer_id."' and deleted = 0";
//echo "sqltest:".$sqltest;
$testresult = mysql_query($sqltest);
//echo "<br />testresult:".$testresult; 
if(mysql_num_rows($testresult)){
	$action = "UPDATE";
}else{
	$action = "INSERT";
}
//echo $action;
$sqlinsert = "insert into order_answer(wait_answer_id,user_id,others,deleted) values ('".$wait_answer_id."','".$user_id."','".$order_detail."',0)";
$sqlupdate = "update order_answer set others = '".$order_detail."' where wait_answer_id = '".$wait_answer_id."' and user_id = '".$user_id."' and deleted = 0";
//echo "<br />sqlinsert:".$sqlinsert;
//echo "<br />sqlupdate:".$sqlupdate;
if($action == "INSERT"){
	mysql_query($sqlinsert);
}else if($action == "UPDATE"){
	mysql_query($sqlupdate);
}else{
	echo "<script>alert('无效操作！'); history.go(-1);</script>"; 
}
if(mysql_errno()){
	echo "mysql_errno : ".mysql_errno();
}else{
	if($action == "INSERT"){
		echo "<script>alert('预约成功');history.go(-2);</script>";
	}else if($action == "UPDATE"){
		echo "<script>alert('更新成功');history.go(-2);</script>"; 
	}
}
?>