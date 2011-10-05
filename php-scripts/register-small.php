<?php
//gets $_POST variables and checks for sanity of variables
//redirects back to home with a $_GET['register_message'] as to the issue if there is an issue
//if NO issues redirect to dashboard

require_once("mysql_connect.php");		//includes mysqlConnect() function
require_once("get_usernames.php");		//includes getUsernames() function
require_once("session_handler.php");	//imports functions to set Session variables
require_once("email_validation.php");		//includes isValidEmail($email) function, returns true if valid, else false


$full_name = $_POST['full_name'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

mysqlConnect();
$userArr = getUsernames();

if (in_array($username,$userArr)){
//if username is taken
	//header('Location: http://favoritething.me/?register_message=username has already been taken');
	print "0";
}

else if (!checkEmail($email)){
//if email is used
	//header('Location: http://favoritething.me/?register_message=email is already being used');
	print "0";
}

else if (!isValidEmail($email)){
//if email is in valid format
	//header('Location: http://favoritething.me/?register_message=no valid email address was used');   
	print "$email";
	print "0";
}
else{
//otherwise, it is okay and information can be inserted into datatable
	$full_name = mysql_escape_string($full_name);
	$email = mysql_escape_string($email);
	$username = mysql_escape_string($username);
		$username = strtolower($username);		//makes sure all usernames are stored as lowercase
	$password = mysql_escape_string($password);
	$safePass = $password;
	$password = md5($password);
	mysql_query("INSERT INTO users (full_name,username,password,email) VALUES('$full_name','$username','$password','$email')");
	setSession($username,$safePass); //fixed this 8:00PM, just moved it so it's not md5'd
	//header('Location: http//favoritething.me/dashboard'); 
	$id = mysql_insert_id();
	print "$username/$id";
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
