<?php
require('src/facebook.php');

$facebook = new Facebook(array(
	'appId' => '196165540410007',		//specific to PleaseMatchMe
	'secret' => '6fc3f023190e8ed1788fa8d4f5ced0ed',		//specific to PleaseMatchMe
	'cookie' => true,
	));


function isFbLogged(){
//reads the global $facebook variable
//returns the user fb_id if the user is signed on, else returns false
	global $facebook;
	$session = $facebook->getSession();
	if ($session){
		try{
			$uid = $facebook->getUser();
			$person = $facebook->api("/$uid");
			return $uid;
		}
		catch (FacebookApiException $e){
			return false;
		}
	}
	else{
		return false;
	}
}


function getUser($uid,$token=''){
global $facebook;
	$user = $facebook->api("/$uid",array('access_token'=>$token));
	return $user;
}

function getToken(){
	global $facebook;
	return $facebook->getAccessToken();
}

define('FACEBOOK_APP_ID', '196165540410007');
?>