<?php  
    if(isset($_POST["submit"]) && $_POST["submit"] == "登录")  
    {  
        $user = $_POST["user_id"];  
        $psw = $_POST["password"];  
        if($user == "" || $psw == "")  
        {  
            echo "<script>alert('请输入学/工号或密码！'); history.go(-1);</script>";  
        }  
        else  
        {  
            mysql_connect("localhost","root","");  
            mysql_select_db("answer_system");  
            mysql_query("set names 'utf8'");  
            $sql = "select * from user where id = '$_POST[user_id]' and password = '$_POST[password]'";  
            //echo "sql:".$sql;
            $result = mysql_query($sql);  
            $num = mysql_num_rows($result);  
            if($num)  
            {  
                $row = mysql_fetch_array($result);  //将数据以索引方式储存在数组中  
                //print_r($row);
                 $ok_user_id = $row['id'];
                 $ok_username = $row['username'];
                 $ok_user_type = $row['user_type'];
                 $post_data = array(
                 "ok_user_id" => $ok_user_id,
                 "ok_username"  => $ok_username,
                 "ok_user_type"  => $ok_user_type
                );
     //$post_data = implode('&',$post_data);  
     //var_dump($post_data);
     $url='http://localhost/answer_system/';  
     $ch = curl_init();  
     curl_setopt($ch, CURLOPT_POST, 1);  
     curl_setopt($ch, CURLOPT_URL,$url);  
     curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);  
     ob_start();  
     curl_exec($ch);  
     $result = ob_get_contents() ;  
     ob_end_clean();  
     echo $result;  
            }  
            else  
            {  
                //echo "num = null";
                echo "<script>alert('学/工号或密码不正确！');history.go(-1);</script>";  
            }  
        }  
    }  
    else  
    {  
        echo "<script>alert('提交未成功！'); history.go(-1);</script>";  
    }  
  
?>  