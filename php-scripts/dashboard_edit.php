<?php	
	require_once("mysql_connect.php");		//adds mysqlConnect() functionm
	require_once("dashboard_functions.php");		//gets all the functions necessary for reloading
	require_once("session_handler.php");
	
	$method = $_GET['method'];			//either to be 'delPost' or 'delReply' (meaning delete post, or delete reply)
	echo doMethod($method);
	
	function doMethod($method){
	//takes the method GET variable and decides what to do with it
		if ($method == 'delPost'){
		//meant to delete a post from a user, then return the newly loaded posts
			$post_id = $_GET['post_id'];
			mysqlConnect();
			mysql_query("UPDATE posts SET is_deleted='1' WHERE id='$post_id'");
			mysql_query("UPDATE replies SET is_deleted='1' WHERE post_id='$post_id'");
			return getPosts();		//from dashboard_functions.php
		}
		else if ($method == 'delReply'){
			$reply_id = $_GET['reply_id'];
			mysqlConnect();
			mysql_query("UPDATE replies SET is_deleted='1' WHERE id='$reply_id'");
			return getPosts();		//from dashboard_functions.php
		}
		
	}
?>