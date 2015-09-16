<?php
$title = 'Quality List';
include 'header.php';
if($q['isadmin'] == 1)
{
	$result = mysql_query("SELECT * FROM quality ORDER BY id ASC") or die($result . mysql_error());
}
?>


            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
			<?php
			if($q['isadmin'] == 1)
			{
			?>
			
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Quality List
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
			
					<?php
								
									if(mysql_num_rows($result)>0) 
									{
								?>
                                <div class="box-body table-responsive">
								
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
												<th>Supplier</th>
												<th>Weight (gm)</th>
												<th>Quality</th>
												<th>Fabric Type</th>
												<th>Width (mts)</th>
												<th>Color</th>
												<th>Cloth</th>
												<th>Percent (%)</th>
												
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											while($details=mysql_fetch_array($result))
											{
										?>
                                            <tr>
												<td><?php echo $details['supplier']; ?></td>
												<td><?php echo $details['weight']; ?></td>
												<td><?php echo $details['quality']; ?></td>
												<td><?php echo $details['fabric_type']; ?></td>
												<td><?php echo $details['width']; ?></td>
												<td><?php echo $details['colour']; ?></td>
												<td><?php echo $details['cloth']; ?></td>
												<td><?php echo $details['percent']; ?></td>
												
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
										echo $error	= "<div style='margin: 0 auto;' class='red'>No result found.</div>";
										echo '<div class="abc"></div>';
									}

									?>
									
                        </section><!-- right col -->
						<?php
			}
						?>
                    </div><!-- /.row (main row) -->

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