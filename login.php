<?php
require __DIR__ . "/config.php";

if(isset($logout) && $logout=="YES") {

	session_destroy();

	header("location: " . SELF);

}

if(isset($_SESSION['user_details']))	header("location: welcome.php");

if(METHOD=="POST") {
	// email and password sent from Form
	$name	= mysql_real_escape_string($username); 

	$password	= mysql_real_escape_string(md5($password)); 

	$sql	= "SELECT id FROM register WHERE name='$name' && password='$password' && status='1'";

	$result	= mysql_query($sql);
	if(mysql_num_rows($result)>0) {
					
		$details	= mysql_fetch_assoc($result);
		

		$_SESSION['user_details']	= $details;

		header("location: welcome.php");
		

	} else {

		$error	= "Oops looks username and password combination is not found.";

	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Untitled Document</title>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
		<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
		<link href="css/style.css" rel="stylesheet" type="text/css" />
	</head>

	<body>
		<div id="wrapper">
			<img alt="" src="images/bg.jpg" class="bg">
			<div class="bg_img">
				<div class="container">
					<div class="header"><div class="logo"><span>Logohere</span></div></div>
					<script>
			$(document).ready(function(){
				jQuery.validator.addMethod("onedigit", function(value, element) {
				  return this.optional(element) || /^.*(?=.*\d)(?=.*[A-Z]).*$/.test(value);
				}, "Password should contain atleast 1 capital letter and 1 number");
				
				
			$('#log').validate({
				rules : {
					 username: {
						required: true,
						minlength : 6,
						maxlength : 20,
					},
					
					password : {
						required: true,
						minlength : 6,
						maxlength : 20,
						onedigit : true
					},
										
				},
				messages: {
					username: {
						required: "Please enter valid Username",
						minlength: "Username should be more than 6 characters",
						maxlength: "Username should not be more than 20 characters"
					},
										
					password: {
						required: "Please enter valid Password",
						minlength: "Password should be more than 6 characters",
						maxlength: "Password should not be more than 20 characters",
						onedigit : "Password should have atleast 1 capital and 1 number"
					},
									
				},
			});
			});
		</script>
					<div class="login_box">
						<h2>Sign in to Narmans</h2>
						<div class="login_class_main">

							<div class="login_main_">
								<form method="post" id="log">
									<?php if(isset($error))	echo "<lable class='red'>$error</lable>"; ?>
									<input type="text" name="username" id="username" placeholder="Username" class="focus" />
									<input type="password" id="password" name="password" placeholder="Password" class="focus" />
									<button>Login</button>
								</form>
								<div class="main_login_box">
									<div class="left_login_class"><a href="forgotpassword.php">Forgot Password?</a></div>
									<div class="right_login_class"><a href="register.php" class="first_v2"><span>New User</span><img src="images/click.png" alt=""/></a></div>
								</div>

							</div>



						</div>
					</div>

				</div>

			</div>
		</div>

	</body>
</html>
