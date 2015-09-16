<?php
include("config.php");

$code=$_GET['code'];
$q=mysql_query("select * from register where code='$code'") or die(mysql_error());
$p=mysql_num_rows($q);
if(isset($_POST['submit']))
{ 
$pass = $_POST['password'];
$password = md5($pass);
 //echo $p;
 if($p!=0) 
 {
  $res=mysql_fetch_array($q);
  
  $update=mysql_query("UPDATE register SET password='$password', code='' where code='$code'") or die(mysql_error());
  //print_r($res['email']);
  //print_r($res['password']);
  $success = "<p class='green'>Successfully created a new password</p>";
 
 }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New Password</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">
<img class="bg" src="images/bg.jpg" alt="" />
<div class="bg_img">
<div class="container">
<div class="register_main_class_new">
<div class="register_popup">
<div class="header_tag"><h2>New Password</h2></div>
<script>
			$(document).ready(function(){
			$('#newpassword').validate({
				rules : {
					 				 
					
					password : {
						required: true,
						minlength : 6,
						maxlength : 20,
					},
					confirm_password : {
						required: true,
						minlength : 6,
						equalTo : "#password"
					},
					
				},
				messages: {
									
					password: {
						required: "Password is required",
						minlength: "Password should be more than 6 characters",
						maxlength: "Password should not be more than 20 characters"
					},
					confirm_password : {
						required:"Confirm your password",
						equalTo:"Please match your password"
					},
				
				},
			});
			});
		</script>
<?php
if(empty($p)) {
	echo "<p class='red'>you'r code is expire.</p>";
}
echo $success;
?>
<form action="" method="POST" id="newpassword">
<div class="section_inner_">
<p class="tag_line_">You can change or reset the password for your Email
account by providing some information. </p>
<input type="password" name="password" placeholder="Password" id="password" class="focus">
<input type="password" name="confirm_password" placeholder="Confirm Password" id="confirm_password" class="focus">
<input type="submit" name="submit" value="confirm" class="button">

</div>
</form>
<div class="footer_tag"><a href="welcome.php">Cancel</a></div>
</div>

</div>



</div>

</div>
</div>

</body>
</html>
