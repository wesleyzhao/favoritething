<?php
	//$table = 'people';
	require_once("../php-scripts/mysql_connect.php");		//mysqlConnect()
	
	$names = array();
	$urls =array();
	$results = array();
	$ids = array();
	
	mysqlConnect();
	$search = $_GET['keywords'];		//gets search keywords from GET variable 'keywords'
	
	$result = mysql_query("SELECT full_name,username,oauth_id FROM Users WHERE full_name LIKE '%$search%' OR username LIKE '%search%'");
	if (mysql_num_rows($result)){
		while ($row = mysql_fetch_array($result)){
			$name = $row['full_name'];
			$url = $row['username'];
			$names[]= $name;
			$urls[$name] = $url;
			$ids[$name]=$row['oauth_id'];
		}
	}
	
	if (strlen($search)>0){
		$matches = $names;
		if (count($matches)>0){
			echo getResults($matches);
		}
		else{
			echo 'no results found';
		}
	}
	else{
		echo '';
	}
	
	function getResults($nameArr){
		$html = '';
		$start = '<div class = "result-containter">';
		$end = '</div>';
		
		foreach ($nameArr as $name){
			$html = $html.getResult($name);
		}
		
		return $start.$html.$end;
	}
	
	function getResult($name){
		global $urls,$ids;
		$url = $urls[$name];
		$id = $ids[$name];
		
		//$pic = getPicture($id,'square');
		$pic = getPicture($id,'large');
		
		$html = '';
		$start = "<div class = one-result>";
		$end = "</div>";
		$html = "<a href='/$url'><img class = 'result-image' src='$pic'/></a><div class='result-name'>".$name."</div><div class='result-username'>(<a href='/$url'>$url</a>)</div>";
		return $start.$html.$end;
		
	}
	
	function getPicture($id,$size='normal'){
		return "http://graph.facebook.com/$id/picture?type=$size";
	}
?>