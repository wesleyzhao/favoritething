<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>Dashboard | FavoriteThing.me</title>	
<?php                           
	include_once('php-scripts/head.php');
	require_once("php-scripts/mysql_connect.php");
	require_once("php-scripts/dashboard_functions.php");
	require_once("php-scripts/session_handler.php");
	require_once("php-scripts/facebook_config.php");
	$id = isLogged();
	if (!$id) header('Location: http://favoritething.me/login');
?>
   <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script><script type="text/javascript">stLight.options({publisher:'c971778d-2f84-4218-85c3-acf435d465ef'});</script>

   <div class="dashboard-super">                    
		<div class="content">
			<div class="dashboard-subhead"><center><b>Share</b> this link with your friends to get responses!</center></div>
			<input type="text" class="big-link" readonly="readonly" id="big-link" onclick="javascript:document.getElementById('big-link').select();" value="<?php echo getUrl();?>"/>
			<br>
			<?php
			
			if($_SESSION['oauth_id']){
				$sql = "SELECT `is_auto_fb` FROM `users` WHERE `id`='".$_SESSION['id']."'";
				$result = mysql_query($sql);
				$row = mysql_fetch_array($result);
				if($row['is_auto_fb'] == 1 || $row['is_auto_fb'] == '1'){
					print "Post replies to Facebook <input type='radio' name='post' class='fb' checked='checked'> on <input type='radio' class='no-fb' name='post'>off";
					
				}   
				else{
					print "Post replies to Facebook <input type='radio' name='post' class='fb'> on <input type='radio' class='no-fb' name='post' checked='checked'>off";
					
				}
   			}                                                                                                            
			else{
				print "<fb:login-button perms='offline_access,publish_stream'>Login with Facebook to Find Friends</fb:login-button>";
			}
			
			?>     
			<div id="float-right"><?php echo getFbShare();?><?php echo getTweet();?><span class="st_email" displayText="Email this"></span>
			</div>    
			<br><br>
			
  			<br>
			<br>
<center><?php echo getPicture();?></center>    
<br><br>
            <center><div class="response-header"><?php print getLastDay();?></div> 	
			</center>
            <div class="responses">
				<?php echo getPosts();?>
			</div>
			
			
			<br>
		</div>
	</div>
<?php	include('php-scripts/footer.php');?>
 <div id="fb-root"></div>
      <script src="http://connect.facebook.net/en_US/all.js"></script>
      <script>
         FB.init({ 
            appId:'<?=FACEBOOK_APP_ID?>', cookie:true, 
            status:true, xfbml:true 
         });
      FB.Event.subscribe('auth.login', function(response) {
        document.location = "/facebook-register.php?redirect=dashboard";
      });
 </script>
<script type="text/javascript"
	 src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js">
</script>
<script type = "text/javascript">
	var username = "<?php echo getUsername();?>";
	var written_id = "<?php if ($_SESSION['id']){ echo $_SESSION['id'];} else {echo 0;}?>";
	function delPost(post_id){
		var url = encodeURI("php-scripts/dashboard_edit.php?method=delPost&post_id="+post_id);
		$(".responses").load(url);
	}
	
	function delReply(reply_id){
			var url = encodeURI("php-scripts/dashboard_edit.php?method=delReply&reply_id="+reply_id);
			$(".responses").load(url);
	}
	
	function addThumb(post_id){
		var url = encodeURI("php-scripts/profile_edit.php?method=addThumb&post_id="+post_id);
		$("#thumbs-count-"+post_id).load(url);
		$("#the-thumb-"+post_id).html("");
	}  
	
	function radioClicks(){
		var fb = $("input[class='fb']:checked").val();
		if(fb == "on"){
			$.get("/set-fb");
		}               
		else{
			$.get("/unset-fb");
		}
		
	}
	
	$(document).ready(function(){
	   	$( "input[name='post']").bind( "click", radioClicks)
	});
	
</script>