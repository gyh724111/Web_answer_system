<?php
require 'mysql_connect.php';
header("Content-type:text/html;charset=utf-8");
if ($_FILES["file"]["error"] > 0)
{
	echo "Error: ".$_FILES["file"]["error"] . "<br />";
}
else
{
	echo "Upload:".$_FILES["file"]["name"]."<br />";
	echo "Type:".$_FILES["file"]["type"]."<br />";
	echo "Size:".($_FILES["file"]["size"]/1024)."Kb<br />";
	echo "Stored in:".$_FILES["file"]["tmp_name"];
	
}
$UpLoadFile = move_uploaded_file($_FILES["file"]["tmp_name"], "/Applications/XAMPP/xamppfiles/htdocs/answer_system/uploadexcel/upload.csv");


//testimportcsv.php

mysql_query("set names utf8");
$row = 1;
if (($handle = fopen("uploadexcel/upload.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle,",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c = 0; $c < $num; $c++) {
                $array[$c] = $data[$c];
        }
    }
    
    fclose($handle);
}

 $j = 0;
     for($p = 0;$p<=$num;$p++){
         for($q = 1;$q <= 10;$q++){
            if($array[$j]!=''){
             $array2[$p][$q] = trim($array[$j]);
         }else{
            break;
         }
             if($j<$num-1){
                $j++;
         }else{
            break;
         }
     }
 }
 $i = 0;
for($a = 0;$a<count($array2);$a++){
$sqlinsert[$i] = "insert into user(id,username,user_type) values('".$array2[$a][2]."','".$array2[$a][3]."',1)";
echo $sqlinsert[$i]."<br />";
mysql_query($sqlinsert[$i]);
echo mysql_error();
$i++;
}
?>