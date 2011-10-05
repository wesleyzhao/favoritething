<?php
//assume mysql_connect has been included in the page

function getUsernames(){
//connects to MySQL database, retrieves all current usernames
//returns an array of usernames as strings
	mysqlConnect();
	$users = array();
	
	$res = mysql_query("SELECT username FROM users");
	if (mysql_num_rows($res)){
		while ($row = mysql_fetch_array($res)){
			$username = $row['username'];
			$users[] = $username;
		}
	}
	
	return $users;

}
?>