<?php
//assumes php-scripts/session_handler.php is loaded, loads isLogged() function
//assumes php-scripts/redirect_scripts.php is loaded, loads toHome() and toDashboard() functions

$page = $_GET['page'];		//GET 'page' variable
$id = isLogged();

if ($id && $page='index'){
//if the user is logged in and is trying to access the index page
	?>
	<script type='javascript/text'>
	toDashboard();
	</script>
	<?php
}
else if (!$id){
//if the user is not logged in, then redirect to Home page
	?>
	<script type='javascript/text'>
	toHome();
	</script>
	<?php
}
?>