<?php
require __DIR__ . "/config.php";
if(empty($_SESSION['user_details']))	header("location: login.php");
if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	$option1=$_POST['option'];
	$option=implode(",",$option1);
	$sql=mysql_query("INSERT INTO component (`name`,`option`) values ('$name', '$option')") or die($sql . mysql_error());
	$success= "<div class='green'>Component added successfully</div>";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Component</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">
<img alt="" src="images/bg.jpg" class="bg">
<div class="bg_img">
<div class="container">
<div class="register_main_class">
<div class="register_popup">
<div class="header_tag"><h2>New Component</h2></div>
		<?php 
			echo $e_message;
			echo $success;
		?>
<form action="" method="post" name='component' id="component">
<div class="section_inner_">
<input type="text" name="name" value="">
<div class="drop_b">
<select name="option[]" multiple="multiple">
<option value="Silk">Silk</option>
<option value="Whool">Whool</option>
<option value="Jeans">Jeans</option>
<option value="Cotton">Cotton</option>
</select>
</div>
<div class="clear"></div>
<div class="six">
<input class="button" type="reset" name="reset" value="Cancel" />
</div>
<div class="six">
<input class="button" type="submit" name="submit" value="Add" />
</div>
<div class="clear"></div>
</div>
</form>
<div class="footer_tag"><a href="login.php">Cancel</a></div>
</div>

</div>



</div>

</div>
</div>

</body>
</html>