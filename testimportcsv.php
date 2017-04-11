<?php
require 'mysql_connect.php';
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
$sqlinsert[$i] = "insert into test values('','".$array2[$a][1]."','".$array2[$a][2]."','".$array2[$a][3]."','".$array2[$a][4]."','".$array2[$a][5]."','".$array2[$a][6]."','".$array2[$a][7]."','".$array2[$a][8]."','".$array2[$a][9]."','".$array2[$a][10]."')";
echo $sqlinsert[$i]."<br />";
mysql_query($sqlinsert[$i]);
echo mysql_error();
$i++;
}
     //var_dump($array2);
    
    //print_r($array);
?>