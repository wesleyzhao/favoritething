<?php
//attempts a log-in, if failed, then send back appropriate message
//if success send to dashboard

require_once("mysql_connect.php");
require_once("session_handler.php");

$username = $_POST['username'];
	$username = strtolower($username);		//makes sure it is converted to lowercase username
$password = $_POST['password'];      

$good = setSession($username,$password);		//loaded from session_handler.php
//sets session if valid, returns false if not

if ($good){
	header('Location: http://favoritething.me/dashboard');
}
else{
//log-in bad, send back with propoer GET message
	header('Location: http://favoritething.me/login-error');
}
?>