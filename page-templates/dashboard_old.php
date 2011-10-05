<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>Dashboard | FavoriteThing.me</title>	
<?php                           
	include_once('php-scripts/head.php');
	require_once("php-scripts/mysql_connect.php");
	require_once("php-scripts/dashboard_functions.php");
?>
   <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script><script type="text/javascript">stLight.options({publisher:'c971778d-2f84-4218-85c3-acf435d465ef'});</script>
   <div class="dashboard-super">
	<br><br>                     
		<div class="content">
			<div class="dashboard-header"><center>welcome to your dashboard, dshipper</center></div>  
			<input type="text" class="big-link" readonly="readonly" id="big-link" onclick="javascript:document.getElementById('big-link').select();" value="http://favoritething.me/dshipper"/>
			<br>  
			<center>
			<span class="st_sharethis" displayText="ShareThis"></span><span class="st_email" displayText="Email this"></span>
			</center>
			<div class="dashboard-subhead"><center>share the above link with your friends to get responses!</center></div>
  			<br><br>
            <center><div class="response-header">4 responses in the last 24 hours</div> 	
			</center>
            <div class="responses">
            <div id="a-favorite" class="favorite-id">
				<div id="thumbs">0 thumbs up</div>
				<div id="title">Someone said:</div> 
				<b>how cool you are</b>
				<div id="a-reply">
					<div id="title">Someone replied:</div> 
					<b>how cool you are</b>
				</div>
			</div><br>  
			<div id="a-favorite" class="another-favorite-id">  
		    	<div id="thumbs">23 thumbs up</div>
				<div id="title">Someone said:</div> 
				<b>how you move it on the dance floor</b>  
			</div>
			</div>
			
			
			<br>
		</div>
	</div>