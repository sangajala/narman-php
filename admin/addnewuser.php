<?php
$title='Add User';
include 'header.php';
$supplier = $q['supplier'];

if(isset($_POST["submit"])) 
{
	$uname=$_POST["username"];
	$email=$_POST["email"];
	$pass=$_POST["passid"];
	$password = md5($pass);
	$role=$_POST["role"];
	$company=$_POST["company"];
	$supplier=$_POST["supplier"];
	$status=$_POST["active"];
	$access=$_POST["access"];
	$dup = mysql_query("SELECT email FROM register WHERE email='".$_POST['email']."'");
	$dup1 = mysql_query("SELECT name FROM register WHERE name='".$_POST['username']."'");
        if(mysql_num_rows($dup) >0)
		{
			$e_message = "<div class='red'>Email Already Used.</div>";
            
        }
		elseif(mysql_num_rows($dup1) >0)
		{
			$e_message = "<div class='red'>Username Already Used.</div>";
            
        }
        elseif($q['adminaccess'] == 1)
		{
			$supplier = $q['supplier'];
			//$role = $q['role'];
			$sql = "INSERT INTO register (name,email, password, role, company, supplier, adminaccess, status, dateadded, dateupdated )
			VALUES ('$uname', '$email', '$password','$role', '$company', '$supplier', '$access', '$status' ,now(), now())";
			$result= mysql_query($sql) or die($sql . mysql_error());
			//print_r($result);

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

			



			function clean_string($string) 
			{
 
				$bad = array("content-type","bcc:","to:","cc:","href");

				return str_replace($bad,"",$string);
 
			}
			$email_message  = "Welcome and thank you for registering at Narmans.com!"."\n";
			$email_message .= ""."\n";
			$email_message .= "Your account details: "."\n";
			$email_message .= "Username: ".clean_string($uname)."\n";
			$email_message .= "Email: ".clean_string($email_to)."\n";
			$email_message .= "Password: ".clean_string($pass)."\n";
			$email_message .= ""."\n";
			$email_message .= "Visit the link to Login http://anayaclients.com/narman/login.php"."\n";
			$email_message .= ""."\n";
			$email_message .= "Thanks,"."\n";
			$email_message .= "Narmans team"."\n";
			// create email headers


			$headers = 'From: '.$email_from."\r\n".

			'Reply-To: '.$email_from."\r\n" .

			'X-Mailer: PHP/' . phpversion();

			@mail($email_to, $email_subject, $email_message, $headers); 

			$success = "<div class='green'>User created successfully. Please ask him to check his mail.</div>";
		
		}
		else
		{
            $sql = "INSERT INTO register (name,email, password, role, company, supplier, adminaccess, status, dateadded, dateupdated )
			VALUES ('$uname', '$email', '$password','$role', '$company', '$supplier', '$access', '$status' ,now(), now())";
			$result= mysql_query($sql) or die($sql . mysql_error());
			//print_r($result);

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

			



			function clean_string($string) 
			{
 
				$bad = array("content-type","bcc:","to:","cc:","href");

				return str_replace($bad,"",$string);
 
			}
			$email_message  = "Welcome and thank you for registering at Narmans.com!"."\n";
			$email_message .= ""."\n";
			$email_message .= "Your account details: "."\n";
			$email_message .= "Username: ".clean_string($uname)."\n";
			$email_message .= "Email: ".clean_string($email_to)."\n";
			$email_message .= "Password: ".clean_string($pass)."\n";
			$email_message .= ""."\n";
			$email_message .= "Visit the link to Login http://anayaclients.com/narman/login.php"."\n";
			$email_message .= ""."\n";
			$email_message .= "Thanks,"."\n";
			$email_message .= "Narmans team"."\n";
			// create email headers


			$headers = 'From: '.$email_from."\r\n".

			'Reply-To: '.$email_from."\r\n" .

			'X-Mailer: PHP/' . phpversion();

			@mail($email_to, $email_subject, $email_message, $headers); 

			$success = "<div class='green'>User created successfully. Please ask him to check his mail.</div>";
        }
	
}
?> 


            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
				<?php
				if($q['isadmin'] == 1 || $q['adminaccess'] == 1)
				{
					?>
                <section class="content-header">

				<p><a class="change" href="users.php">Back to List</a></p>
				<div class="edit_main_class">
				<div class="register_popup">
				<div class="header_tag"><h2>New User</h2></div>
				<script>
			$(document).ready(function(){
				jQuery.validator.addMethod("onedigit", function(value, element) {
				  return this.optional(element) || /^.*(?=.*\d)(?=.*[A-Z]).*$/.test(value);
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
					role : {
						required: function () {
                   if ($("#role option[value='0']")) {
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
					role : {
						required:"Please select at least one Role"
					},
				
				},
			});
			});
		</script>
		<script>
				$(document).ready(function() {
				  $('#supplier').hide(); 

				  $("[name='role']").change(function() {
					var sel = $(this).val();
					if(sel == 'Mother') {
					  $('#company').attr("disabled","disabled");
					  $('#supplier').hide();
					} else if(sel == 'Supplier') {
					  $('#company').removeAttr("disabled");
					  $('#supplier').show();
					} else if(sel == 'Agent') {
					  $('#company').removeAttr("disabled");
					  $('#supplier').show();
					}else if(sel == 'Customer') {
					  $('#company').removeAttr("disabled");
					  $('#supplier').show();
					}
					else if(sel == '') {
					  $('#company').removeAttr("disabled");
					  $('#supplier').hide();
					}
				  });
				});
				</script> 
								
		<?php 
			echo $e_message;
			echo $success;
		?>
		
			<form name='registration' id="registration" method="post" action="">  
				<div class="section_inner_ lrg">
				<input type="text" name="username" id="username" placeholder="Username" class="focus">
				<input type="text" name="email" id="email" placeholder="Email" class="focus">
				<input type="password" id="passid"  name="passid" placeholder="Password" class="focus">
				<input type="password" id="cpassid"   name="cpassid" placeholder="Confirm Password" class="focus">
				<?php
				if($q['adminaccess'] == 1)
					{
				?>
				<!--input type="text" name="role" readonly value="<?php echo $q['role'];?>"-->
				<div class="drop_b">
				<input type="text" name="role" readonly value="<?php echo $q['role']; ?>">
				<!--select class="select role" name="role">
					<option value="">Please select a role</option>
					<option value="Supplier">Supplier</option>
					<option value="Agent">Agent</option>
					<option value="Customer">Customer</option>
					
				</select-->
				</div>
				<input type="text" name="supplier" readonly value="<?php echo $q['supplier'];?>">
				<div class="drop_b">
					<select class="select role" name="company" disabled="disabled">
						<option value="">Please select a company</option>
					</select>
				</div>
				<?php
					}
					else{
				?>
				<div class="drop_b"><select class="select role" name="role">
					<option value="">Please select a role</option>
					<option value="Mother">Mother Company</option>
					<option value="Supplier">Supplier</option>
					<option value="Agent">Agent</option>
					<option value="Customer">Customer</option>
					
				</select>
				</div>
				<div class="drop_b">
				<select class="select" name="supplier" id="supplier">
					<option selected value="">Please select a supplier</option>
					<option value="supplier1">supplier1</option>
					<option value="supplier2">supplier2</option>
					<option value="supplier3">supplier3</option>
					<option value="supplier4">supplier4</option>
				</select>
				</div>

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
				
				<?php
					}
				?>
				
				<div class="checkbox_main">
				<p class="checkbox_class_n">Admin Access<input type="checkbox" name="access" value="1"></p>
				<p class="checkbox_class_n">Inactive User<input type="checkbox" name="active" value="1"></p>
				</div>
				<div class="clear"></div>
				<div class="ac"><input class="button" type="reset" name="reset" value="Reset"></div>
				<div class="acc"><input class="button" type="submit" name="submit" value="Submit" /></div>
				<div class="clear"></div>
				</div>
			</form>

			<div class="footer_tag"><a href="users.php">Cancel</a></div>
        </div>
		</div>		
		<div class="clear"></div>
                </section>
<?php
				}
?>
                <!-- Main content -->
                <section class="content">


                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <!--script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script-->
        <!-- jQuery UI 1.10.3 -->
        <!--script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script-->
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        

        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <!--script src="js/AdminLTE/dashboard.js" type="text/javascript"></script-->        
  
    </body>
</html>