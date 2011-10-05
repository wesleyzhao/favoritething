<?php
require_once("get_usernames.php");		//getUsernames() function which gets all usernames
require_once("mysql_connect.php");		//mysqlConnect() function

$username = $_GET['username'];
$username = strtolower($username);	//makes sure the check is with lower-case usernames only
$arr = getUsernames();
$arr[] = 'register';
$arr[] = 'login';
$arr[] = 'settings';
$arr[] = 'dashboard';
$arr[] = 'find-friends';
$arr[] = 'login-user';
$arr[] = 'login-error';
$arr[] = 'update-settings';
$arr[] = 'settings-error';
$arr[] = 'settings-saved';
$arr[] = 'about';
$arr[] = 'logout';


if (in_array($username,$arr)){
//if the username already exists, return a 0 for false
	echo 0;
}
else{
//if the username does not exist, return a 1 for true
	echo 1;
}
?>