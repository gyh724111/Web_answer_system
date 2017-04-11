<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script type="text/javascript" src="jquery-1.4.2.js">
</script>
<meta http-equiv="Content-Type" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<title>管理员页面</title>
<link href="style.css" type="text/css" rel="stylesheet" />
</style>
</head>
<body>
<?php
$ok_username = '';
error_reporting(E_ERROR | E_WARNING | E_PARSE);
var_dump($_POST);
if($_POST){
    //echo "post:";
    //print_r($_POST);
    
    $ok_username = $_POST['ok_username'];
}
echo "ok_username:".$ok_username;
require_once 'functions.php'
?>
	<div class="container">
    	<div class = "wrapper">
        	<div class="heading">
           	  <div class="heading_nav">
                	<div class="heading_title">
                        <a href="index.php" style="color: burlywood;" >教师坐班答疑系统首页</a> 
                    </div>
                    <div class="heading_naving" >
                   	<ul>
                        <li>
                            <?php
                            if($ok_username != ''){
                                echo "<a href='wait_answer_import.php?ok_username=$ok_username'>坐班答疑数据表导入</a>";
                            }
                            ?>
                        </li>
                        <li>
                            <?php
                            if($ok_username != ''){
                                echo "<a href='user_teacher_import.php?ok_username=$ok_username'>用户表教师信息导入</a>";
                            }
                            ?>
                        </li>
                            <li>
                                <?php 
                                if($ok_username == '') {echo '管理员登录';}
                                else{
                                    echo $ok_username;
                                }
                                ?>
                                </li>

                        </ul>

                         
                        
                    </div>      
              </div>
            </div>
            <div class="body">
            	<div class="body_title">
                <!--<h3>了解本系统</h3>-->
                <p>通过本系统来让你的学习更加便捷！</p>
                </div>
                <hr />
                <hr />
            </div>
        </div>
   	 	<div class="footing">
        网络131 201310314012 葛永晖
        </div>
    </div>
 
</body>
</html>
