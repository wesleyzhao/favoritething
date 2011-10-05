<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>Find Your Friends Pages | FavoriteThing.me</title>	
<?php                           
	include_once('php-scripts/head.php');
	require_once("php-scripts/mysql_connect.php");
	require_once("php-scripts/find_friends_functions.php");
	require_once("php-scripts/session_handler.php");
	require_once("php-scripts/facebook_config.php");
	$id = isLogged();
	if (!$id) header('Location: http://favoritething.me/login');
?>  
    <script type="text/javascript"
	 src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js">
	</script>                                                         
	<script src="js/tooltip.js" type="text/javascript"></script>
	<style>
		#tooltip{
			position:absolute;
			border:1px solid #333;
			background:#f7f5d1;
			padding:2px 5px;
			color:#333;
			display:none;
		}
	</style>       
   <div id="results-container">   
   <h1 align="center">Your friends on FavoriteThing.Me: </h1>
			<ul><?php echo getHTML();?></ul>
	</div>
 <div id="fb-root"></div>
      <script src="http://connect.facebook.net/en_US/all.js"></script>
      <script>
         FB.init({ 
            appId:'<?=FACEBOOK_APP_ID?>', cookie:true, 
            status:true, xfbml:true 
         });
      FB.Event.subscribe('auth.login', function(response) {
        document.location = "/facebook-register.php?redirect=find-friends";
      });
 </script>
<script type="text/javascript"
	 src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js">
</script>