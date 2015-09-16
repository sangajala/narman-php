<?php
require __DIR__ . "/config.php";


if(empty($_SESSION['user_details']))	header("location: login.php");
$data=$_SESSION['user_details']['id'];
$sql = mysql_query("SELECT `password` FROM `register` WHERE `id`='$data'");
$result = mysql_fetch_array($sql);
$p=$result['password'];
if(isset($_POST['submit']))
{ 



$pass = $_POST['password'];
$password = md5($pass);
$newpassword = $_POST['new_password'];
$newpass = md5($newpassword);
if($password == $p)
{
	$update=mysql_query("UPDATE register SET password='$newpass' where id='$data'") or die(mysql_error());
	$success = "<div class='green'>Successfully changed the password</div>";
}
else
{
	$error = "<div class='red'>Password not matched</div>";
}
 
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Password</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">
<img class="bg" src="images/bg.jpg" alt="" />
<div class="bg_img">
<div class="container">
<div class="header"><div class="logo"><span>Logohere</span></div>
<div class="logout"><span><a class="change" href="changepassword.php">Change Password</a><a href="login.php?logout=YES">Logout</a></span></div>
</div>
<div class="register_main_class_new">
<div class="register_popup">
<div class="header_tag"><h2>Change Password</h2></div>
<script>
			$(document).ready(function(){
				jQuery.validator.addMethod("onedigit", function(value, element) {
				  return this.optional(element) || /^.*(?=.*\d)(?=.*[A-Z])(?=.*[a-z]).*$/.test(value);
				}, "Password should contain atleast 1 capital letter and 1 number");
			$('#newpassword').validate({
				rules : {
					 				 
					
					password : {
						required: true,
						minlength : 6,
						maxlength : 20,
						onedigit: true,
					},
					new_password : {
						required: true,
						minlength : 6,
						maxlength : 20,
						onedigit: true,
					},
					
				},
				messages: {
									
					password: {
						required: "Old Password is required",
						minlength: "Password should be more than 6 characters",
						maxlength: "Password should not be more than 20 characters",
						onedigit: "Password should contain atleast 1 uppercase letter, 1 lowecase letter and 1 number"
					},
					new_password : {
						required:"New Password is required",
						minlength: "Password should be more than 6 characters",
						maxlength: "Password should not be more than 20 characters",
						onedigit: "Password should contain atleast 1 uppercase letter, 1 lowecase letter and 1 number"
					},
				
				},
			});
			});
		</script>
<?php
echo $success;
echo $error;
?>
<form action="" method="POST" id="newpassword">
<div class="section_inner_">
<p class="tag_line_">You can change or reset the password for your Email
account by providing some information. </p>
<input type="password" name="password" placeholder="Old Password" id="password" class="focus">
<input type="password" name="new_password" placeholder="New Password" id="new_password" class="focus">
<input type="submit" name="submit" value="confirm" class="button">

</div>
</form>
<div class="footer_tag"><a href="welcome.php">Cancel</a></div>
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
</div>

</body>
</html>
