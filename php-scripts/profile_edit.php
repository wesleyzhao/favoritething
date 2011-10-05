<?php
//all requires are handled by the required pages of doMethod($method) method

$method = $_GET['method'];
$_GET['text'] = strip_tags($_GET['text']);

echo doMethod($method);

function doMethod($method){
//uses the method variable to decide what to do with the information
	if ($method == 'addPost'){
		require_once('add_post.php');		//also requires the following $_GET variables: (int) written_by, (string) username, (0/1) is_private, and (string) text
	}
	else if ($method == 'addReply'){
		require_once('add_comment.php');		//also requires the following $_GET variables: (int) user_id, (int) post_id, and (string) text
	}
	else if ($method == 'addThumb'){
		require_once('add_thumbs_up.php');		//only additionally needs this $_GET variable: (int) post_id
	}
	else{
		print "error";
	}
}
?>