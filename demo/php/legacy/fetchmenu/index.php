Fetch a menu and store it in a variable<br/>
<?php
//set the site id.  
$siteid=10;
//nclude the main header file
include('../../../frontendtools/totemcms/totemcmsheader.php');
//get the menu data
$menu = getMenu($siteid);
echo 'Source:<br/>'.htmlentities($menu);
?>