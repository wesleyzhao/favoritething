<!DOCTYPE html>
<html lang="en">
<?php
	require_once("php-scripts/mysql_connect.php");		//mysqlConnect()
	require_once("php-scripts/get_usernames.php");		//getUsernames()
	$allURLS=getUsernames();		//will store all custom_urls, first populates with all usernames
	
 
 $request = $_SERVER['REQUEST_URI'];
 $exploded = explode('/',$request);	//element 0 should be tasteplug.com
 $customURL = $exploded[1];
 
	if (in_array($customURL,$allURLS)){
	//if the customURL typed exists in the database
	
		if (count($exploded)>2){
		//if the url exists, and there is call for something else (e.g. tasteplug.com/wesley/foo)
			if (count($exploded)==3){
				if (strlen($exploded[2])==0){
					//echo customPage();
					$_GET['page']=$customURL;
					include_once("page-templates/profile.php");
				}
				else {
					require_once("page-templates/not-found.php");
				}
			}
			else{
				require_once("page-templates/not-found.php");
			}
		}
		else{
		//if there is just one thing after / e.g. tasteplug.com/foo
			//echo customPage();
			$_GET['page']=$customURL;
			require_once("page-templates/profile.php");
		}
	}
	else if($customURL == 'login'){
		require_once('page-templates/login.php');
	}
	else if($customURL == 'login-user'){
		require_once('php-scripts/log_in_attempt.php');
	}   
	else if($customURL == 'login-error'){
		$message="Username and password do not match.";
		require_once('page-templates/login.php');
	}
	else if($customURL == "update-settings"){
		require_once('php-scripts/settings_edit.php');
	}                                     
	else if($customURL == "settings-error"){
		$message="Error updating your settings please check all fields.";
		require_once('page-templates/settings.php');
	}       
	else if($customURL == "settings-saved"){
		$message="Your settings have been updated.";
		require_once('page-templates/settings.php');
	}
	else if ($customURL=='dashboard'){
		require_once("page-templates/dashboard.php");
	}
	else if ($customURL=='profile'){
		$_GET['page']=='profile';
		require_once("page-templates/profile.php");
	}
	else if ($customURL=='settings'){
		require_once("page-templates/settings.php");
	}
	else if($customURL == 'register'){
		require_once("page-templates/register.php");
	}
	else if ($customURL == 'about'){
		require_once("page-templates/about.php");
	}
	else if($customURL == "logout"){
		require_once("page-templates/logout.php");
	}
	else if ($customURL == "find-friends"){
		require_once("page-templates/find_friends.php");
	}
	else if($customURL == "set-fb"){
		$sql = "UPDATE `users` SET `is_auto_fb` = '1' WHERE `id`=".$_SESSION['id'];
		mysql_query($sql);
	}                     
	else if($customURL == "unset-fb"){
		$sql = "UPDATE `users` SET `is_auto_fb` = '0' WHERE `id`=".$_SESSION['id'];
		mysql_query($sql);
	}
	else if($customURL == 'profile-test'){
		require_once("page-templates/profile-test.php");
	}
	else{
	//if url does not exist
		require_once("page-templates/not-found.php");
	}
		
//$customURL = 'wesley';
?>