<?php
require_once("mysql_connect.php");		//mysqlConnect() function

$email = $_GET['email'];

if (checkEmail($email)){
//if the email is okay!
	echo 1;
}
else{
//if email has already been taken
	echo 0;
}
function checkEmail($email){
//returns true if the email has no duplicates
//returns false, if the email is found to be a duplicate in the datatable
	mysqlConnect();
	$res = mysql_query("SELECT id FROM users WHERE email='$email'");
	if (mysql_num_rows($res)) return false;
	else return true;
}
?>