<?php
	require_once('php-scripts/mysql_connect.php');
	require_once('php-scripts/facebook_config.php');
	require_once('php-scripts/session_handler.php');

	$dir = $_GET['redirect'];
	$id = isFbLogged();
	if ($id){
		checkOauth($id);
		header("Location: http://favoritething.me/$dir");
	}
	else{
		header('Location: http://favoritething.me/login');
	}
	function checkOauth($fb_id){
	mysqlConnect();
//will only be called if user has fb_session established
	$cur_id = $_SESSION['oauth_id'];
	$id = getUserId();
	if ($cur_id == 0){
		$_SESSION['oauth_id'] = $fb_id;
		$access_token = getToken();
		$_SESSION['access_token'] = $access_token;
		//print "UPDATE users SET oauth_id='$fb_id',access_token='$access_token' WHERE id='$id'";
		mysql_query("UPDATE users SET oauth_id='$fb_id',access_token='$access_token' WHERE id='$id'");
	}
}
?>