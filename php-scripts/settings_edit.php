<?php
//adds the user form submission to the database, or returns the error/success message
require_once("mysql_connect.php");

$full_name = mysql_escape_string($_POST['full_name']);
//$email = $_POST['email'];		//should we allow for an email change? could potentially lead to people deleting their emails
$password = mysql_escape_string($_POST['password']);
$password = md5($password);
$confirm_password = mysql_escape_string($_POST['confirm_password']);
$confirm_password = md5($confirm_password);
$email = mysql_escape_string($_POST['email']);

if (strlen($full_name)<=0){
//if the name is not valid, send back with message
	header('Location: http://favoritething.me/settings-error');
}
else if (($password != $confirm_password) && strlen($password) > 0 && strlen($confirm_password) > 0){
//if password is too short
	header('Location: http://favoritething.me/settings-error');
}
else{
//if everything is just right, update and send message 
	if(strlen($password) ==0 && strlen($password) ==0){
		mysql_query("UPDATE users SET full_name='$full_name' email='$email' WHERE `id`='".$_SESSION['id']."'");
		//$_SESSION['username'] = $username;
		$_SESSION['full_name'] = $full_name;
		$_SESSION['email'] = $email; 
    }  
	else{                                                      
		mysql_query("UPDATE users SET full_name='$full_name',password='$password', email='$email' WHERE `id`='".$_SESSION['id']."'"); 
		//$_SESSION['username'] = $username;
		$_SESSION['full_name'] = $full_name;
		$_SESSION['email'] = $email;
	}
	header('Location: http://favoritething.me/settings-saved');
}



?>