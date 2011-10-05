<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>Login | FavoriteThing.me</title>	
<?php                           
	include('php-scripts/head.php');
	require_once('php-scripts/session_handler.php');
	$id = isLogged();
	if ($id) header('Location: http://favoritething.me/dashboard');
?>	  
	<div class="content">
	<br><br>
	<div id="main-top"></div>
	<div id="main-middle">
		<div class="main-content">     
			<center>
			<div class="login-head">Login</div>    
	 	    <?php              
	        	print "<br><div class='message'>$message</div>";
			?>
	        <form action="/login-user" method="post">              
			<br><br>
				<span id="login-text">Username: </span><input type="text" name="username" id="username" class="nice-login"><br><br>
				<span id="login-text">Password: </span><input type="password" name="password" id="username" class="nice-login"><br><br> 
				<input type="submit" value="Login">
			</form>
			<h3>Don't have an account? <a href="http://favoritething.me/signup" alt="Sign Up for your own FavoriteThing.Me page">Register here</a>.</h3>
			</center>
		</div>
	</div> 
	<div id="main-bottom"></div>                             
	</div>
	<?php	include('php-scripts/footer.php');?>
	
