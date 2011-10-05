<?php
?>
<script type="text/javascript"
	 src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"> 
	</script> 
    <script type="text/javascript"> 
    	function inputFocus(i){
		    if(i.value==i.defaultValue){ i.value=""; i.style.color="#000"; }
		}
		function inputBlur(i){
		    if(i.value==""){ i.value=i.defaultValue; i.style.color="#888"; }
		}  
		
		$(document).ready(function(){            
			$('.favorite-field').keyup(function(){
				chars = $('.favorite-field').val().length;
				chars = 255-chars;
				$('#chars-count').html(chars + " characters left.");
			});
		});
		
		function makeReply(div_class){       
			div_class = "." + div_class;
			$(div_class).append("<textarea id=\"a-reply\" rows=\"2\" cols=\"50\" class=\"comment\"></textarea><input style=\"margin-left: 10px;\" type=\"submit\" value=\"Reply\"/>");
		} 
	</script> 