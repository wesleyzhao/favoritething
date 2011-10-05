<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php require_once('php-scripts/profile_functions.php');?> 
 <title>What's your favorite thing about <?php echo getUsername();?> | FavoriteThing.me</title>
   	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="imagetoolbar" content="no" />
	<title>FancyBox 1.3.4 | Demonstration</title>         
	<script type="text/javascript"
	 src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js">
	</script>
	<script type="text/javascript" src="/js/create-user-functions.js"/></script> 
	 	
<?php                           
	include_once('php-scripts/head.php');
	require_once("php-scripts/mysql_connect.php");
	
?>  
	
    <script type="text/javascript">
    	function inputFocus(i){
		    if(i.value==i.defaultValue){ i.value=""; i.style.color="#000"; }
		}
		function inputBlur(i){
		    if(i.value==""){ i.value=i.defaultValue; i.style.color="#888"; }
		}  
		
		$(document).ready(function(){            
			$('.favorite-field').keyup(function(){
  				if($('.favorite-field').val().length > 140){
	            	$('.favorite-field').val($('.favorite-field').val().substring(0, 140));
				}	
				chars = $('.favorite-field').val().length;
				chars = 140-chars;
				$('#chars-count').html(chars + " characters left.");
			});
		});
		
		function makeReply(div_class){       
			div_class_class = "." + div_class; 
			var already_there = $("#reply-container-"+div_class).html();
			if(already_there.indexOf("textarea") == -1){
				$("#reply-container-"+div_class).append("<textarea id=\"a-reply\" name=\"reply_"+div_class+"\" rows=\"2\" cols=\"50\" class=\"comment\"></textarea><input style=\"margin-left: 10px;\" onclick=\"javascript:submitReply("+div_class+")\" type=\"submit\" value=\"Reply\"/>");
			}
  		} 
	</script>
	<div class="content">
	<br><br>                                                                    
	<div id="main-top"></div>
	<div id="main-middle">
		<div class="main-content"> 
		    	<div class="heading">
					
						<div class="username">
	                       <?php echo getUsername();?>
						</div>
						What is your favorite thing about me?     
					
				</div>
			    <div class="picture-div">
			    	<?php echo getPicture();?>
				</div> 
				<input type="image" name="submit" src="images/send.png" id="example1" border="0" class="send-button" onclick='javascript: sendTrait();'/>  
		     	<div class="favorite-field-holder">          
		        	<input type="text" name="favorite" id ="favorite" value="My favorite thing about you is:" title="My favorite thing about you is:" style="color: #888;"class="favorite-field"
					onfocus="inputFocus(this)" onblur="inputBlur(this)">
				</div>
				<div id="get-users"></div>
				<div id="send-as">
				<?php
					print getAnonymous();
				?>  
				</div>
				<div id="chars-count">140 characters left</div>
				  
				
		
			
		</div>
	</div> 
	<div id="main-bottom"></div> 
	<div class="favorites-box">
		<?php echo getFavorites();?>
	</div>                            
	</div>
	<?php	include('php-scripts/footer.php');?>
	<script type = "text/javascript">
	var username = "<?php echo getUsername();?>";
	var written_id = "<?php if ($_SESSION['id']){ echo $_SESSION['id'];} else {echo 0;}?>";
	function setWrittenId(set){
		written_id = set;
	}                              
	function sendTrait(){
		if(written_id == 0){  
	   		$("#get-users").hide();
			$("#get-users").load("/php-scripts/create-account.php");
			$("#get-users").fadeIn("slow"); 
			$("#send-as").hide();
			$("#chars-count").hide();
		}   
		else{
			var user = $("input[class='user']:checked").val();             
			if(user == "on"){
				//do nothing
			}                                
			else{
				written_id = 0;
			}
			//var writtenBy = 0;
			var writtenBy = written_id;
			var text = $("#favorite").val();
			if(text != "My favorite thing about you is:"){
				if (text.length >1){
				var url = encodeURI("php-scripts/profile_edit.php?method=addPost&username="+username+"&written_by="+writtenBy+"&text="+text);
				$(".favorites-box").load(url);
				$("#favorite").val("");
				$("#chars-count").html("140 characters left");    
			}
			}	
		}            
	   	
	}
	
	function submitReply(post_id){
		var writtenBy = written_id;
		var text = $("textarea:[name=reply_"+post_id+"]").val();
		
		if (text.length >1){
			var url = encodeURI("php-scripts/profile_edit.php?method=addReply&user_id="+writtenBy+"&post_id="+post_id+"&text="+text);
			$("#reply-container-"+post_id).load(url);
		}
	}
	
	function addThumb(post_id){
		var url = encodeURI("php-scripts/profile_edit.php?method=addThumb&post_id="+post_id);
		$("#thumbs-count-"+post_id).load(url);
		$("#the-thumb-"+post_id).html("");
	}
	</script>