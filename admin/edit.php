<?php
$title = 'Edit User';
include 'header.php';
$supplier = $q['supplier'];

$id=$_GET['id'];
if(isset($_POST["submit"])) {
	$uname=$_POST["username"];
	$email=$_POST["email"];
	$pass=$_POST["passid"];
	$password = md5($pass);
	$role=$_POST["role"];
	$company=$_POST["company"];
	$supplier=$_POST["supplier"];
	$status=$_POST["active"];
	$access=$_POST["access"];
	$dup = mysql_query("select `email` from `register` where email='$email' && `id` != '$id'");
	$count = mysql_num_rows($dup);
	$dup1 = mysql_query("select `name` from `register` where `name`='$uname' && id!='$id'");
	$count1 = mysql_num_rows($dup1);
        if($count >0)
		{
			//echo $dup;
			$e_message = "<div class='red'>Email Already Used.</div>";
            
        }
		
		elseif($count1 >0)
		{
			$e_message = "<div class='red'>Username Already Used.</div>";
            
        }
		elseif($q['adminaccess'] == 1 && empty($pass))
		{
			$supplier = $q['supplier'];
			$sql1 = ("UPDATE register SET name = '$uname',email = '$email', role ='$role', company = '$company',  supplier = '$supplier', adminaccess = '$access', status = '$status', dateupdated = 'now()' WHERE id = '$id' ");
			
			$result= mysql_query($sql1) or die($sql1 . mysql_error());
			$success = "<div class='green'>User updated successfully</div>";
			//header("Location: edit.php?id=$id");
		}
		elseif(empty($pass))
		{
			$sql1 = ("UPDATE register SET name = '$uname',email = '$email', role ='$role', company = '$company',  supplier = '$supplier', adminaccess = '$access', status = '$status', dateupdated = 'now()' WHERE id = '$id' ");
			
			$result= mysql_query($sql1) or die($sql1 . mysql_error());
			$success = "<div class='green'>User updated successfully</div>";
			//header("Location: edit.php?id=$id");
		}
		else{
			
            $sql1 = ("UPDATE register SET name = '$uname',email = '$email', password = '$password', role ='$role', company = '$company', supplier = '$supplier', status = '$status', dateupdated = 'now()' WHERE id = '$id' ");
			
			$result= mysql_query($sql1) or die($sql1 . mysql_error());
			$success = "<div class='green'>User updated successfully</div>";
			//header("Location: edit.php?id=$id");
		}	    
	
}
$sql=mysql_query("select * from register where id='$id'") or die(mysql_error());
?>


            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">     
<?php
if($q['isadmin'] == 1 || $q['adminaccess'] == 1)
{
?>			
                <!-- Content Header (Page header) -->
                <section class="content-header">
                   <p><a class="change" href="users.php">Back to List</a></p>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="edit_main_class">
					<div class="register_popup">
					<div class="header_tag"><h2>Edit User</h2></div>
					</div>
					<script>
								$(document).ready(function(){
									jQuery.validator.addMethod("onedigit", function(value, element) {
									  return this.optional(element) || /^.*(?=.*\d)(?=.*[A-Z]).*$/.test(value);
									}, "Password should contain atleast 1 capital letter and 1 number");
								$('#updated').validate({
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
											minlength: "Password should be more than 6 characters",
											maxlength: "Password should not be more than 20 characters",
											onedigit : "Password should have atleast 1 capital and 1 number"
										},
										cpassid : {
											equalTo:"Please match your password"
										},
										company : {
											equalTo:"Password and confirm Password hould be same",
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
					<div class="clear"></div>
					<?php
					if(mysql_num_rows($sql)>0) {
					$details=mysql_fetch_array($sql);
					echo $e_message;
					echo $success;
					?>
					<form name='registration' id="updated" method="post" action="">  
					<div class="section_inner_ lrg">
					<input type="text" name="username" id="username" readonly placeholder="Username" value="<?php echo $details['name']; ?>" class="focus">
					<input type="text" name="email" id="email" placeholder="Email" value="<?php echo $details['email']; ?>" class="focus">
					<input type="password" id="passid"  name="passid" placeholder="Password" class="focus">
					<input type="password" id="cpassid"   name="cpassid" placeholder="Confirm Password" class="focus">
					<div class="drop_b"><select class="select" name="role" id="role">
						<option value="">Please select a role</option>
						<option value="Mother" <?php if($details['role'] == "Mother") echo 'selected="selected,"'; ?>>Mother Company</option>
						<option value="Supplier" <?php if($details['role'] == "Supplier") echo 'selected="selected"'; ?>>Supplier</option>
						<option value="Agent" <?php if($details['role'] == "Agent") echo 'selected="selected"'; ?>>Agent</option>
						<option value="Customer" <?php if($details['role'] == "Customer") echo 'selected="selected,"'; ?>>Customer</option>
						
					</select>
					</div>
					
					<?php
					if($q['adminaccess'] == 1)
						{
					?>
					<input type="text" name="supplier" readonly value="<?php echo $q['supplier'];?>">
					<?php
						}
						if($details['supplier'] != '')
						{
							
					?>
						<div class="drop_b">
							<select class="select" name="supplier" id="supplier">
								<option selected="" value="">Please select a supplier</option>
								<option value="supplier1" <?php if($details['supplier'] == "supplier1") echo 'selected="selected"'; ?>>supplier1</option>
								<option value="supplier2" <?php if($details['supplier'] == "supplier2") echo 'selected="selected"'; ?>>supplier2</option>
								<option value="supplier3" <?php if($details['supplier'] == "supplier3") echo 'selected="selected"'; ?>>supplier3</option>
								<option value="supplier4" <?php if($details['supplier'] == "supplier4") echo 'selected="selected"'; ?>>supplier4</option>
							</select>
							</div>
					<?php
						}
						
					if($details['company'] != '')
						{
						$comp_query = mysql_query("SELECT `company_name` FROM `company` WHERE `status` = '1' ORDER BY id ASC");	
					?>
					
					<div class="drop_b"><select class="select" name="company" id="company">
						<option value="">Please select a company</option>
						<?php
					while($comp=mysql_fetch_array($comp_query))
					{
					?>

						<option value="<?php echo $comp['company_name']; ?>" <?php if($details['company'] == $comp['company_name']) echo 'selected="selected"'; ?>><?php echo $comp['company_name']; ?></option>
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
					
					
					<!--div class="drop_b">
					<select class="select" name="supplier" id="supplier">
						<option selected value="">Please select a supplier</option>
						<option value="supplier1">supplier1</option>
						<option value="supplier2">supplier2</option>
						<option value="supplier3">supplier3</option>
						<option value="supplier4">supplier4</option>
					</select>
					</div-->
					<div class="checkbox_main">
					<p class="checkbox_class_n"><?php if($details['adminaccess'] == 1) echo "Admin Access"; elseif($details['adminaccess'] == 2) echo "Pending Admin Access"; else echo "Admin Access"; ?><input type="checkbox" <?php if($details['adminaccess'] == "1") echo 'checked="checked,"'; ?> name="access" value="1"></p>
					<p class="checkbox_class_n">Inactive User<input type="checkbox" <?php if($details['status'] == "1") echo 'checked="checked,"'; ?> name="active" value="1"></p>
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
					<div class="footer_tag"><a href="users.php">Cancel</a></div>
					</div> 
					<div class="clear"></div>
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
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>

    </body>
</html>