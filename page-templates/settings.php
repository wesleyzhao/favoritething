<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>Settings | FavoriteThing.me</title>	
<?php                           
	include_once('php-scripts/head.php');
	require_once("php-scripts/mysql_connect.php");
	require_once("php-scripts/settings_functions.php");
	$id = isLogged();
	if (!$id) header('Location: http://favoritething.me/login');
?>
   <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script><script type="text/javascript">stLight.options({publisher:'c971778d-2f84-4218-85c3-acf435d465ef'});</script>
   <div class="settings-super">
	<br><br>                     
		<div class="content">
			<div class="dashboard-header"><center>my settings</center></div>
			<br>
			<center><div class="message"><?php print $message;?></div></center>
	        <div class="settings-content">
			<br><br>      
			<form action="/update-settings" method="post">
			<span id="login-text">email</span>
			<input type="text" name="email" class="nice-login" id="float-right" value="<?php print getEmail(); ?>" /><br> <br>
			<span id="login-text">full name</span>   
			<input type="text" name="full_name" class="nice-login" id="float-right" value="<?php print getFullname(); ?>"/><br>        <br>
			<span id="login-text">password</span>   
			<input type="password" name="password" class="nice-login" id="float-right"/><br>             <br> 
			<span id="login-text">confirm password</span>
			<input type="password" name="confirm_password" class="nice-login" id="float-right"><br><br>
			<input type="submit"  value="Update Settings"/>    
			</form>
            </div>
			<br>
		</div>
	</div>
	<?php	include('php-scripts/footer.php');?>