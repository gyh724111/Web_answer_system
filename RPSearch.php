<?php
require_once 'functions.php'
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script type="text/javascript" src="jquery-1.4.2.js">
</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>教师联系方式查询</title>
<link href="style.css" type="text/css" rel="stylesheet" />
</style>
</head>
<body>
    <?php
        if( $_GET ){
            $user_id = $_GET['user_id'];
            $username = $_GET['username'];
            $user_type = $_GET['user_type'];
        }else{
            $user_id = 'unknown';
            $username = 'unknown';
            $user_type = 'unknown';
        }
        if( $_POST ){
            if($_POST['room_num'] != ''){
                $room_num = $_POST['room_num'];
            }else{
                $room_num = '';
            }
            if($_POST['room_division'] != ''){
                $room_division = $_POST['room_division'];
            }else{
                $room_division = '';
            }
            if($_POST['phone'] != ''){
                $phone = $_POST['phone'];
            }else{
                $phone = '';
            }
        
        }else{
            $room_num = '';
            $room_division = '';
            $phone = '';
            //echo "<script>alert('无效的数据提交！'); history.go(-1);</script>";  
        }
?>

	<div class="container">
    	<div class = "wrapper">
        	<div class="heading">
           	  <div class="heading_nav">                	
                <div class="heading_title">
                    <form name="form2" action="index.php" method="post">
                        <input type="hidden" name="ok_user_id" value="<?php echo $user_id; ?>"/>
                        <input type="hidden" name="ok_username" value="<?php echo $username; ?>"/>
                        <input type="hidden" name="ok_user_type" value="<?php echo $user_type; ?>"/>
                        <a href="javascript:form2.submit();" style="color: burlywood;" >教师坐班答疑查询系统</a> 
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
            	<div class="body_title">
                <h3></h3>
                <p>您可以查询各个办公室的联系方式！</p>
                
                
                        
        <form name="form1" enctype="multipart/form-data" method="post" action=""> 
            门牌号:<input type="text" name="room_num" /> 
            所属部门:<input type="text" name="room_division">
            电话:<input type="text" name="phone">  
            <input type="submit" name="Submit" value="查询"> 
            </label> 
        </form>

        <table style='text-aline:center'; border='1'>
        <tr>
            <th style='width:50px'>编号</th>
            <th style='width:50px'>门牌号</th>
            <th style='width:150px'>所属部门</th>
            <th style='width:60px'>电话</th>
            <th style='width:40px'>备注</th>
        </tr>
        <?php
        $conn = connectDb();
        mysql_query("set character set 'utf8'");//读数据库
        //var_dump($conn);
        $sql = 'select * from room_phone where 1 ';

        if ($room_num != ''){
            $sql .= "and room_num like ('%".$room_num."%')";
        }
        if ($room_division != ''){
            $sql .= "and room_division like ('%".$room_division."%')";
        }
        if ($phone != ''){
            $sql .= "and phone like ('%".$phone."%')";
        }
        //echo $sql;
        
        $result = mysql_query($sql);
        
        //echo "result = ".$result;
        $dataCount = mysql_num_rows($result);
        //echo $dataCount;
        for($i=0;$i<$dataCount;$i++){
            $result_arr=mysql_fetch_assoc($result);
            $id = $result_arr['id'];
            $room_num = $result_arr['room_num'];
            $room_division = $result_arr['room_division'];
            $phone = $result_arr['phone'];
            $others = $result_arr['others'];
        ?>
        <tr>
            <td align="center"><?php echo $id ?></td>
            <td align="center"><?php echo $room_num ?></td>
            <td align="center"><?php echo $room_division ?></td>
            <td align="center"><?php echo $phone ?></td>
            <td align="center"><?php echo $others ?></td>
            </tr>
        <?php
        }
        ?>
        </table>
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