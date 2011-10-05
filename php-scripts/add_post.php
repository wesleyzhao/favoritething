<?php
require_once('mysql_connect.php');		//include mysqlConnect() function
require_once('profile_functions.php');
require_once('facebook_config.php');


//$written_to = intval($_GET['written_to']);
$username = $_GET['username'];
$written_by = intval($_GET['written_by']);
$text = mysql_escape_string($_GET['text']);
$is_private = intval($_GET['is_private']);

mysqlConnect();

$password = getPassword();
if ($password){
	$check = mysql_query("SELECT id FROM users WHERE id='$written_by' AND password='$password'");
	if (!mysql_num_rows($check)){
		$written_by = 0;
	}
}
else{
	$written_by = 0;
}

$written_to = getId($username);

$res = mysql_query("INSERT INTO posts (written_by,written_to,text,is_private) VALUES ('$written_by','$written_to','$text','$is_private')");
$res = mysql_query("SELECT is_auto_fb,oauth_id,access_token,full_name FROM users WHERE id='$written_to'");
$row = mysql_fetch_array($res);
$is_auto_fb = intval($row['is_auto_fb']);		//for the person that it is being written TOWARDS
$written_to_oauth_id = intval($row['oauth_id']);
$written_to_full_name = $row['full_name'];
$token = $row['access_token'];
if ($is_auto_fb == 1 && $token){
//if it is set to post to facebook wall of the person that is written FOR
	//$token = $row['access_token'];
	$id = $row['oauth_id'];
	$poster = getUsername($written_by);
	$posters = $poster."'s";
	//$text = addslashes($text);
	$attach = array(
		'access_token'=>"$token",
		//'message'=>"WTF? I'm matched with some weird people....",
		'name'=>'"'.$text.'"'." is $posters favorite thing about $username",
		'link' =>"http://FavoriteThing.me/$username",
		'description'=>"$poster posted their favorite thing about $username on FavoriteThing.me",
		'picture'=>'http://favoritething.me/images/logo-100.png');
		$facebook->api("/$id/feed",'POST',$attach);
}
if ($written_by !=0){
	$res = mysql_query("SELECT is_auto_fb,oauth_id,access_token FROM users WHERE id='$written_by'");
	$row = mysql_fetch_array($res);
	$is_auto_fb = intval($row['is_auto_fb']);
	$token = $row['access_token'];
	if ($is_auto_fb == 1 && $token){
		//if the person that it was written by, allows for auto-replies
		$id = $row['oauth_id'];
		$poster = getUsername($written_by);
		$posters = $poster."'s";
		if ($written_to_oauth_id !=0){
			$message = "Just left a comment on @[{$written_to_oauth_id}:1:{$written_to_full_name}] FavoriteThing.me page";
		}
		else $message = '';
		//$text = addslashes($text);
		$attach = array(
			'access_token'=>"$token",
			'message'=>$message,
			'name'=>'"'.$text.'"'." is $posters favorite thing about $username",
			'link' =>"http://FavoriteThing.me/$username",
			'description'=>"$poster posted their favorite thing about $username on FavoriteThing.me",
			'picture'=>'http://favoritething.me/images/logo-100.png');
			$facebook->api("/$id/feed",'POST',$attach);
	}
}

$page = $username;		//sets $page variable to the username of the current profile

echo getFavorites($username);

function getPassword(){
	$sql = "SELECT `password` FROM `users` WHERE `id`=".$_SESSION['id']." LIMIT 1";
	$result = mysql_query($sql);
	if (mysql_num_rows($result)){
	$user = mysql_fetch_array($result);
	return $user['password'];
	}
	else{
		return false;
	}
}
?>