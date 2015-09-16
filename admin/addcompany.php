<?php
$title='Add Company';
include 'header.php';
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
	
	$dup = mysql_query("SELECT company_name FROM company WHERE company_name='".$_POST['company_name']."'");
	//$dup1 = mysql_query("SELECT name FROM register WHERE name='".$_POST['username']."'");
        if(mysql_num_rows($dup) >0)
		{
			$e_message = "<div class='red'>Company Name Already Used.</div>";
            
        }
		//elseif(mysql_num_rows($dup1) >0)
		//{
			//$e_message = "<div class='red'>Username Already Used.</div>";
            
        //}
        else
		{
            $sql = "INSERT INTO company (company_type, company_name, phone, fax, contact_name, contact_email, address, city, state, postal, country, website, status, dateadded, dateupdated)
			VALUES ('$company_type', '$company_name', '$phone', '$fax', '$uname', '$email', '$address','$city', '$state', '$postal', '$country', '$website', '$status', 'now()', 'now()')";
			$result= mysql_query($sql) or die($sql . mysql_error());
			//print_r($result);
			$success = "<div class='green'> Succcessfully Added</div>";
			
        }
	
}
?> 


            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
				<?php
				if($q['isadmin'] == 1)
				{
				?>
                <section class="content-header">
                   <p><a class="change" href="companylist.php">Back to List</a></p>
                </section>

                <!-- Main content -->
                <section class="content">
					<div class="edit_main_class">
					<div class="register_popup">
					<div class="header_tag"><h2>Add Company</h2></div>
					<script>
								$(document).ready(function(){
									jQuery.validator.addMethod("url", function(value, element) {
									  return this.optional(element) || /^.*(https?:\/\/(?:www\.|(?!www))[^\s\.]+\.[^\s]{2,}|www\.[^\s]+\.[^\s]{2,}|[^\s]+\.[^\s]{2,}).*$/.test(value);
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
											maxlength : 20,
										},
										fax : {
											maxlength : 20,
										},
										address : {
											maxlength : 200,
										},
										city : {
											maxlength : 20,
										},
										state : {
											maxlength : 20,
										},
										postal : {
											maxlength : 20,
										},
										country : {
											maxlength : 20,
										},
										website: {
											url: true,
											maxlength : 200,
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
											required:"Please enter valid Company name",
											maxlength: "Company name should not be more than 20"
										},
										fax : {
											required:"Please enter valid Fax",
											maxlength: "Fax should not be more than 20"
										},
										address : {
											maxlength: "Address should not be more than 200"
										},
										city : {
											maxlength: "City should not be more than 20"
										},
										state : {
											maxlength: "State should not be more than 20"
										},
										postal : {
											maxlength: "Postal should not be more than 20"
										},
										country : {
											maxlength: "Country should not be more than 20"
										},
										website: {
											url:"Please enter a valid url"
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
						<div class="section_inner_ lrg">
						<?php
						$type_query = mysql_query("SELECT company_type FROM company WHERE status='1'");
						if(mysql_num_rows($type_query) > 0)
						{
						?>
							<div class="drop_b">
								<select class="select" name="company_type" id="company_type">
									<option selected value="">Please select company type</option>
									<option value="Mother Company">Mother Company</option>
									<option value="Supplier">Supplier</option>
									<option value="Agent">Agent</option>
									<option value="Customer">Customer</option>
								</select>
							</div>
							<?php
						}
						else
						{
							?>
							<div class="drop_b">
								<select class="select" name="company_type" id="company_type" disabled="disabled">
									<option selected value="">Please select company type</option>
									<option value="Mother Company">Mother Company</option>
									<option value="Supplier">Supplier</option>
									<option value="Agent">Agent</option>
									<option value="Customer">Customer</option>
								</select>
							</div>
							<?php
						}
							?>
							<input type="text" name="company_name" id="company_name" placeholder="Company Name" class="focus">
							<input type="text" name="phone" id="phone" placeholder="Phone Number" class="focus">
							<input type="text" name="fax" id="fax" placeholder="Fax Number" class="focus">
							<input type="text" name="username" id="username" placeholder="Contact Person" class="focus">
							<input type="text" name="email" id="email" placeholder="Email" class="focus">
							<input type="text" id="address" name="address" placeholder="Address" class="focus">
							<input type="text" id="city" name="city" placeholder="City" class="focus">
							<input type="text" id="state" name="state" placeholder="State" class="focus">
							<input type="text" id="postal" name="postal" placeholder="Postal code" class="focus">
							<input type="text" id="country" name="country" placeholder="Country" class="focus">
							<input type="text" id="website" name="website" placeholder="Website Address" class="focus">
							<div class="checkbox_main">
								<p class="checkbox_class_n">Inactive<input type="checkbox" name="active" value="1"></p>
							</div>
							<div class="clear"></div>
							<div class="ac"><input class="button" type="submit" name="submit" value="Submit" /></div>
							<div class="acc"><input class="button" type="reset" value="Reset"></div>
							<div class="clear"></div>
						</div>
					</form>
					<div class="footer_tag"><a href="companylist.php">Cancel</a></div>
					</div>
					</div> 

                </section><!-- /.content -->
				<?php
				}
				?>
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