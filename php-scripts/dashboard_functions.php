<?php
//assume session_handler.php has been required and only a user with a valid $_SESSION[] is accessing
//assume mysql_connect.php has been required

/*		//inherited from session_handler.php
function getUsername(){
	$username = $_SESSION['username'];
	return $username;
}
*/
function checkOauth($fb_id){
//will only be called if user has fb_session established
	$cur_id = $_SESSION['oauth_id'];
	$id = getUserId();
	if ($cur_id == 0){
		$_SESSION['oauth_id'] = $fb_id;
		$access_token = getToken();
		mysql_query("UPDATE users SET oauth_id='$fb_id',access_token='$access_token' WHERE id='$id'");
	}
}

function getLastDay(){
	mysqlConnect();
	$id = getUserId();   
	//$res = mysql_query("SELECT * from posts where (TIMEDIFF(`timestamp`, now())<'24:00:00') AND (written_to='$id') AND (`is_deleted` = '0')");
	$res = mysql_query("SELECT * from posts where (timestamp>(NOW() - INTERVAL 24 HOUR)) AND (written_to='$id') AND (`is_deleted` = '0')");
	$num = mysql_num_rows($res);
		if (!$num) $num =0;
	$num = strval($num);
	$html = "$num responses in the last 24 hours";
	return $html;
	
}
function getPicture(){
//gets the picture of the user
//returns the facebook picture if possible
//otherwise returns a blank picture
	$oauth_id = $_SESSION['oauth_id'];
	if ($oauth_id ==0){
		$picHtml = '<div class="photo"><img src="images/default.png"><br><fb:login-button perms="offline_access,publish_stream">Connect</fb:login-button> to add your photo through Facebook</div>';
	}
	else{
		$username = getUsername();
		$picHtml = "<div class='photo'><img src = 'http://graph.facebook.com/$oauth_id/picture?type=large' alt = 'Picture of $username' /><br></div>";
	}
	return $picHtml;
}

/* inherited from session_handler.php, also inherited getFullName()
function getId(){
	
}
*/

function getTweet(){
//add url with 
	$username = getUsername();
	$html = "<script src='http://platform.twitter.com/widgets.js' type='text/javascript'></script>
<a href='http://twitter.com/share' class='twitter-share-button' data-url='http://favoritething.me/$username' data-count='none' data-text='Let me know what your favorite thing is about me! #favoritething'>Tweet</a>";
	return $html;
}

function getFbShare(){
	$username = getUsername();
	$url = urlencode("http://FavoriteThing.me/$username");
	$text = urlencode("What's your favorite thing about me?");
	$html = "<a name='fb_share' type='button' share_url='http://favoritething.me/wesleyzhao' href='http://www.facebook.com/sharer.php'>Share</a><script src='http://static.ak.fbcdn.net/connect.php/js/FB.Share' type='text/javascript'></script>";
	$html = "<script>function fbs_click() {u='http://favoritething.me/$username';t='What is your favorite thing about me? | FavoriteThing.Me';window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}</script><style> html .fb_share_link { padding:2px 0 0 20px; height:16px; background:url(http://static.ak.facebook.com/images/share/facebook_share_icon.gif?6:26981) no-repeat top left; }</style><a rel='nofollow' title='What is your favorite thing about $username' href='http://www.facebook.com/share.php?u=<;url>' onclick='return fbs_click()' class='fb_share_link' target='_blank'>Share</a>";
	return $html;
}
function getPosts(){
//returns all the traits of the person, styled and in html
	mysqlConnect();
	$id = getUserId();
	$res = mysql_query("SELECT written_by,text,id,thumbs_up_count,is_private FROM posts WHERE written_to='$id' AND is_deleted='0'");
	if (mysql_num_rows($res)){
		$posts = array();
		while ($row = mysql_fetch_array($res)){
			$written_by = getUname(intval($row['written_by']));
			$posts[$row['id']] = array('written_by'=>$written_by, 'text'=>$row['text'],'thumbs_up_count'=>intval($row['thumbs_up_count']),'is_private'=>intval($row['is_private']));
		}
		ksort($posts);
		$html = makePosts($posts);
	}
	else{
		$html = 'No traits have been listed yet :(. Share this to get some!';
	}
	return $html;
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
	if ($username !='Someone') $username = "<a href='http://favoritething.me/$username' alt='Tell $username your favorite thing about them!'>$username</a>";
	$commentEnd = '</div>';
	$count = "<div id='thumbs'><span id='thumbs-count-$post_id'>$thumbs_up_count</span> thumbs up <span id='the-thumb-$post_id'></span>";
	$reply = '<a href="javascript:delPost('."'$post_id'".')" class="reply"><img class = "delete-button" src="images/delete.gif" /></a></div>';
	$post = "<div id='title'>$username said:</div> <b>$text</b>";
	$html = $count.$reply.$post.$commentStart.getComments($post_id).$commentEnd;
	return $html;
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
			$html = $html.makeComment($values['user_id'],$values['text'],$id);
		}
	}
	else{
	}
	return $html;
}

function makeComment($user_id,$text,$id){
//takes the int user_id and text text of the comment
//returns the styled html of the comment
		$html = '';
		$start = '<div id="a-reply">';
		$end = '</div>';
		$text = "<b>$text</b>";
		$userStart = '<div id="title">';
		$userEnd = ' replied:';
		$commentDelete = '<a href="javascript:delReply('."'$id'".')" class="reply"><img class = "delete-reply-button" src="images/delete.gif" /></a></div>';
		if ($user_id == 0){
			$username = 'Someone';
		}
		else{
			$username = getUname($user_id);
			$username = "<a href='$username' alt='$username - tell them your favorite thing about them'>$username</a>";
		}
		$html = $start.$userStart.$username.$userEnd.$commentDelete.$text.$end;
		return $html;
}

function getUrl(){
//returns the string text url of the user so that it can be copied and shared
	$username = $_SESSION['username'];
	$url = "http://www.FavoriteThing.Me/$username";
	return $url;
}

function getUname($id=-1){
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
?>