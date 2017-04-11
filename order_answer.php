<?php
require_once 'functions.php'
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script type="text/javascript" src="jquery-1.4.2.js">
</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>预约答疑</title>
<link href="style.css" type="text/css" rel="stylesheet" />
</style>
</head>
<body>

    
<?php  
    if(isset($_GET["user_id"]) && $_GET["username"] && $_GET["user_type"] && $_GET["wait_answer_id"] && $_GET["these_courses"] && $_GET["answer_time"] && $_GET["others"] )  
    {  
        $user_id = $_GET["user_id"];  
        $username = $_GET["username"];
        $user_type = $_GET["user_type"];
        $wait_answer_id = $_GET["wait_answer_id"];  
        $these_courses = $_GET["these_courses"];
        $answer_time = $_GET["answer_time"];
        $others = $_GET["others"];
        if($user_type != 2){
            echo "<script>alert('您是教师，没有预约答疑的权限！'); history.go(-1);</script>"; 
        }
        ?>
        <div class="container">
        <div class = "wrapper">
            <div class="heading">
              <div class="heading_nav">                 
                <div class="heading_title">
                    <form name="form3" action="index.php" method="post">
                        <input type="hidden" name="ok_user_id" value="<?php echo $user_id; ?>"/>
                        <input type="hidden" name="ok_username" value="<?php echo $username; ?>"/>
                        <input type="hidden" name="ok_user_type" value="2"/>
                        <a href="javascript:form3.submit();" style="color: burlywood;" >教师坐班答疑查询系统</a> 
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
                </ul>
                </div>
            </div>      
            </div>
        
    <div class="body">
    <?php
        if($user_id == "" || $username == "" || $wait_answer_id == "" || $these_courses == "" || $answer_time == "" || $others == "")  
        {  
            echo "<script>alert('有参数为空！'); history.go(-1);</script>";  
        }  
        else  
        {  
            ?>
            <center>
                <form action="order_server.php" method="post">
                    课程名：<?php echo $these_courses; ?>
                    <br />
                    答疑时间：<?php echo $answer_time; ?>
                    <br />
                    其他：<?php echo $others; ?>
                    <br />
                    已预约人数：<?php
                        connectDb();
                        $result = mysql_query("SELECT count(id) FROM order_answer WHERE wait_answer_id = $wait_answer_id and deleted = 0");
                        mysql_query("set names 'utf8'");
                        $final = mysql_fetch_assoc($result);
                        echo $final['count(id)'];
                    ?>
                    <br />
                    <input type="hidden" name="wait_answer_id" value="<?php echo $wait_answer_id ?>">
                    <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                    <textarea style="width: 200px;height: 100px;max-width: 200px;max-height: 100px;" name="order_detail" placeholder="请输入预定时间等信息"></textarea>
                    <br />
                    <input  type="submit" value="预定"/>  
                </form>
            </center>
            <?php 
       }
         
    }else{  
        //print_r($_GET);
        echo "<script>alert('参数错误！'); history.go(-1);</script>";  
    }  
?>  
</div>

    </div>
<div class="footing">
        网络131 201310314012 葛永晖
        </div>
    </div>
</body>
</html>