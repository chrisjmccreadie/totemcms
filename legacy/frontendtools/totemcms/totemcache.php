<?php
//error_reporting(E_ALL);
//ini_set('display_errors','On');

class totemCache
{
	var $cachetime = 3600; // set the cache time to 1000
	var $siteid = '121';
	var $cachefile = "totemcms/cache/";
	var $pagename = '';
	

	public function forceCache()
	{
		/*
		*This function forces the page to be recached.  It is called by the server whenever a content chnage 
		*has been made, I may encrypt this and add oauth in the future.
		*/
		ob_start();
		return ('started');
	}

	public function cacheEnd()
	{
		/*
		 * this function write out the cache file
		 */
		//echo 'in c';
		$cachefile = $this->cachefile.$this->pagename;
		//echo $cachefile;
		unlink($cachefile);
		$fp = fopen($cachefile, 'w+'); 
		// save the contents of output buffer to the file
		$contentso = ob_get_contents();
		//echo $contentso;
		$contents = "<!-- Cachched using Totem CMS Cache engine, Word-->";
		$contents = $contents."\n<!--$cachefile was created at ". date ("F d Y H:i:s.", time())."-->".$contentso;
		//echo $contents;
		fwrite($fp, $contents); 
		// close the file
		fclose($fp); 
		// Send the output to the browser
		ob_end_flush();
		exit; 
	}


	public function smartCache()
	{
		/*
		 * This function checks if it can connect to the server and if it cannot it servers the file from the cache.
		 * It also checks if it shoudl recache based on the time it was last cached.
		 * 
		 * 4 : Cache Methods
		 * 
		 * 1 : Check live server
		 * 2 : Schedulded cache (useful from cron jobs)
		 * 3 : Dynamic cache : check for version changes
		 * 4 : Dynamic schedule
		 * 
		 */
		
		//cache method 1
		$res = $this->checkServerLive();
		if ($res == true)
		{
			//check if an hour has passed.
			$res = $this->checkCacheTime();
			if (($res == 'nofile') || ($res == 'cache'))
			{
				//we need to cache it
				ob_start(); 
				return('started');
			}
			if ($res == 'loadcache')
			{
				$this->loadCache();
			}
			//echo "res".$res;	
		}
	}
	
	public function loadCache()
	{
		$cachefile = $this->cachefile.$this->pagename;
		//echo $cachefile;
		if (!file_exists($cachefile))
		{
			//echo 'nope';
			$this->forceCache();
			return('started');
		}
		else
		{
	 		$time = microtime();
			$time = explode(' ', $time);
			$time = $time[1] + $time[0];
			$start = $time;
			$handle = fopen($cachefile, "r");
			$contents = fread($handle, filesize($cachefile));
			fclose($handle);
			echo $contents;
			$time = microtime();
			$time = explode(' ', $time);
			$time = $time[1] + $time[0];
			$finish = $time;
			$total_time = round(($finish - $start), 4);
			echo '<!--Page loaded in '.$total_time.' seconds.-->';
			exit;
		}
	}
	
	private function checkCacheTime()
	{
		$cachefile = $this->cachefile.$this->pagename;
		//echo $cachefile;
		if (file_exists($cachefile)) 
		{
			if (filemtime($cachefile) < time() - 3600)
			{
				unlink($cachefile);
				return('cache');
				
			}
			else {
			 //echo 'does not need to be cached';
			 return('loadcache');
			}
		}
		else {
			return('nofile');
		}
	}
	
	private function checkServerLive()
	{
		/*
		 * This function checks that the server is live.  This is an array of server to check which one is alive.
		 */
		$urls = array("url" => "http://www.totemcms.co/index.php/cms/cms/checkliveserver/","url" => "http://totemws.phpfogapp.com/index.php/cms/cms/checkliveserver/");
		foreach ($urls as $url)
		{
			//print_r($url);
			$opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
			$context = stream_context_create($opts);
			$str = file_get_contents($url,false,$context);
			if ($str == "true")
				return($str);
		}
		return('false');		
				//print_r($urls);
		
	}
}




?>
