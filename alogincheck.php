<?php  
    if(isset($_POST["submit"]) && $_POST["submit"] == "登录")  
    {  
        $admin = $_POST["adminid"];  
        $psw = $_POST["password"];  
        if($admin == "" || $psw == "")  
        {  
            echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";  
        }  
        else  
        {  
            mysql_connect("localhost","root","");  
            mysql_select_db("answer_system");  
            mysql_query("set names 'utf8'");   
            $sql = "select id,username,password from admin where id = '".$admin."' and password = '".$psw."'";  
            //echo $sql;
            $result = mysql_query($sql);  
            $num = mysql_num_rows($result);  
            if($num)  
            {  
                $row = mysql_fetch_array($result);  //将数据以索引方式储存在数组中  
                $ok_aname = $row['username'];
                //echo "ok_username:".$ok_aname;
                //var_dump($row);
                $post_data = array(
                "ok_username" => $ok_aname,
                );
                //var_dump($post_data);
     //$post_data = implode('&',$post_data); 
     var_dump($post_data); 
     $url='http://localhost/answer_system/aindex.php';  
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
                echo "<script>alert('用户名或密码不正确！');history.go(-1);</script>";  
            }  
        }  
    }  
    else  
    {  
        echo "<script>alert('提交未成功！'); history.go(-1);</script>";  
    }  
  
?>  