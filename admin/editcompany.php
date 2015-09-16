<?php
$title = 'Edit Company';
include 'header.php';
$id=$_GET['id'];

if(isset($_POST["submit"])) 
{
	$company_type=$_POST["company_type"];
	$company_name=$_POST["company_name"];
	$phone=$_POST["phone"];
	$fax=$_POST["fax"];
	$uname=$_POST["username"];
	$email=$_POST["email"];
	$address =$_POST["address"];
	$city=$_POST["city"];
	$state=$_POST["state"];
	$postal=$_POST["postal"];
	$country=$_POST["country"];
	$website=$_POST["website"];
	$status=$_POST["active"];
	$dup = mysql_query("select `company_name` from `company` where email='$company_name' && `id` != '$id'");
	$count = mysql_num_rows($dup);
        if($count >0)
		{
			//echo $dup;
			$e_message = "<div class='red'>Company name Already Used.</div>";
            
        }
		else
		{
			$sql1 = ("UPDATE company SET company_type = '$company_type',company_name = '$company_name', phone = '$phone', fax ='$fax', contact_name = '$uname', contact_email = '$email', address = 'address', city= '$city', state = '$state', postal= '$postal', country = '$country', website = '$website', status = '$status', dateupdated = 'now()' WHERE id = '$id' ");
			
			$result= mysql_query($sql1) or die($sql1 . mysql_error());
			$success = "<div class='green'>Company updated successfully</div>";
			//header("Location: editcompany.php?id=$id");	
			//echo $status;
		}
		if($status != "1")
		{
			$inactive_query = mysql_query("UPDATE `register` SET `status`='0' WHERE `role`='$company_type'");
			//echo mysql_num_rows($inactive_query);
		}
}
$sql=mysql_query("select * from company where id='$id'") or die(mysql_error());
?> 


            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
				<?php
				if($q['isadmin'] == 1)
				{
				?>
                <section class="content-header">
				<p><a class="change" href="companylist.php"><input class="button" type="button" value="Back to List"></a></p>
					<div class="edit_main_class">
<div class="register_popup">
<div class="header_tag"><h2>Edit Company</h2></div>
<script>
			$(document).ready(function(){
				jQuery.validator.addMethod("url", function(value, element) {
				  return this.optional(element) || /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(value);
				}, "Please enter a valid url");
				
				
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
					phone : {
						required: true,
						number: true,
						maxlength : 15,
					},
					company_type : {
						required: function () {
                   if ($("#company_type option[value='0']")) {
                       return true;
                   } else {
                       return false;
                   }
               },
					},
					company_name : {
						required: true,
					},
					website: {
						url: true,
					},
					
				},
				messages: {
					username: {
						required: "Contact person is required",
						minlength: "Contact person should be more than 6 characters",
						maxlength: "Contact person should not be more than 20 characters"
					},
					
					email: {
						required: "Email is required",
						email: "Please enter a valid email address"
					},
					
					phone: {
						required: "Phone is required",
						number: "Phone number should be digits only",
						maxlength: "Phone number should not be more than 15 digits"
					},
					company_type : {
						required:"Company type is required"
					},
					company_name : {
						required:"Company name is required"
					},
					website: {
						required:"Please enter a valid url"
					},
				
				},
			});
			});
		</script>
<?php
if(mysql_num_rows($sql)>0) {
$details=mysql_fetch_array($sql);
echo $e_message;
echo $success;
?>
<form name='registration' id="registration" method="post" action="">  
	<div class="section_inner_ lrg">
		<div class="drop_b">
			<select class="select" name="company_type" id="company_type">
				<option selected value="">Please select company type</option>
				<option value="Mother Company" <?php if($details['company_type'] == "Mother Company") echo 'selected="selected"'; ?>>Mother Company</option>
				<option value="Supplier" <?php if($details['company_type'] == "Supplier") echo 'selected="selected"'; ?>>Supplier</option>
				<option value="Agent" <?php if($details['company_type'] == "Agent") echo 'selected="selected"'; ?>>Agent</option>
				<option value="Customer" <?php if($details['company_type'] == "Customer") echo 'selected="selected"'; ?>>Customer</option>
			</select>
		</div>
		<input type="text" name="company_name" id="company_name" value="<?php echo $details['company_name']; ?>" placeholder="Company Name" class="focus">
		<input type="text" name="phone" id="phone" value="<?php echo $details['phone']; ?>" placeholder="Phone Number" class="focus">
		<input type="text" name="fax" id="fax" value="<?php echo $details['fax']; ?>" placeholder="Fax Number" class="focus">
		<input type="text" name="username" id="username" value="<?php echo $details['contact_name']; ?>" placeholder="Contact Person" class="focus">
		<input type="text" name="email" id="email" value="<?php echo $details['contact_email']; ?>" placeholder="Email" class="focus">
		<input type="text" id="address" name="address" value="<?php echo $details['address']; ?>" placeholder="Address" class="focus">
		<input type="text" id="city" name="city" value="<?php echo $details['city']; ?>" placeholder="City" class="focus">
		<input type="text" id="state" name="state" value="<?php echo $details['state']; ?>" placeholder="State" class="focus">
		<input type="text" id="postal" name="postal" value="<?php echo $details['postal']; ?>" placeholder="Postal code" class="focus">
		<input type="text" id="country" name="country" value="<?php echo $details['country']; ?>" placeholder="Country" class="focus">
		<input type="text" id="website" name="website" value="<?php echo $details['website']; ?>" placeholder="Website Address" class="focus">
		<div class="checkbox_main">
			<p class="checkbox_class_n">Inactive<input type="checkbox" <?php if($details['status'] == "1") echo 'checked="checked,"'; ?> name="active" value="1"></p>
		</div>
		<input class="button" type="submit" name="submit" value="Submit" />
	</div>
</form>
	<?php
	

	} 
	else {

		$e_message	= "<div class='red'>No result found.</div>";

	}

?>
<div class="footer_tag"><a href="companylist.php">Cancel</a></div>
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


        <!-- jQuery 2.0.2 -->
        <!--script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script-->
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>

        <!-- page script -->
        

    </body>
</html>