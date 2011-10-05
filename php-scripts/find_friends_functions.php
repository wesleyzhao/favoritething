<?php
//require_once('mysql_connect.php');
//require_once('session_handler.php');
//require_once('facebook_config.php');		//assumes that this is already required


function getHTML(){
global $facebook;
mysqlConnect();
	$uid  = hasOauth();
	try{
	if ($uid){
		$user = $facebook->api("/$uid/friends");
		$friends = $user['data'];
		$users = array();
		$found = array();
		$res = mysql_query("SELECT oauth_id,username FROM users WHERE oauth_id!='0'");
		while ($row = mysql_fetch_array($res)){
			$users[$row['oauth_id']] = $row['username'];
		}
			foreach ($friends as $friend){
				if ($users[$friend['id']]){
					$found[$friend['id']] = $users[$friend['id']];
				}
			}
		
		
		return getFriendsHtml($found);
	}
	else{
		$html = "<fb:login-button perms='offline_access,publish_stream'>Connect</fb:login-button> to find your friends! (We promise we do not post on your wall without permission.)";
	}
	}
	catch (Exception $e){
		mysql_query("UPDATE users SET oauth_id='0',access_token='' WHERE oauth_id='$uid'");
		$_SESSION['oauth_id'] = 0;
		$_SESSION['access_token']='';
		$html = "<fb:login-button perms='offline_access,publish_stream'>Connect</fb:login-button> to find your friends! (We promise we do not post on your wall without permission.)";
	}
	
	return $html;
}

function getFriendsHtml($found_array){
//takes an array of usernames and returns the html for each user
//array has key of oauth_id and value of username

$html = '';
	if (count($found_array) == 0){
		$html = "Currently no Facebook friends are logged-in :(<br> <a name='fb_share' type='button' share_url='http://favoritething.me/' href='http://www.facebook.com/sharer.php'>Share</a> to get your friends their own pages.<script src='http://static.ak.fbcdn.net/connect.php/js/FB.Share' type='text/javascript'></script>";
	}
	else{
		foreach ($found_array as $oauth_id=>$username){
			$html = $html."<li><div class='fb-span'><a href='http://favoritething.me/$username' class='tooltip' title=\"$username | favoritething.me\"><img src = 'http://graph.facebook.com/$oauth_id/picture?type=square' alt='$username FavoriteThing profile'></a></div></li>";
		}
	}
	return $html;
}





?>