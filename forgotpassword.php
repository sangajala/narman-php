<?php
include("config.php");
if(isset($_POST['submit']))
{ 
 $mail=$_POST['email'];
 $q=mysql_query("select * from register where email='".$mail."' ") or die(mysql_error());
 $p=mysql_num_rows($q);
 if($p!=0) 
 {
  $res=mysql_fetch_array($q,MYSQLI_ASSOC); 
  $code= rand(10,100000000);
  $update=mysql_query("UPDATE register SET code = $code where email='".$mail."' ") or die(mysql_error());
  
  $to=$res['email'];
  $subject='Remind password';
  $message = 'This mail is sent from a no-reply address, please use our support service for future assistance'."\n";
  $message .= ''."\n";
  $message .= 'You forgot your password?'."\n";
  $message .= ''."\n";
  $message .= 'Click on the link below to set a new password: '."\n";
  $message .='http://anayaclients.com/narman/newpassword.php?code='.$code.''."\n"; 
  $message .= ''."\n";
  $message .= ''."\n";
  $message .= ''."\n";
  $message .= 'Best Regards,'."\n";
  $message .= 'Narmans.com Team '."\n";
  $message .= 'http://www.narmans.com'."\n";
  $headers = 'From: webmaster@example.com' . "\r\n" . 
    'X-Mailer: PHP/' . phpversion();  
   $m=mail($to,$subject,$message,$headers);
  
  if($m)
  {
    $success = '<p class="green">We just emailed you a link that will help you change your password. If you do not find it in your inbox, look for it in your junk mail folder or check your e-mail again later.</p>';
  }
  else
  {
   echo'mail is not send';
  }
 }
 else
 {
 $error = '<p class="red">You entered mail id is not present</p>';
 }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Forgot Password</title>
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
<div class="header_tag"><h2>Forgot Password</h2></div>
<script>
			$(document).ready(function(){
				
			$('#forgot').validate({
				rules : {
					 
					email: {
						required: true,
						email: true,
						
				    },
					
					
				},
				messages: {
					
					email: {
						required: "Please enter valid Email",
						email: "Please enter a valid email address"
					},
					
				
				},
			});
			});
		</script>
<form action="" method='post' id='forgot'>
<?php
echo $success;
echo $error;
?>
<div class="section_inner_">
<p class="tag_line_">Enter your e-mail address and we will e-mail you a link to set a 
new password.</p>
<input type="text" name="email" placeholder="email" class="focus">

<input type="submit" name="submit" value="confirm" class="button">
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
