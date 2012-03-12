<?php
//put this script on the cron to keep caching the content.
//call the cache class
include('../../frontendtools/cache.php');
///set it up
$cache = new totemcache;
//fetch the pages.  We can extend this to list the pages and fetch them all.
//$cache->fetchPage('http://totemws.phpfogapp.com/index.php/cms/cms/page/?id=12','index.json');
//echo 'Page is cached';
//fecth all the pages form a site
$cache->fetchSite('http://totemws.phpfogapp.com/index.php/cms/cms/pages/?id=5');
echo 'Site is cached';

?>