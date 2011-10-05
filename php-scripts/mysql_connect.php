<?php
//to be included/required so that a function 'mysqlConnect()' provides a connection to the database
function mysqlConnect(){
	//connects to the local MySQL favoritething database
	$con = mysql_connect('mysql.favoritething.me','username','pass');
	mysql_select_db('db_name',$con);
}

session_start();		//starts session, add/edit variables with $_SESSION['var_name']
?>