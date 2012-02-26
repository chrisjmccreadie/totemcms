
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
    	<h1>Knockout JS Example</h1>
    	<p>
    	This examples uses <a href='www.knocoutjs.com' targte='_blank'>knockout.js</a> to render the information.  A simple call is made to the 
    	server and the results are binded to the knockout objects below. This method is very useful if you know what is being returned and you are quite strict 
    	with you admin.
    	</p>
    	<p>
    	Go to the <a href='http://totemws.phpfogapp.com/index.php/cms/admin/'>Admin Area</a> and click on the Knock out to see this information change.
    	</p>
    	<div>
    		<strong><br/><br/>This is the first value:</strong><br/>
    		<span data-bind="html: test1">
    	</div>
        <div>
        	<strong><br/><br/>This is the second value:</strong><br/><br/>
    		<span data-bind="html: dum">
    	</div>
    	<div>
    	<strong><br/><br/>This is the third value:</strong><br/><br/>
    		<span data-bind="html: suber">
    	</div>
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
			
	var  localurl = 'http://localhost:8888/totemws/totemws.phpfogapp.com/index.php/cms/cms/page/?id=12';
	var devurl = 'http://totemws.phpfogapp.com/index.php/cms/cms/page/?id=12';
	
	alert('gsh');
	$.getJSON(devurl, function(json) { //get information about the user usejquery from twitter api
		alert(json);
  });
	
   
	
		
		function setView(obj)
		{
			//console.log(obj);
			var parsed = JSON.parse(obj);
			console.log(parsed);
			var viewModel = {
			test1: parsed[1].test1,
			dum: parsed[2].dum,
			suber: parsed[3].suber

    	}
		ko.applyBindings(viewModel);
		}

	</script>
    
</body>

</html>