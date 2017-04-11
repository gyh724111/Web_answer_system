<?php
require_once 'functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script type="text/javascript" src="jquery-1.4.2.js">
</script>
<meta http-equiv="Content-Type" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<title>修改密码</title>
<link href="style.css" type="text/css" rel="stylesheet" />
</style>
</head>
<body>
<div class="container">
        <div class = "wrapper">
            <div class="heading">
              <div class="heading_nav">                 
                <div class="heading_title">
                    修改密码
                </div>
            </div> 
            </div>  
        
<?php
if($_GET['user_id']){
	$user_id = $_GET['user_id'];
}
?>

<div class="body">
<center>
<form action="edituser_server.php" method="post">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <br />
	原密码:<input type="password" name="oldpwd">
    <br />
    新密码:<input type="password" name="newpwd">
	<br />
    确认密码:<input type="password" name="confirm">
    <br />
	<input type="submit" value="提交修改">
</form>
</center>
</div>

    </div>
		<div class="footing">
        网络131 201310314012 葛永晖
        </div>
    </div>

</body>
</html>