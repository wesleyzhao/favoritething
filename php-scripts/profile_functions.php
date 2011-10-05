<?php
//assumes mysqlConnect() is available from mysql_connect.php
//assumes session_handler.php is available giving access to if session is established or not
$page = $_GET['page'];
if ($page == 'profile'){
	require_once("redirect_scripts.php");
	$page = $_SESSION['username'];
	if (!$page){
?>
	<script type='javascript/text'>toHome();</script>
<?php
	}
	print "SESSION ".$page;
}

function getFavorites($pg='',$all = false){
	global $page;
	if ($pg != '') $page = $pg;
	mysqlConnect();
	$res = mysql_query("SELECT is_private FROM users WHERE username='$page'");
	$row = mysql_fetch_array($res);
	$is_private = intval($row['is_private']);
	if ($is_private == 0){
	
	$owner_id = getId($page);
	$posts = array();
	if ($all){
	//get all results
		$res = mysql_query("SELECT written_by,text,id,thumbs_up_count,is_private FROM posts WHERE written_to='$owner_id'");
	}
	else{
	//get all results where the text is not private
		$res = mysql_query("SELECT written_by,text,thumbs_up_count,id FROM posts WHERE written_to='$owner_id' AND is_private='0' AND is_deleted='0'");
	}
	if (mysql_num_rows($res)){
		while ($row = mysql_fetch_array($res)){
			$post_id = intval($row['id']);
			//$written_by = getUsername(intval($row['written_by']));
			$written_by = getUsername(intval($row['written_by']));
			$text = $row['text'];
			$thumbs_up_count = intval($row['thumbs_up_count']);
			$posts[$post_id] = array('written_by'=>$written_by, 'text'=>$text,'thumbs_up_count'=>$thumbs_up_count);
		}
		ksort($posts);		//sorts array by post_id while maintaining data associations
	}
	
	return makePosts($posts);
	}		//end if statement of if profile is not private
	else{
		//if the profile's page is private
		return 'Favorite things are private here';
	}
	
}

function makePosts($array){
	//takes in an array with integer key that is post_id
	//array values include an array with keys 'written_by' that includes text username
	//also includes key 'text' which has value of text of the favorite
	//and includes an int thumbs_up_count
	//returns the html of all posts, given the array
	$endDiv =  '</div><br>';
	$html = '';
	if (count($array)>0){
		foreach ($array as $post_id=>$values){
			$startDiv = "<div id ='a-favorite' class='$post_id'>";
			//$endDiv =  '';
			$html = $startDiv.makePost($values['written_by'],$values['text'],$values['thumbs_up_count'],$post_id).$endDiv.$html;
		}
		
	}
	else{
		$html = 'Be the first to give some love!';
	}
	return $html;
}

function makePost($username,$text,$thumbs_up_count,$post_id){
//params $username is a text version of the username, and $text is text, and int $post_id
//returns the individual post with divs and all (now including comments)
//calls getComments to attactch comments
	$html = '';
	$commentStart = "<div id='reply-container-$post_id'>";
	$commentEnd = '</div>';
	if ($username !='Someone') $username = "<a href='http://favoritething.me/$username' alt='Tell $username your favorite thing about them!'>$username</a>";
	$count = "<div id='thumbs'><span id='thumbs-count-$post_id'>$thumbs_up_count</span> thumbs up <span id='the-thumb-$post_id'><a href='javascript:addThumb($post_id)'><img src='images/thumbs.gif'></a></span>";
	$reply = '<a href="javascript:makeReply('."'$post_id'".')" class="reply">reply</a></div>';
	$post = "<div id='title'>$username said:</div> <b>$text</b>";
	$html = $count.$reply.$post.$commentStart.getComments($post_id).$commentEnd;
	return $html;
}

function getId($username){
//returns the int value of the id number of the username given
	//global $page;
	mysqlConnect();
	$res = mysql_query("SELECT id FROM users WHERE username='$username'");
	$row = mysql_fetch_array($res);
	$id = $row['id'];
	return intval($id);
	
}
function getUsername($id=-1){
//takes the id param and returns the appropriate username
//returns a string representation of the username
//returns the $page if it is default, returns anonymous if 0, and returns the username if possible
	global $page;
	mysqlConnect();
	if ($id == -1){
		return $page;
	}
	else if ($id == 0){
		return 'Someone';
	}
	else{
		$res = mysql_query("SELECT username FROM users WHERE id='$id'");
		if (mysql_num_rows($res)){
			$row = mysql_fetch_array($res);
			$username = $row['username'];
			return $username;
		}
		else{
			return 'unknown';
		}
	}
}

function getAnonymous(){
	//returm the name of the currently logged in user or if the user is not logged in 
	//returns a link to login 
   
	
	if($_SESSION['username']){
		return "send as <input type='radio' name='anonymous' class='user' checked='checked'> <b>".$_SESSION['username']."</b> or <input type='radio' name='anonymous' class='anonymous'> anonymous";  
	}                              
	else{
		return "Posting anonymously because you are not logged in. Login <a href='/login'>here</a>.";
	}
}

function getName(){
//returns the full_name of the persons' page
	global $page;
	mysqlConnect();
	$res =mysql_query("SELECT full_name FROM users WHERE username='$page'");
	$row =  mysql_fetch_array($res);
	return $row['full_name'];
}

function getAddForm(){
//creates the addForm for each page
	$id = isLogged();
	if ($id){
		$html = "$id";
	}
	else{
		$html = "0";
	}
}

function getComments($post_id){
//get all comments for a certain post given a post_id param
	//$startDiv = '';		//placed in the makePost function instead
	//$endDiv = '';			//ditto ^^
	$html = '';
	mysqlConnect();
	
	$res = mysql_query("SELECT user_id,id,text FROM replies WHERE post_id='$post_id' AND is_deleted='0'");
	if (mysql_num_rows($res)){
		$replies = array();
		while ($row = mysql_fetch_array($res)){
			$replies[$row['id']] = array('user_id' => $row['user_id'], 'text'=>$row['text']);
		}
		ksort($replies);
		foreach ($replies as $id => $values){
			$html = $html.makeComment($values['user_id'],$values['text']);
		}
	}
	else{
	}
	return $html;
}

function makeComment($user_id,$text){
//takes the int user_id and text text of the comment
//returns the styled html of the comment
		$html = '';
		$start = '<div id="a-reply">';
		$end = '</div>';
		$text = "<b>$text</b>";
		$userStart = '<div id="title">';
		$userEnd = ' replied:</div>';
		if ($user_id == 0){
			$username = 'Someone';
		}
		else{
			$username = getUsername($user_id);
			$username = "<a href='$username' alt='$username - tell them your favorite thing about them'>$username</a>";
		}
		$html = $start.$userStart.$username.$userEnd.$text.$end;
		return $html;
}

function getPicture(){
//gets the picture of the current profile user, if the oauth_id token exists
	global $page;
	mysqlConnect();
	$res = mysql_query("SELECT oauth_id FROM users WHERE username='$page'");
	$row = mysql_fetch_array($res);
	$oauth_id = intval($row['oauth_id']);
	if($row['oauth_id'] == "amy"){
		$picHtml = "<img src='images/amy.png'/>";
	}
	else if ($oauth_id == 0){
		$picHtml = "<img src = 'images/default.png'/>";
	}
	else{
		$picHtml = "<img class='picture' src = 'http://graph.facebook.com/$oauth_id/picture?type=large' alt = 'Picture of $page' />";
	}
	return $picHtml;
}

?>