<p>
This demo shows you how to use the fetch content as obeject funciton then uses a funky find option to search the object.<br/>
Totem CMS will be able to render you a page like this and if you add a template it will build your page for you, how cool is that		
</p><br/>
<?php
//set the site id.  
$siteid=10;
//set the page ID
$pageid=15;
//nclude the main header file
include('../../../frontendtools/totemcms/totemcmsheader.php');
//get the page content
$pagecontent = getContentObjects($pageid);
//search content funtion, I may move this into the front end class.
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
?>
<!DOCTYPE html>
<html>
<body>

<h1>
<?php  
	//search for the title and output it, you specify a default incase it is not found
	echo searchContent('title',$pagecontent,'This is the title'); 
?>
</h1>

<p>
<?php
	//search for the title and output it, you specify a default incase it is not found
	echo searchContent('strapline',$pagecontent);
?> 
</p>
</body>
</html>


