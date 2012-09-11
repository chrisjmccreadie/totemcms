<?php
/*
*TOTEM CMS FRONT END FUNCTIONS
*
*This set of functions fetches the JSON data from totem CMS
*
*/
//example break dowm
// $data[0]->pagedata[0]->body;
//the first element of the data array contains all the data
//$data[0]->
//this is the pagedata array which contains all the key value pairs 
//->pagedata[0]->
//This is the actual name of the value pair
//>body;
//example to see all the data
//print_r($data[0]->pagedata[0]->Banner);
class MojagRest
{
	var $url = 'http://www.mojag.co/index.php/rest/rest/';
	
	//This function get the outname and checks for that
	function getContentObjectByOutputname($siteid,$counter=1)
	{
		//get the output name, it will return the last url part but you can override it.
		$url = $_SERVER["PATH_INFO"];
		$url2 = explode('/',$url);
		$url3 = $url2[count($url2)-$counter];
		//define the page to call here
		$url = $this->url."pageoutputname?id=$siteid&on=$url3";
		//get the contents
		$opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
		$context = stream_context_create($opts);
		$str = file_get_contents($url,false,$context);
		//decode the json
		$data = json_decode($str);
		//return the  data
		$data2 = $data[0]->pagedata;
		foreach($data2 as $index=>$val){    
		foreach($data2[$index] as $key => $value) {
			$datafin[] = array('key' => $key,'value' =>$value);
		}
	}
	
}

function showCookie($siteid)
{
	$url = "http://www.totemcms.co/index.php/cms/cookie/show/?siteid=$siteid";
 	//echo $url;
    $context = stream_context_create($opts);
	$str = file_get_contents($url,false,$context);
    //echo $str;
    $data = json_decode($str);
	//print_r($data);
	//exit;
	$data2 = $data[0];
	$dobj = (object) $data2;
	return($dobj);
	//echo "message:".$dobj->message;
	//print_r($dobj);
	//exit;
	//return($str);
}

//Start of cookie functions
function storeCookie($siteid,$name,$value)
{
	//$url = "http://www.totemcms.co/index.php/cms/cookie/store/?id=$siteid&name=$name&value=$value";
	$url = "http://www.totemcms.co/index.php/cms/cookie/store/?siteid=$siteid&name=$name";
	$opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
    $context = stream_context_create($opts);
	$str = file_get_contents($url,false,$context);
    $data = json_decode($str);
	return($str);
}



//end of cookie funcitons



function getName()
{
	//This functions gets the page name
	$pname = $_SERVER['SCRIPT_NAME'];
	$pname = explode('/',$pname);
	$pname = $pname[count($pname)-1];
	return($pname);
}



function getContentObjects($pageid)
{
	//This example shows how to get the data and statically put it into the website
	//
	//get the page.
	//define the page to call here
	$url = "http://www.totemcms.co//index.php/cms/cms/page/?id=$pageid";
	//get the contents
	$opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
	$context = stream_context_create($opts);
	$str = file_get_contents($url,false,$context);
	//decode the json
	$data = json_decode($str);
	//return the  data
	$data2 = $data[0]->pagedata;
	foreach($data2 as $index=>$val){    
		foreach($data2[$index] as $key => $value) {
			$datafin[] = array('key' => $key,'value' =>$value);
		}
}
	
	
	$dobj = (object) $datafin;
	
	return($dobj);
}

function getData($pageid)
{
	//This example shows how to get the data and statically put it into the website
	//
	//get the page.
	//define the page to call here
	$url = "http://www.totemcms.co//index.php/cms/cms/page/?id=$pageid";
	//get the contents
	$opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
	$context = stream_context_create($opts);
	$str = file_get_contents($url,false,$context);
	//decode the json
	$data = json_decode($str);
	//return the  data
	return($data);
}

function getMenu($menuid)
{
	//get the menu using the site id
	$url = "http://www.totemcms.co/index.php/cms/cms/menu/?id=$menuid";
	//$url = "http://localhost:8888/totemws/totemws.phpfogapp.com/index.php/cms/cms/page/?id=14";
	//get the contents
	$str = file_get_contents($url);
	$menu = json_decode($str);
	//check it is not a protected domain and if it is return false
	//TODO the above.
	$menuo ="<ul class=\"navigation\">";
	//get the name of the page (can update to use the getname function) and if its blank set it to index.php
	$sr = explode("/",$_SERVER['REQUEST_URI']);
	$name = $sr[count($sr)-1];
	//set blank to index.php (may want to change this to site default)
	if ($name == '')
	{
		$name = 'index.php';
	}
	//loop through and build the menu
	foreach ($menu as $item)
	{
		if ($name == $item->url)
		{
			$menuo = $menuo."<li><a href=\"$item->url\" target=\"_self\" class=\"sel\">$item->outputname</a></li>";
			
		}
		else	
		{
			$menuo = $menuo."<li><a href=\"$item->url\" target=\"_self\" id=\"\">$item->outputname</a></li>";
		}
	}
	$menuo = $menuo."</ul>";
	return($menuo);
}





function getKeyword($keyword,$menuid)
{
	//This function get the objects which match the keywords.
	$url = "http://www.totemcms.co/index.php/cms/cms/meta/?id=$menuid&keywords=$keyword";
	$str = file_get_contents($url);
	$data = json_decode($str);
	return($data);
}

?>
