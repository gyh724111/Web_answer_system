<?php
require_once 'functions.php'
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script type="text/javascript" src="jquery-1.4.2.js">
</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>我的预约</title>
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
        if($user_type != 2){
        	echo "<script>alert('用户类型错误！'); history.go(-1);</script>"; 
        }
?>

	<div class="container">
    	<div class = "wrapper">
        	<div class="heading">
           	  <div class="heading_nav">                	
                <div class="heading_title">
                    <form name="form6" action="index.php" method="post">
                        <input type="hidden" name="ok_user_id" value="<?php echo $user_id; ?>"/>
                        <input type="hidden" name="ok_username" value="<?php echo $username; ?>"/>
                        <input type="hidden" name="ok_user_type" value="<?php echo $user_type; ?>"/>
                        <a href="javascript:form6.submit();" style="color: burlywood;" >教师坐班答疑查询系统</a> 
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
                            <?php if($username != ''){
                                echo "<a href='myorders.php?user_id=$user_id&username=$username&user_type=$user_type'>我的预约</a>";}
                                ?><br>
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
                <p>您可以查看您预约的答疑，在该页面可以进行取消操作！</p>
                

        <table style='text-aline:center'; border='1'>
        <tr>
            <th style='width:50px'>编号</th>
            <th style='width:200px'>预定科目</th>
            <th style='width:70px'>教师姓名</th>
            <th style='width:200px'>答疑时间</th>
            <th style='width:50px'>其他</th>
            <th style='width:200px'>预约详情</th>
            <th style='width:60px'>操作</th>
        </tr>
        <?php
        $conn = connectDb();
        mysql_query("set character set 'utf8'");//读数据库
        //var_dump($conn);
        $sql = "select oa.id oa_id,wa.these_courses wa_these_courses,wa.teacher_name wa_teacher_name,
        wa.answer_time wa_answer_time,wa.others wa_others,oa.others oa_others from wait_answer wa,order_answer oa where oa.wait_answer_id = wa.id and oa.user_id = $user_id and oa.deleted = 0";
        
        //echo "sql = ".$sql;
            $result = mysql_query($sql);
        
        //echo "result = ".$result;
        $dataCount = mysql_num_rows($result);
        //echo $dataCount;
        for($i=0;$i<$dataCount;$i++){
            $result_arr=mysql_fetch_assoc($result);
            $oa_id = $result_arr['oa_id'];
            $wa_these_courses = $result_arr['wa_these_courses'];
            $wa_teacher_name = $result_arr['wa_teacher_name'];
            $wa_answer_time = $result_arr['wa_answer_time'];
            $wa_others = $result_arr['wa_others'];
            $oa_others = $result_arr['oa_others'];
        ?>
        <tr>
            <td align="center"><?php echo $oa_id ?></td>
            <td align="center"><?php echo $wa_these_courses ?></td>
            <td align="center"><?php echo $wa_teacher_name ?></td>
            <td align="center"><?php echo $wa_answer_time ?></td>
            <td align="center"><?php echo $wa_others ?></td>
            <td align="center"><?php echo $oa_others ?></td>
            <td align="center">
            	<form name="form7" action="cancelmyorder_server.php" method="post">
                    <input type="hidden" name="order_answer_id" value="<?php echo $oa_id; ?>"/>
                    <a href="javascript:form7.submit();" style="color: red;" >取消</a> 
                </form>
            </td>
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