<?php
//functions to get session information and edit session information
//assumes mysql_connect.php has been required

function getUserId(){
//uses the $_SESSION variable to get id of user
//returns a string form of the id
	$id = $_SESSION['id'];
	return $id;
}

function isLogged(){
//checks if current user is logged in or not
//returns user id number if the user is logged in
//returns false if user is not logged in

	$id = getUserId();
	if ($id){
		return $id;
	}
	else return false;
} 

function getPassword(){
	$sql = "SELECT `password` FROM `users` WHERE `id`=".$_SESSION['id']." LIMIT 1";
	$result = mysql_query($sql);
	$user = mysql_fetch_array($result);
	return $user['password'];
}

function getUsername(){
//gets session username, returns username of session
	$user = $_SESSION['username'];
	return $user;
}

function getFullname(){
//returns the full name of the individual
	$full_name = $_SESSION['full_name'];
	return $full_name;
}

function getEmail(){
//returns the email of the session
	$email = $_SESSION['email'];
	return $email;
}
function setSession($username,$password){
	//sets the session variables with 'id', 'username', and 'full_name','email','oauth_id', and 'is_private' variables
	//returns true if the session was set
	//returns false if the username and password did not match, and session was not set
	//use this for log-in
	mysqlConnect();
	$username = mysql_escape_string($username);
	$password = mysql_escape_string($password);
	$password = md5($password);   
	$query = mysql_query("SELECT * FROM users WHERE username='$username' AND password='$password'");
	if (mysql_num_rows($query)){
	//if username and password match is found
		$row = mysql_fetch_array($query);
		$_SESSION['username']=$username;
		$_SESSION['id'] = intval($row['id']);
		$_SESSION['email'] = $row['email'];
		$_SESSION['oauth_id'] = intval($row['oauth_id']);
		$_SESSION['full_name'] = $row['full_name'];
		$_SESSION['is_private'] = intval($row['is_private']);
		$_SESSION['access_token'] = $row['access_token'];
		return true;
	}
	else{
	//if username/password combo is not found
		return false;
	}
}

function clearSession(){
//closes the session and destroys the data	
	session_destroy();
}

function hasOauth(){
//returns the oauth_id if it exists
//returns false if not
	if ($_SESSION['oauth_id']>0){
		return $_SESSION['oauth_id'];
	}
	else return false;
}

?>
