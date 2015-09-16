<?php
require __DIR__ . "/config.php";

if(empty($_SESSION['user_details']))	header("location: login.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">
<img class="bg" src="images/bg.jpg" alt="" />
<div class="bg_img">
<div class="container">
<div class="header"><div class="logo"><span>Logohere</span></div>
<div class="logout"><span><a class="change" href="changepassword.php">Change Password</a><a href="login.php?logout=YES">Logout</a></span></div>
<P>Welcome to Narmans</P>
</div>

</div>
<div class="clear"></div>
<footer>
<ul>
<li>
<a href="addcomponent.php">Add Component</a>
</li>
<li>
<a href="addquality.php">Add Quality</a>
</li>

</ul>
</footer>
</div>
</div>

</body>
</html>
