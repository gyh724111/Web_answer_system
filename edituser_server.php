<?php

require_once 'functions.php';

if(empty($_POST['user_id'])){
	echo "<script>alert('参数错误！'); history.go(-1);</script>"; 
	//die('user_id is empty');
}
if(empty($_POST['oldpwd'])){
	echo "<script>alert('请输入原密码！'); history.go(-1);</script>"; 
	//die('请输入原密码');
}
if(empty($_POST['newpwd'])){
	echo "<script>alert('请输入新密码！'); history.go(-1);</script>"; 
	//die('请输入新密码');
}
if(empty($_POST['confirm'])){
	echo "<script>alert('请输入确认密码！'); history.go(-1);</script>"; 
	//die('请确认密码');
}

$user_id = $_POST['user_id'];
$oldpwd = $_POST["oldpwd"];
$pwd = $_POST["newpwd"];  
$pwd_confirm = $_POST["confirm"];  

//  echo "oldpwd = ".$oldpwd;
//  echo "pwd = ".$pwd;
//  echo "pwd_confirm = ".$pwd_confirm;
// print_r($_POST);
if($pwd != $pwd_confirm){
	echo "<script>alert('新密码两次输入不一致！'); history.go(-1);</script>"; 
	//die('新密码两次输入不一致');
}
connectDb();

$result = mysql_query("SELECT password FROM user WHERE id = $user_id");
mysql_query("set names 'utf8'");
$true_pwd = mysql_fetch_assoc($result);
// echo "true_pwd = ";
// echo $true_pwd['r_pwd'];

if($oldpwd != $true_pwd['password']){
	echo "<script>alert('老密码输入错误！'); history.go(-1);</script>"; 
	//die('老密码输入错误');
}


mysql_query("UPDATE user SET password = '$pwd' WHERE id = $user_id");
if(mysql_errno()){
	echo "mysql_errno : ".mysql_errno();
}else{
	echo "<script>alert('请用新的账户信息重新登录系统');</script>"; 
	echo "<meta http-equiv='Refresh' content='0;URL=index.php'>"; 
	//header("Location:index.php");
}
?>