	<link rel="shortcut icon" 
      href="/favicon.ico">
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <link rel="stylesheet" href="style/style.css"> 
  <script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>
 <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-12978591-6']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
<script type="text/javascript">
var _sf_async_config={uid:19911,domain:"favoritething.me"};
(function(){
  function loadChartbeat() {
    window._sf_endpt=(new Date()).getTime();
    var e = document.createElement('script');
    e.setAttribute('language', 'javascript');
    e.setAttribute('type', 'text/javascript');
    e.setAttribute('src',
       (("https:" == document.location.protocol) ? "https://a248.e.akamai.net/chartbeat.download.akamai.com/102508/" : "http://static.chartbeat.com/") +
       "js/chartbeat.js");
    document.body.appendChild(e);
  }
  var oldonload = window.onload;
  window.onload = (typeof window.onload != 'function') ?
     loadChartbeat : function() { oldonload(); loadChartbeat(); };
})();

</script>                   
<div class="top">                    
	<div class="title-bar">
		 <div class="title-links">
			  
			
			<?php
			if($_SESSION['username']){
				$username = $_SESSION['username'];
			?>  
				<a class="title-links" href="/logout">logout</a>
				<a class="title-links" href="/settings">settings</a>
				<a class="title-links" href="/find-friends">find friends</a>
				<a class="title-links" href="/<?php print $username;?>">profile</a>
			<?php }   
			else{
			?>
				<a class="title-links" href="/register">signup</a>
				<a class="title-links" href="/login">login</a>   
				<a class="title-links" href="/">home</a>	
			<?php   
			}
			
			?>                                      
		 </div>
		<div class="logo"><a href="/"><img src="images/logo.png"></a></div>
	</div>	       
</div>            