<?php
/*
 * Mojag Class (PHP version)
 * Copyright : no one, use it and enjoy it.
 * author : Chris McCreadie
 * date added : 10/09/2012
 * date updated : 10/09/2012
 * 
 * This class handles all the calls to the Mojag REST API and very nice it is too.
 * 
 * This class is has been coded it be as simple as possible to make it as accessable as possible, please if it is to simplistic for your needs
 * create a super duper mutexed version with all the trimmings, we would love to invclude it,
 * 
 */
class mojagClass
{
	var $url='';
	var $useurl='http://www.mojag.co/index.php/rest/rest/';
	//var $useurl='http://localhost:8888/mojag/index.php/rest/rest/';
	
	
    function __construct() {
		$this->url[]='http://www.mojag.co/index.php/rest/rest/';
	 	$this->url[]= 'http://localhost:8888/mojag/index.php/rest/rest/';
		//$this->workingurl();
    }
	
	/*
	 * GENERIC FUNCTION
	 */
	function workingurl()
	{
		//TO DO.
		//print_r($this->url);
		//and check by echoing
		$opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
		$context = stream_context_create($opts);
		$str = file_get_contents($this->url,false,$context);	
		//print_r($str);
		//exit;
	}
	
	//this function fetches the page.
	function fetchPage($url)
	{
		//define the page to call here
		$url = $this->useurl.$url;
		//debug information
		//echo $url;
		//exit;
		//get the contents, this would be better in CURL but its not on 100% of all servers.
		$opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
		$context = stream_context_create($opts);
		$str = file_get_contents($url,false,$context);
		//echo "str".$str;
		//decode the json
		$data = json_decode($str);
		return($data);
		//print_r($data);
	}
	
	//this function will fetch and element from a object.
	function searchContent($search,$pagecontent,$default='')
	{
		//loop through the content
		foreach ($pagecontent as $data)
		{
			//force it to be a object, damn you PHP behave.
	    	$dobj = (object) $data;
			//check if this is the object you are looking for
			if (strtolower($dobj->key) == strtolower($search))
			{
				//return the value.
				return($dobj->value);
			}
		}
		//return the default
		return($default);
	}

	
	/*
	 * END OF GENERIC FUNCTIONS
	 */
	 
	 
	 function getMenu($siteid,$class='navigation',$active='',$target='_self')
	 {
		//get the menu using the site id
		//update
		
		$url = "menu/?id=$siteid";
		$menu = $this->fetchPage($url);
		//echo 'data'.print_r($data);
		//echo $data;
		//exit;
		//check it is not a protected domain and if it is return false
		//to do the above.
		$menuo ="<ul class=\"$class\">";
		
		
		if ($active == '')
		{
				//get the name of the page (can update to use the getname function) and if its blank set it to index.php
				$sr = explode("/",$_SERVER['REQUEST_URI']);
				$name = $sr[count($sr)-1];
				//set blank to index.php (may want to change this to site default)
				if ($name == '')
				{
					$name = 'index.php';
				}			
		}
		else {
			$name = $active;
		}

		//loop through and build the menu
		foreach ($menu as $item)
		{
			if ($name == $item->url)
			{
				$menuo = $menuo."<li><a href=\"$item->url\" target=\"$target\" class=\"sel\">$item->outputname</a></li>";
			
			}
			else	
			{
				$menuo = $menuo."<li><a href=\"$item->url\" target=\"$target\" id=\"\">$item->outputname</a></li>";
			}
		}
		$menuo = $menuo."</ul>";
		return($menuo);
	 }
	
	
	//This function get the outname and checks for that
	function getContentObjectByOutputname($siteid,$counter=1,$outputname='')
	{
		//get the output name, it will return the last url part but you can override it.
		if($outputname == '')
		{
			$url = $_SERVER["PATH_INFO"];
			$url2 = explode('/',$url);
			$url3 = $url2[count($url2)-$counter];
			
		}
		else
		{
			$url3 = $outputname;
		}
		
		$url = "pageoutputname?id=$siteid&on=$url3";
		$data = $this->fetchPage($url);
		
		//return the  data
		$data2 = $data[0]->pagedata;
		foreach($data2 as $index=>$val){    
		foreach($data2[$index] as $key => $value) {
			$datafin[] = array('key' => $key,'value' =>$value);
			}
		}
		return($datafin);
	}
}
	
?>
