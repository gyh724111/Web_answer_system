<?php
require_once 'config.php';

function connectDb(){
	mysql_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PW); 
	return mysql_select_db("answer_system");  
}