<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>Register for Your Own Page | FavoriteThing.me</title>	
<?php                           
	include_once('php-scripts/head.php');
?>	  
	<script type="text/javascript"
	 src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js">
	</script>
	<script type="text/javascript" src="/js/create-user-functions.js"/></script>  
	<div class="content">
	<br><br>
	<div id="main-top"></div>
	<div id="main-middle">
		<div class="main-content">     
			
	   		<center><h1>Sign up</h1>    
	 		</center>               
			<br><br>
			<div class="login-container">
			<div id="float-right">                          
				<div id="float-right">
					<div class="field-holder">
					<input type="text" id="username" class="login-big" name="username" onblur="putCheckmark('username')"/>
					<div id="small-text">favoritething.me/</div>
					</div>
					<center>
						<div id="username-error" class="message"></div>
					</center>
					  
				</div>
			</div>
			<div id="login-text" class="username">
				Username<br>     
			</div>
			<br>
			<div id="float-right">                          
				<div id="float-right">
					<div class="field-holder">
					<input type="text" id="email" class="login-big" name="email" onblur="putCheckmark('email')"/>   
					</div>
					<center>
						<div id="email-error" class="message"></div>
					</center>  
				</div>
			</div>
			<div id="login-text" class="email">
				Email<br>     
			</div>
			<br>
			<div id="float-right">                          
				<div id="float-right">
					<div class="field-holder">
					<input type="password" id="password" class="login-big" name="password" onblur="putCheckmark('password')"/> 
					</div>
					<center>
						<div id="password-error" class="message"></div>
					</center>  
				</div>
			</div>
		
			<div id="login-text" class="password">
				Password<br>     
			</div> 
			<br>
			<div id="float-right">                          
				<div id="float-right">
					<div class="field-holder">
					<input type="password" id="password2" class="login-big" name="password2" onblur="putCheckmark('password2')"/>                
					</div>
					<center>
						<div id="password2-error" class="message"></div>
					</center>  
				</div>
			</div>
			<div id="login-text" class="password2">
				Confirm password<br>     
			</div>
			
			<br>
			<div id="float-right">                          
				<div id="float-right">
					<div class="field-holder">
					<input type="text" id= "name" class="login-big" name="name" onblur="putCheckmark('name')"/>  
					</div>
					<center>
						<div id="name-error" class="message"></div>
					</center>  
				</div>
			</div>
			<div id="login-text" class="name">
				Full name<br>     
			</div>
			
			
			
			<br><br>
			<center><input type="submit" value="Get some love" onclick='checkForm()'/></center>
			  
		    
			</div>
			
		</div>
	</div> 
	<div id="main-bottom"></div>                             
	</div>
	<?php	include('php-scripts/footer.php');?>