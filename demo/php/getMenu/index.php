<?php
//include the header Mojag Class
include ('../../../mojagclass/mojagClass.php');
//load the class
if (class_exists('mojagClass')) {
	$mojag = new mojagClass();
}
else
{
	echo 'class does not exist';
}
//set your site id
$siteid = 16;
//url to match for active (can leave blank if you are using safe urls)
$match = "home.php";
//target set what you want the link to do (can be left blank and defaults to self)
$target = "_blank";
//fetch the content
$menu = $mojag->getMenu($siteid,'',$match,$target);
//debug
//print_r($menu);
?>
<!DOCTYPE HTML>
<html>
<body>
<?php
	//this is the menu
echo $menu;
?>
</body>
</html>