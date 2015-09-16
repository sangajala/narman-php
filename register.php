<?php
include("config.php");

if(isset($_POST["submit"])) 
{
	$uname=$_POST["username"];
	$email=$_POST["email"];
	$pass=$_POST["passid"];
	$password = md5($pass);
	$role=$_POST["role"];
	$company=$_POST["company"];
	$access=$_POST["access"];
	$status=$_POST["active"];
	
	$dup = mysql_query("SELECT email FROM register WHERE email='".$_POST['email']."'");
	$dup1 = mysql_query("SELECT name FROM register WHERE name='".$_POST['username']."'");
        if(mysql_num_rows($dup) >0)
		{
			$e_message = "<p class='red'>The Email is already registered.</p>";
            
        }
		elseif(mysql_num_rows($dup1) >0)
		{
			$e_message = "<p class='red'>The Username is already registered.</p>";
            
        }
        else
		{
            $sql = "INSERT INTO register (name,email, password, role, company, adminaccess, status, dateadded, dateupdated )
			VALUES ('$uname', '$email', '$password','Customer', '$company', '$access', '$status' ,now(), now())";
			$result= mysql_query($sql) or die($sql . mysql_error());
			print_r($result);

			// EDIT THE 2 LINES BELOW AS REQUIRED

			$email_to = $_POST['email'];
			$email_subject = "Confirmation";

			function died($error) 
			{
 
			// your error code can go here
 
				echo "We are very sorry, but there were error(s) found with the form you submitted. ";
 
				echo "These errors appear below.<br /><br />";
 
				echo $error."<br /><br />";
 
				echo "Please go back and fix these errors.<br /><br />";
 
				die();
 
			}
 
			$email_from = "no-reply@narmans.com"; // required

			$error_message = "";

			$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

			if(!preg_match($email_exp,$email_from))
			{
 
				$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
 
			}

			$string_exp = "/^[A-Za-z .'-]+$/";


			if(strlen($error_message) > 0)
			{
 
				died($error_message);
 
			}

			$email_message = "You are successfully registerd with this ";



			function clean_string($string) 
			{
 
				$bad = array("content-type","bcc:","to:","cc:","href");

				return str_replace($bad,"",$string);
 
			}
	
			$email_message .= "Email: ".clean_string($email_to)."\n";

			// create email headers

			$headers = 'From: '.$email_from."\r\n".

			'Reply-To: '.$email_from."\r\n" .

			'X-Mailer: PHP/' . phpversion();

			@mail($email_to, $email_subject, $email_message, $headers); 

			$success = "<p class='green'>Registered successfully. Please check your mail.</p>";
			if($access == 2)
			{
			$to = "no-reply@narmans.com";
			$from = $_POST['email'];
			$subject = "Admin Access Request";  
			$message = "User $email is requested for the admin access.";
			$headers = 'From: '.$from."\r\n".

			'Reply-To: '.$from."\r\n" .

			'X-Mailer: PHP/' . phpversion();
			@mail($to, $subject, $message, $headers); 
			}
        }
	
}
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sign Up</title>
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
<div class="header_tag"><h2>New User</h2></div>
<script>
			$(document).ready(function(){
				jQuery.validator.addMethod("onedigit", function(value, element) {
				  return this.optional(element) || /^.*(?=.*\d)(?=.*[A-Z])(?=.*[a-z]).*$/.test(value);
				}, "Password should contain atleast 1 capital letter and 1 number");
				
				
			$('#registration').validate({
				rules : {
					 username: {
						required: true,
						minlength : 6,
						maxlength : 20,
					},
					 
					email: {
						required: true,
						email: true,
						
				    },
					passid : {
						required: true,
						minlength : 6,
						maxlength : 20,
						onedigit : true
					},
					cpassid : {
						equalTo : "#passid"
					},
					company : {
						required: function () {
                   if ($("#company option[value='0']")) {
                       return true;
                   } else {
                       return false;
                   }
               },
					},
					
				},
				messages: {
					username: {
						required: "Please enter valid Username",
						minlength: "Username should be more than 6 characters",
						maxlength: "Username should not be more than 20 characters"
					},
					email: {
						required: "Please enter valid Email",
						email: "Please enter a valid email address"
					},
					
					passid: {
						required: "Please enter valid Password",
						minlength: "Password should be more than 6 characters",
						maxlength: "Password should not be more than 20 characters",
						onedigit : "Password should have atleast 1 capital and 1 number"
					},
					cpassid : {
						equalTo:"Password and confirm Password should be same",
					},
					company : {
						required:"Please select at least one Company"
					},
				
				},
			});
			});
		</script>
		<?php 
			echo $e_message;
			echo $success;
		?>
<form name='registration' id="registration" method="post" action="">  
<div class="section_inner_">
<input type="text" name="username" id="username" placeholder="Username" class="focus">
<input type="text" name="email" id="email" placeholder="Email" class="focus">
<input type="password" id="passid"  name="passid" placeholder="Password" class="focus">
<input type="password" id="cpassid"   name="cpassid" placeholder="Confirm Password" class="focus">
<?php
$comp_query = mysql_query("SELECT `company_name` FROM `company` WHERE `status` = '1' ORDER BY id ASC");
if(mysql_num_rows($comp_query) > 0)
{
?>
<div class="drop_b"><select class="select" name="company" id="company">
<option selected value="">Please select a company</option>
<?php
while($comp=mysql_fetch_array($comp_query))
{
?>
    
    <option value="<?php echo $comp['company_name']; ?>"><?php echo $comp['company_name']; ?></option>
	<?php   
}

?>
</select></div>
<?php
}
else
{
?>
<input type="text" readonly name="company" value="" placeholder="No Company found">

<?php	
}
?>

<div class="checkbox_main">
<p class="checkbox_class_n">Admin Access<input type="checkbox" name="access" value="2"></p>
<p class="checkbox_class_n">Active User<input type="checkbox" name="active" value="1"></p>
</div>
<div class="clear"></div>
<div class="six">
<input class="button" type="reset" name="reset" value="Reset" />
</div>
<div class="six">
<input class="button" type="submit" name="submit" value="Submit" />
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
