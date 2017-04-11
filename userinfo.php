<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script type="text/javascript" src="jquery-1.4.2.js">
</script>
<meta http-equiv="Content-Type" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<title>用户信息</title>
<link href="style.css" type="text/css" rel="stylesheet" />
</style>
</head>
<body>
	<?php
if(empty($_GET['user_id'])){
	die('user_id not define!');
}

require_once 'functions.php'
?>
<?php
$user_id = $_GET['user_id'];
$conn = connectDb();
mysql_query("set character set 'utf8'");//读数据库
//var_dump($conn);
$result = mysql_query("SELECT * FROM user WHERE id=$user_id");
//var_dump($result);
// $dataCount = mysql_num_rows($result);
// //echo $dataCount;
// for($i=0;$i<$dataCount;$i++){
	$result_arr=mysql_fetch_assoc($result);
	
	$id = $result_arr['id'];
	$username = $result_arr['username'];
	$user_type = $result_arr['user_type'];
?>
	<div class="container">
        <div class = "wrapper">
            <div class="heading">
              <div class="heading_nav">                 
                <div class="heading_title">
                    <form name="form4" action="index.php" method="post">
                        <input type="hidden" name="ok_user_id" value="<?php echo $user_id; ?>"/>
                        <input type="hidden" name="ok_username" value="<?php echo $username; ?>"/>
                        <input type="hidden" name="ok_user_type" value="<?php echo $user_type; ?>"/>
                        <a href="javascript:form4.submit();" style="color: burlywood;" >教师坐班答疑查询系统</a> 
                    </form>
                </div>
                <div class="heading_naving">
                   <ul>
                        <li>
                            <?php if($user_id != ''){
                            echo "<a href='TCSearch.php?user_id=$user_id&username=$username&user_type=$user_type'>坐班答疑安排查询</a>";
                                }
                            ?>
                        </li>
                        <li>
                            <?php if($user_id != ''){
                            echo "<a href='RPSearch.php?user_id=$user_id&username=$username&user_type=$user_type'>联系方式查询</a>";
                                }
                            ?>
                        </li>
                    <script type="text/javascript">
                            $(document).ready(function(){
                            $("#11").hover(
                            function(){
                               $("#22").fadeIn();
                            },function(){
                             $("#22").fadeOut();
                            }   
                            );
                            });
                            </script>
                            <div  id="11" style="float:right;" >
                            <li><a href="login.php">
                                <?php 
                                if($username == '') {echo '用户登录';}
                                else{echo $username;}
                                ?></a></li>
                            <div id="22" style="display:none">
                                <?php 
                                if($username != ''){
                            echo "<a href='userinfo.php?user_id=$user_id'>用户信息</a>";}
                        ?><br>
                            <?php if($user_type == 2){
                                echo "<a href='myorders.php?user_id=$user_id&username=$username&user_type=$user_type'>我的预约</a>";
                            }else if($user_type == 1){
                                echo "<a href='myordered.php?user_id=$user_id&username=$username&user_type=$user_type'>我被预约</a>";
                            }
                            ?>
                            <br>
                            <a href="index.php"><?php if($username != '') echo '注销';?></a><br>
                        </div>
                    </div>
                </ul>
                </div>
            </div>      
            </div>
        
<div class="body">
<center>
<table style='text-aline: left'; border='1'>
<tr>
	<th>学号</th>
	<th>姓名</th>
	<th>用户类型</th>
	<th>职称</th>
	<th>操作</th>
</tr>


<tr>
	<td><?php echo $id ?></td>
	<td><?php echo $username ?></td>
	<td><?php 
	if($user_type == 1){
		echo '教师';
	}else if($user_type == 2 ){
		echo '学生';
	}else{
		echo '无效用户！';
	} ?>
	</td>
	<td>
		<?php
		if($user_type == 1){
			$conn = connectDb();
			mysql_query("set character set 'utf8'");
			$result = mysql_query("SELECT * FROM wait_answer WHERE teacher_id=$user_id");
			$result_arr=mysql_fetch_assoc($result);
			$position = $result_arr['position'];
			echo $position;
		}else if($user_type == 2 ){
			echo '学生';
		}else{
			echo '无效用户！';
		}
		?>
	</td>
	<td>
		<?php 
		echo "<a href='edituser.php?user_id=$user_id'>修改密码</a>"; ?>
	</td>
</tr>

</table>
</center>
</div>

    </div>
		<div class="footing">
        网络131 201310314012 葛永晖
        </div>
    </div>
</body>
</html>