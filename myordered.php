<?php
require_once 'functions.php'
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script type="text/javascript" src="jquery-1.4.2.js">
</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>教师坐班答疑查询</title>
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
                <p>您可以查询被预约的课程！</p>

        <table style='text-aline:center'; border='1'>
        <tr>
            <th style='width:200px'>负责科目</th>
            <th style='width:80px'>答疑地点</th>
            <th style='width:200px'>答疑时间</th>
            <th style='width:40px'>其他</th>
            <th style='width:80px'>已预约人数</th>
        </tr>
        <?php
        $conn = connectDb();
        mysql_query("set character set 'utf8'");//读数据库
		$sql = "select oa.id as oa_id,wa.id as wa_id,wa.these_courses,wa.answer_time,
		wa.answer_position,wa.others as wa_others,count(oa.id) as oa_count from wait_answer wa,order_answer oa 
		where oa.deleted = 0 and oa.wait_answer_id = wa.id and wa.teacher_id = '".$user_id."' group by wait_answer_id";
		//echo $sql;
		$result = mysql_query($sql);
        
        //echo "result = ".$result;
        $dataCount = mysql_num_rows($result);
        //echo $dataCount;
        for($i=0;$i<$dataCount;$i++){
            $result_arr=mysql_fetch_assoc($result);
            $oa_id = $result_arr['oa_id'];
            $these_courses = $result_arr['these_courses'];
            $answer_time = $result_arr['answer_time'];
            $answer_position = $result_arr['answer_position'];
            $wa_others = $result_arr['wa_others'];
            $count = $result_arr['oa_count'];
            $wait_answer_id = $result_arr['wa_id']; 
            //var_dump($result_arr);
        ?>
        <tr>
            <td align="center"><?php echo $these_courses ?></td>
            <td align="center"><?php echo $answer_position ?></td>
            <td align="center"><?php echo $answer_time ?></td>
            <td align="center"><?php echo $wa_others ?></td>
            <td align="center"><?php echo 
            "<a href='ordered_detail.php?wait_answer_id=$wait_answer_id&user_id=$user_id&username=$username&user_type=$user_type'>".$count." 人</a>"; ?></td>
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