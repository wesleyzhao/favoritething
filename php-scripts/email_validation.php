<?php

function isValidEmail($email){
//uses regular expressions to check if email is in valid format
//returns true if email is valid format, returns false if not
	if (!eregi("^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$", $email)){
		return false;
	}
	else{
		return true;
	}
}
?>