<center>Finish sending your kind words by <a href="/login">logging in.</a> Or, create an account. It's easy:</center>
<div id="create-account">
		<div id="float-right"> 
		<input type="text" id="username" name="username" onblur="putCheckmarkNoSpace('username-small')"/><br>
		<div id="username-error" class="message"></div>  
		</div> 
		<span class="username-small">Username</span>
		 <br><br>
		<div id="float-right">
		<input type="text" id="email" name="email" onblur="putCheckmarkNoSpace('email')"/>
		<div id="username-error" class="message"></div>  
		</div> 
		
		<span class="email">Email</span> 
		<br><br> 
		<div id="float-right">
		<input type="password" id="password" name="password" onblur="putCheckmarkNoSpace('password')"/>
		</div> 
		<span class="password">Password</span>
	    <center>
			<div id="password-error" class="message"></div>
		</center>                                                                  
		<br>
		<div id="float-right"><input type="submit" value="Post" onclick="javascript:checkSmallForm();"></div>
		Submit post as <input type="radio" class="user" name="anon" checked="checked"><b><div id="new_username" style="display:inline;"></div></b> or <input type="radio" name="anon"> anonymous.
		
		</div>
</div>
<script type="text/javascript"> 
	$(document).ready(function(){
		var cur_user = $("#username").val();
		$(".user").html(cur_user);      
		$("#username").change(function(){
			var cur_user = $("#username").val(); 
			$("#new_username").html(cur_user);
		});
	});

</script>
	   
<br>
