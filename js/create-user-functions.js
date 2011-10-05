 	var g_username = 0;
	var g_email = 0;
	var g_password = 0;
	var g_password2 = 0;
	var g_name = 0;
	function checkForm(){
		var username = $("#username").val();  
		var email = $("#email").val(); 
		var password = $("#password").val(); 
		var full_name = $("#name").val();  
		if(username.length > 0 && email.length > 0 && password.length >0 && full_name.length > 0){   
			var dataString = 'username='+ username + '&email=' + email + '&full_name=' + full_name +'&password='+password;       
			$.ajax({  
			  type: "POST",  
			  url: "php-scripts/register.php",  
			  data: dataString,  
			  success: function(data) {  
			    	if(data == 1){
				    	document.location = "/dashboard";
					}       
					else{
					   
					}                     
			  }  
			});
		}
	}
	function checkSmallForm(){
		var username = $("#username").val();  
		var email = $("#email").val(); 
		var password = $("#password").val();  
		var full_name = "xxxxx";  
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;  
		if(username.length > 0 && email.length > 0 && password.length >0 && reg.test(email) != false){
			var dataString = 'username='+ username + '&email=' + email + '&full_name=' + full_name +'&password='+password;        
			$.ajax({  
			  type: "POST",  
			  url: "php-scripts/register-small.php",  
			  data: dataString,  
			  success: function(data) {  
			    	if(data != 0){
						//now we have username/id so...
						var arr = data.split("/");
						username = arr[0];
						written_id = arr[1];   
						sendTrait();
						$("#send-as").fadeIn("slow");
						$("#send-as").html("<div id='highlight'>You are logged in. <a href='/dashboard'>Click here to see your dashboard.</a></div>");
						$("#chars-count").fadeIn("slow");
						$("#get-users").fadeOut("fast");             
						
					}  
					else{
					   
					}
			  }  
			});
		}
	}
	function putCheckmarkNoSpace(div){
		$(document).ready(function(){ 
			if(div == "username"){
				var username = $("#username").val();
				if(username.length > 0){
					$.get("php-scripts/check_username.php?username="+username, function(data){
						if(data == "1"){
							$(".username").html("<img src='images/check.png' class='check'>Username"); 
							$("#username-error").html(""); 
							g_username = 1;
							
						}                                                                                   
						else{
							$(".username").html("<img src='images/x.png' alt='That username is already taken.' class='check'>Username"); 
							$("#username-error").html("Sorry, that username is taken."); 
							g_username = 0;
						}
					}); 
				}else{
					$(".username").html("<img src='images/x.png' alt='Please enter a username.' class='check'>Username"); 
					$("#username-error").html("Please enter a username.");
					g_username = 0;
				}   
			}
			else if(div == "username-small"){
				var username = $("#username").val();
				if(username.length > 0){
					$.get("php-scripts/check_username.php?username="+username, function(data){
						if(data == "1"){
							$(".username-small").html("<img src='images/check.png' class='check'>Username"); 
							$("#username-error").html(""); 
							g_username = 1;
							
						}                                                                                   
						else{
							$(".username-small").html("<img src='images/x.png' alt='That username is already taken.' class='check'>Username"); 
							$("#username-error").html("Sorry, that username is taken."); 
							g_username = 0;
						}
					}); 
				}else{
					$(".username-small").html("<img src='images/x.png' alt='Please enter a username.' class='check'>Username"); 
					$("#username-error").html("Please enter a username.");
					g_username = 0;
				}   
			}
			else if( div == "email"){
				var email = $("#email").val();
				if(email.length > 1){
					var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
				   	if(reg.test(email) == false) {
				      	$(".email").html("<img src='images/x.png' class='check'>Email");
						$("#email-error").html("Sorry, that email is not valid."); 
						g_email = 0;
				   	}
					else{
						$.get("php-scripts/check_email.php?email="+email,function(data){
							if (data =="1"){
									$(".email").html("<img src='images/check.png' class='check'>Email"); 
									$("#email-error").html("");    
									g_email = 1;
							}
							else{
								$(".email").html("<img src='images/x.png' class='check'>Email");
								$("#email-error").html("Sorry, that email is already taken."); 
								g_email = 0;									
							}
						});
					}   
				}
				      
			}   
			else if(div == "password"){
				var password = $("#password").val();
				if(password.length > 3){
					$(".password").html("<img src='images/check.png' class='check'>Password");
					$("#password-error").html("");
					g_password = 1;       
				}                                                                                        
				else{
					$(".password").html("<img src='images/x.png' class='check'>Password");
					$("#password-error").html("Sorry, your password must be longer than 3 characters.");
					g_password = 0;  
				}
				
			}   
			else if(div == "password2"){ 
				var password = $("#password").val(); 
				var password2 = $("#password2").val();
				if(password == password2){
					$(".password2").html("<img src='images/check.png' class='check'>Confirm password");
					$("#password2-error").html("");  
					g_password2 = 1; 
				}
				else{
					$(".password2").html("<img src='images/x.png' class='check'>Confirm password");
					$("#password2-error").html("Sorry, your password must be longer than 3 characters."); 
					g_password2 = 0; 
				}
				       
			}   
			else if(div == "name"){
				var name = $("#name").val();
				if(name.length > 1){
					$(".name").html("<img src='images/check.png' class='check'>Full name");
					$("#name-error").html(""); 
					g_name= 1;  
				}  
				else{
				   	$(".name").html("<img src='images/x.png' class='check'>Full name");
					$("#name-error").html("Please include your full name.");  
					g_name = 0; 
				}
				      
			}
		});
	}
    function putCheckmark(div){
		$(document).ready(function(){ 
			if(div == "username"){
				var username = $("#username").val();
				if(username.length > 0){
					$.get("php-scripts/check_username.php?username="+username, function(data){
						if(data == "1"){
							$(".username").html("<img src='images/check.png' class='check'>Username<br>"); 
							$("#username-error").html(""); 
							g_username = 1;
							
						}                                                                                   
						else{
							$(".username").html("<img src='images/x.png' alt='That username is already taken.' class='check'>Username<br>"); 
							$("#username-error").html("Sorry, that username is taken."); 
							g_username = 0;
						}
					}); 
				}else{
					$(".username").html("<img src='images/x.png' alt='Please enter a username.' class='check'>Username<br>"); 
					$("#username-error").html("Please enter a username.");
					g_username = 0;
				}   
			}
			else if(div == "username-small"){
				var username = $("#username").val();
				if(username.length > 0){
					$.get("php-scripts/check_username.php?username="+username, function(data){
						if(data == "1"){
							$(".username-small").html("<img src='images/check.png' class='check'>Username<br>"); 
							$("#username-error").html(""); 
							g_username = 1;
							
						}                                                                                   
						else{
							$(".username-small").html("<img src='images/x.png' alt='That username is already taken.' class='check'>Username<br>"); 
							$("#username-error").html("Sorry, that username is taken."); 
							g_username = 0;
						}
					}); 
				}else{
					$(".username-small").html("<img src='images/x.png' alt='Please enter a username.' class='check'>Username<br>"); 
					$("#username-error").html("Please enter a username.");
					g_username = 0;
				}   
			}
			else if( div == "email"){
				var email = $("#email").val();
				if(email.length > 1){
					var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
				   	if(reg.test(email) == false) {
				      	$(".email").html("<img src='images/x.png' class='check'>Email<br>");
						$("#email-error").html("Sorry, that email is not valid."); 
						g_email = 0;
				   	}
					else{
						$.get("php-scripts/check_email.php?email="+email,function(data){
							if (data =="1"){
									$(".email").html("<img src='images/check.png' class='check'>Email<br>"); 
									$("#email-error").html("");    
									g_email = 1;
							}
							else{
								$(".email").html("<img src='images/x.png' class='check'>Email<br>");
								$("#email-error").html("Sorry, that email is already taken."); 
								g_email = 0;									
							}
						});
					}   
				}
				      
			}   
			else if(div == "password"){
				var password = $("#password").val();
				if(password.length > 3){
					$(".password").html("<img src='images/check.png' class='check'>Password<br>");
					$("#password-error").html("");
					g_password = 1;       
				}                                                                                        
				else{
					$(".password").html("<img src='images/x.png' class='check'>Password<br>");
					$("#password-error").html("Sorry, your password must be longer than 3 characters.");
					g_password = 0;  
				}
				
			}   
			else if(div == "password2"){ 
				var password = $("#password").val(); 
				var password2 = $("#password2").val();
				if(password == password2){
					$(".password2").html("<img src='images/check.png' class='check'>Confirm password<br>");
					$("#password2-error").html("");  
					g_password2 = 1; 
				}
				else{
					$(".password2").html("<img src='images/x.png' class='check'>Confirm password<br>");
					$("#password2-error").html("Sorry, your password must be longer than 3 characters."); 
					g_password2 = 0; 
				}
				       
			}   
			else if(div == "name"){
				var name = $("#name").val();
				if(name.length > 1){
					$(".name").html("<img src='images/check.png' class='check'>Full name<br>");
					$("#name-error").html(""); 
					g_name= 1;  
				}  
				else{
				   	$(".name").html("<img src='images/x.png' class='check'>Full name<br>");
					$("#name-error").html("Please include your full name.");  
					g_name = 0; 
				}
				      
			}
		});
	}        