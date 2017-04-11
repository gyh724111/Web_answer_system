<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script type="text/javascript" src="jquery-1.4.2.js">
</script>
<meta http-equiv="Content-Type" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<title>教师坐班答疑查询系统</title>
<link href="style.css" type="text/css" rel="stylesheet" />
</style>
</head>
<body>
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
$ok_name = '';
if($_POST){
    //echo "post:";
    //print_r($_POST);
    // $ok_user_id = '';
    // $ok_username = '';
    // $ok_user_type = '';
    $ok_user_id = $_POST['ok_user_id'];
    //$ok_user_id = array_keys($_POST)['ok_user_id'];
    $ok_username = $_POST['ok_username'];
    $ok_user_type =$_POST['ok_user_type'];
    //echo $ok_user_id."<br />".$ok_username."<br />".$ok_user_type;
}
require_once 'functions.php'
?>
	<div class="container">
    	<div class = "wrapper">
        	<div class="heading">
           	  <div class="heading_nav">
                	<div class="heading_title">
                        <form name="form1" action="index.php" method="post">
                            <input type="hidden" name="ok_user_id" value="<?php echo $ok_user_id; ?>"/>
                            <input type="hidden" name="ok_username" value="<?php echo $ok_username; ?>"/>
                            <input type="hidden" name="ok_user_type" value="<?php echo $ok_user_type; ?>"/>
                            <a href="javascript:form1.submit();" style="color: burlywood;" >教师坐班答疑查询系统</a> 
                        </form>
                    </div>
                    <div class="heading_naving" >
                   	<ul>
                        	
                            <li>
                                <?php if($ok_user_id != ''){
                                echo "<a href='TCSearch.php?user_id=$ok_user_id&username=$ok_username&user_type=$ok_user_type'>坐班答疑安排查询</a>";
                                    }
                                ?>
                            </li>
                            <li>
                                <?php if($ok_user_id != ''){
                                echo "<a href='RPSearch.php?user_id=$ok_user_id&username=$ok_username&user_type=$ok_user_type'>联系方式查询</a>";
                                    }
                                ?>
                            </li>
                            <li>
                                <?php if($ok_user_id == ''){
                                echo "<a href='alogin.php'>管理员登录</a>";
                                    }
                                ?></li>

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
                                if($ok_username == '') {echo '用户登录';}
                                else{echo $ok_username;}
                                ?></a></li>
                            <div id="22" style="display:none">
                                <?php 
                                if($ok_username != ''){
                            echo "<a href='userinfo.php?user_id=$ok_user_id'>用户信息</a>";}
                        ?><br>
                            <?php if($user_type == 2){
                                echo "<a href='myorders.php?user_id=$user_id&username=$username&user_type=$user_type'>我的预约</a>";
                            }else if($user_type == 1){
                                echo "<a href='myordered.php?user_id=$user_id&username=$username&user_type=$user_type'>我被预约</a>";
                            }
                            ?>
                            <br>
                            <a href="index.php"><?php if($ok_username != '') echo '注销';?></a><br>
                        </div>
                    </div>
                        </ul>

                         
                        
                    </div>      
              </div>
            </div>
            <div class="body">
            	<div class="body_title">
                <!--<h3>了解本系统</h3>-->
                <p>通过本系统来让你的学习更加便捷！</p>
                </div>

                <marquee style="WIDTH: 388px; HEIGHT: 200px" scrollamount="6" direction="left" scrolldelay='1'>
                <div align="left" >
                </div >
                <center ><font face="黑体" color="#008000" size="4" ></font ></center >
                <div align="left" >
                </div >
                <center >
                    <p ><font color="#ff6600" size="4" >
                        <?php
                        $conn = connectDb(); 
                        mysql_query("set character set 'utf8'");//读数据库
                        $result = mysql_query("SELECT count(*) FROM order_answer WHERE user_id='$ok_user_id' and deleted='0' ");
                        $dataCount = mysql_num_rows($result);
                        //echo $dataCount;
                        for($i=0;$i<$dataCount;$i++){
                            $result_arr=mysql_fetch_assoc($result);
                            $totalorder = $result_arr['count(*)'];
                        }
                        if($ok_user_id!=''){
                        echo "您已预定".$totalorder."场答疑！";
                    }
                        ?>
                    </font ></p >
             
                </marquee >
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
