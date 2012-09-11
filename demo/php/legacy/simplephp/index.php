<?php
//This example shows how to get the data and statically put it into the website
//
//get the page.
//define the page to call here
$url = "http://www.totemcms.co//index.php/cms/cms/page/?id=14";
//$url = "http://localhost:8888/totemws/totemws.phpfogapp.com/index.php/cms/cms/page/?id=14";
//get the contents
$str = file_get_contents($url);
$data = json_decode($str);

//get the menu using the site id
$url = "http://www.totemcms.co/index.php/cms/cms/menu/?id=9";
//$url = "http://localhost:8888/totemws/totemws.phpfogapp.com/index.php/cms/cms/page/?id=14";
//get the contents
$str = file_get_contents($url);
$menu = json_decode($str);
$menuo ="<ul class=\"navigation\">";
$sr = explode("/",$_SERVER['REQUEST_URI']);
$name = $sr[count($sr)-1];
foreach ($menu as $item)
{
	//echo $name." : ".$item->url;
		if ($name == $item->url)
			$menuo = $menuo."<li><a href=\"$item->url\" target=\"_self\" id=\"selected\">$item->name</a></li>";
		else	
			$menuo = $menuo."<li><a href=\"$item->url\" target=\"_self\" id=\"\">$item->name</a></li>";
	
}
$menuo = $menuo."</ul>";

//print_r($menu);


//example break dowm
// $data[0]->pagedata[0]->body;
//the first element of the data array contains all the data
//$data[0]->
//this is the pagedata array which contains all the key value pairs 
//->pagedata[0]->
//This is the actual name of the value pair
//>body;
//example to see all the data
//print_r($data->pagedata[0])

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Out Sanctum ::</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<!---background container starts-->
<div id="homeBackgroundImg" class="backgroundImg">
  <!---main container starts-->
  <div class="mainContainer">
    <!---logo container starts-->
    <div class="logo"><img src="images/logo.png" alt="Out Sanctum" title="Out Sanctum" /></div>
    <!---logo container starts-->
    <!---main right container starts-->
    <div class="mainRightContainer">
      <!---menu container starts-->
      <div class="navigationContainer">
     <?php
     	echo $menuo;
     ?>
      </div>
      <!---menu container ends-->
      <!---quickcontact container starts-->
      <div class="quickContact"> <span>T: 020 7407 1407</span><span>E:<a href="mailto:hello@outersanctum.net">hello@outersanctum.net</a></span> </div>
      <!---quickcontact container ends-->
    </div>
    <!---main right container ends-->
  </div>
  <!---main container ends-->
  <!---content container No Bg starts-->
  <div class="contentContainerNoBg">
    <!---content container starts-->
    <div class="contentContainer">
      <!---column1 container starts-->
     
      <div class="column1">
      	 <h1>
      <?php echo $data[0]->pagedata[0]->header; ?>
      </h1>
        <div class="headingIntro"><?php echo $data[0]->pagedata[1]->strapline; ?></div>
      </div>
      <!---column1 container ends-->
    </div>
    <!---content container ends-->
  </div>
  <!---content container No Bg ends-->
  <!---content container No Bg starts-->
  <div class="contentContainerBg">
    <!---content container starts-->
    <div class="contentContainer">
      <!---column1 container starts-->
      <div class="column1">
       <?php echo $data[0]->pagedata[2]->body; ?>  <div class="moreButton"> <img src="images/button.png" alt="Find out more about os" title="Find out more about os" /></span> <a href="about-os.html" target="_self">Find out more about os</a></div>
      </div>
      <!---column1 container ends-->
    </div>
    <!---content container ends-->
  </div>
  <!---content container No Bg ends-->
  <!---right container starts-->
  <div class="rightContainer">
    <div class="rightContainerInner">
      <div class="columnRightContainer">
        <!--Art work 1 starts-->
        <div class="artWorkContainer">
          <div class="newStoryImg"> <img src="images/news-story1.jpg" alt="OS creates unique VIP" title="OS creates unique VIP" />
            <div> OS creates unique VIP experience at Sainsbury's Super Sunday </div>
          </div>
          <div class="artWorkImg"> <img src="images/sainsburys.jpg" alt="sainsburys" title="sainsburys" />
            <div>Sainsbury's</div>
          </div>
        </div>
        <!--Art work 1 ends-->
        <!--Art work 2 starts-->
        <div class="artWorkContainer">
          <div class="newStoryImg"> <img src="images/news-story2.jpg" alt="Founding Director Jamie Wood" title="Founding Director Jamie Wood" />
            <div> Founding Director Jamie Wood on the secrets to a successful event </div>
          </div>
          <div class="artWorkImg"> <img src="images/deutsche-bank.jpg" alt="deutsche bank" title="deutsche bank" />
            <div>Deutsche Bank</div>
          </div>
        </div>
        <!--Art work 2 ends-->
        <!--Art work 3 starts-->
        <div class="artWorkContainerRight">
          <div class="newStoryImg"> <img src="images/news-story3.jpg" alt="OS creates unique VIP" title="OS creates unique VIP" />
            <div> Top 5 tips to finding the right brand partnership<br />
              <br />
            </div>
          </div>
          <div class="artWorkImg"> <img src="images/siemens.jpg" alt="siemens" title="siemens" />
            <div>Siemens</div>
          </div>
        </div>
        <!--Art work 3 ends-->
      </div>
    </div>
  </div>
  <!---right container ends-->
  <!--footer starts-->
  <div class="footerContainer">
    <div class="contentContainer">
      <div class="footerMenu"><a href="index.html">HOME</a> <span class="pipe">|</span> <a href="contact-os.html">CONTACT OS</a></div>
      <div class="copyRight">&copy; Outer Sanctum 2011</div>
    </div>
  </div>
  <!--footer ends-->
</div>
<!---background container ends-->
<div class="lineBgBox">
  <div class="linesBg">&nbsp;</div>
</div>



</body>
</html>
