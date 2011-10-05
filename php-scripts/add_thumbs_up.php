<?php
	require_once('mysql_connect.php');		//takes mysqlConnect() function and includes
	$post_id = intval($_GET['post_id']);
	mysqlConnect();
	
	$res = mysql_query("SELECT thumbs_up_count FROM posts WHERE id='$post_id'");
	$row = mysql_fetch_array($res);
	$count = intval($row['thumbs_up_count'])+1;
	
	mysql_query("UPDATE posts SET thumbs_up_count='$count' WHERE id='$post_id'");
	
	echo $count;		//echo's back the new thumb count
	
?>