<?php
require_once('facebook_config.php');

$access_token = $_GET['access_token'];
$oauth_id = $_GET['user_oauth_id'];
$friend_count = $_GET['friend_count'];
$places_count = $_GET['places_count'];

$attach = array(
		'access_token'=>"$access_token",
		//'message'=>"WTF? I'm matched with some weird people....",
		'name'=>"I have $friend_count friends in $places_count different places in the world! Look at my map.",
		'link' =>"http://wheremyfriends.be/profile?id=$oauth_id",
		'description'=>"See a dynamic map of all your friends aroud the world | Where My Friends Be?",
		'picture'=>'http://wheremyfriends.be/images/icon.png');
		
		
try{
$facebook->api("/$oauth_id/feed",'POST',$attach);
}
catch (Exception $e){
}

?>
