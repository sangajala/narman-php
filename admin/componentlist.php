<?php
$title = 'Component List';
include 'header.php';
if($q['isadmin'] == 1)
{
	$table=mysql_query("SELECT * FROM component");
}
?>


            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        All Component
                       
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
					<?php
								if(mysql_num_rows($table) > 0)
								{
									
								?>
                   <div class="box-body table-responsive">
								
                      <table id="example2" class="table table-bordered table-hover">
							<thead>
                             <tr>
									<th>Component Name</th> 
									<th>Component Option</th>
									<th>Action</th>
                             </tr>
                          </thead>
                          <tbody>
							<?php
								while($row=mysql_fetch_array($table))
								{
									?>
									<tr>
									<td><?php echo $row['name']; ?></td>
									<td><?php echo $row['option']; ?></td>
									<td><a href="editcomponent.php?id=<?php echo $row['id']; ?>">Edit/Clone</td>
									</tr>
									<?php
								}
							?>
							</tbody>
						</table>
					</div>
					<?php
					}
								else
								{
									$e_message="<div calss='red'>No result found</div>";
								}
								?>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
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