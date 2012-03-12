<?php
$base_url = '';
?>
<!DOCTYPE html>
<html lang="en">
<!-- This is a demonstration of HTML5 goodness with healthy does of CSS3 mixed in -->
<head>
    <title>TOTEM CMS</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />		
    <!--[if IE]>
    	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if IE 7]>
    	<link rel="stylesheet" href="ie7.css" type="text/css" media="screen" />
    <![endif]-->
    <link rel="stylesheet" href="/static/css/style.css" type="text/css" media="screen" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js" type="text/javascript"></script>
    <script type='text/javascript' src='../../static/js/knockout2.js'></script>
</head>
<body>
    <header> <!-- HTML5 header tag -->
    	<div id="headercontainer">
    	<div>
    	<span data-bind="text: idy"></span>
    	</div>
    	<span data-bind="text: name"></span>
    	<span data-bind="html: description"></span>
        <span data-bind="text: ga"></span>
        <span data-bind="text: dateadded"></span>
    	</div>
    </header>
    <section id="contentcontainer"> <!-- HTML5 section tag for the content 'section' -->
    	<section id="intro">
    
    	</section>
    	<footer> <!-- HTML5 footer tag -->
    	
		</footer>	
    </section>
    
    <script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<script type="text/javascript">
		try {
		var pageTracker = _gat._getTracker("UA-9207090-1");
		pageTracker._trackPageview();
		} catch(err) {}
	</script>
	
	<script ype='text/javascript'>	
		
	var  localurl = 'http://localhost:8888/totemws/totemws.phpfogapp.com/index.php/cms/cms/site/?id=5';
	var devurl = 'http://totemws.phpfogapp.com/index.php/cms/cms/site/?id=5';
	
		
		jQuery.getJSON(devurl+"&callback=?", function(data) {
        console.log(data);
        setView(data);
});
		
		function setView(obj)
		{
		//	var parsed = JSON.parse(obj);
			//console.log(parsed);

			var viewModel = {
			idy: obj[0].id, 
			name: obj[0].name, 
			description: obj[0].desc, 
			ga: obj[0].gaid, 
			dateadded: obj[0].dateadded 

			
    	}
		ko.applyBindings(viewModel);
		}

	</script>
    
</body>

</html>