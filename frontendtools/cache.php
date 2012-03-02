<?php
/*
 * Cache Class
 * Copyright : Totem Software 
 * Author : Chris McCreadie
 * 
 * Please do with this what you will.
 * 
 */
class totemcache   
{
	
	//vars
	var $cachedir = '/var/fog/apps/1101/totemcms.phpfogapp.com/frontendtools/cache/';
	var $cachetime = '24';
	
	/*
	 * Simple page fetching class, should upgrade this to use curl at some point.
	 */
	public function fetchPage($url,$name)
	{
		$str = file_get_contents($url);
		//now we have it we need to process it.
		$myFile = $this->cachedir.$name;
		echo $myFile;
		$fh = fopen($myFile, 'x+');
		fwrite($fh, $str);
		fclose($fh);
		//echo $str;
		
	}
	
	public function fetchSite($url)
	{
		$str = file_get_contents($url);
		$obj = json_decode($str);
		foreach ($obj as $value)
		{
			$go =  "http://www.totemcms.co/index.php/cms/cms/page/?id=".$value->id;
			$obj->meta;
			//$this->fetchPage($go, $row->meta);
		}
		//echo "ddd".$str;
	}
			
	/*
	 * Cache checking funciton (untested)
	 */
	public function checkCache()
	{
		
		$name = $_SERVER['REQUEST_URI'];
		echo $path;
		$ar = explode('/',$name);
		$name = $ar[count($ar)-1];
		//this can be more efficient
		$name = str_replace('.php','.tpl',$name);
		$name = str_replace('.html','.tpl',$name);
		$name = str_replace('.htm','.tpl',$name);
		if (file_exists($this->cachedir.$name)) {
			 //now check how old it is and if we need to recache
   			// echo "The file $this->cachedir$name exists";
   			//echo "$this->cachedir.$name";
   			readfile($this->cachedir.$name);
			
    		exit;
		} else {
			$this->startCache();
			return(false);
			//wite the cache
 		  // echo "The file $this->cachedir$name does not exist";
		}
	}
	
	/*
	 * Simple cache start using output buffering
	 */
	function startCache()
	{
		ob_start();
	}
	
	/*
	 * Cache end function
	 */
	public function endCache()
	{
		$out2 = ob_get_contents();
		ob_end_clean();
		echo $out2;
	}
	
	/*
	 * function to clear the cache.
	 */
	function clearCache()
	{
		
	}
	
}


