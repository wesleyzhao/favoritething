<?php
	require_once('mysql_connect.php');		//takes mysqlConnect() function and includes
	require_once('profile_functions.php');		//required so that comments can be reloaded with getComments($post_id);
	$user_id = intval($_GET['user_id']);
	$post_id = intval($_GET['post_id']);
	$text = mysql_escape_string($_GET['text']);
	
	mysqlConnect();
	
	$res = mysql_query("INSERT INTO replies (user_id,post_id,text) VALUES ('$user_id','$post_id','$text')");
	
	echo getComments($post_id);		//returns back reloaded comments
	
?>