<?php
$title='Add Component';
include 'header.php';

if($q['isadmin'] == 1)
{
if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	$option1=$_POST['option'];
	$option=implode(",",$option1);
	$sql=mysql_query("INSERT INTO component (`name`,`option`) values ('$name', '$option')") or die($sql . mysql_error());
	$success= "<div class='green'>Component added successfully</div>";
}
}
?>


            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Add Component
                       
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
				<?php
				if($q['isadmin'] == 1)
				{
				?>
				<script>
								$(document).ready(function(){
									jQuery.validator.addMethod("lettersonly", function(value, element) {
				  return this.optional(element) || /^[a-z]+$/i.test(value);
				}, "Component name should be characters only");
								$('#component').validate({
									rules : {
										 name: {
											required: true,
											lettersonly: true,
										},
  
										'option[]' : {
											required: function () {
									   if ($("#option option[value='']")) {
										   return true;
									   } else {
										   return false;
									   }
								   },
										},
										
										
										
									},
									messages: {
										name: {
											required: "Please enter valid Component name",
											lettersonly: "Component name should be characters only",
										},
										
										'option[]' : {
											required:"Please select at least one Component"
										},
										
										},
								});
								});
							</script>
					<p><a class="change" href="componentlist.php">Back to list</a></p>
					<div class="register_main_class">
						<div class="register_popup">
							<div class="header_tag">
								<h2>Add Component</h2>
							</div>
								<?php 
									echo $e_message;
									echo $success;
								?>
							<form action="" method="post" name='component' id="component">
								<div class="section_inner_ lrg">
									<input type="text" name="name" id="name" value="" placeholder="Component name">
									<div class="drop_b">
										<select name="option[]" multiple="multiple" id="option">
										<option value="">Please select component option</option>
										<option value="Silk">Silk</option>
										<option value="Whool">Whool</option>
										<option value="Jeans">Jeans</option>
										<option value="Cotton">Cotton</option>
										</select>
									</div>
									<div class="clear"></div>
									<div class="six">
										<input class="button" type="reset" name="reset" value="Cancel" />
									</div>
									<div class="six">
										<input class="button" type="submit" name="submit" value="Add" />
									</div>
									<div class="clear"></div>
								</div>
							</form>
							<div class="footer_tag"><a href="componentlist.php">Cancel</a></div>
						</div>

					</div>
					<?php
				}
					?>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>        

    </body>
</html>