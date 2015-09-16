<?php
$title = 'Order List';
include 'header.php';
if($q['isadmin'] == 1)
{
	$result = mysql_query("SELECT * FROM `order` ORDER BY id ASC") or die($result . mysql_error());
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
                        Order List
                    </h1>
                 <script type="text/javascript">
										function delete_id(id)
										{
											 if(confirm('Sure To Remove This Record ?'))
											 {
												window.location.href='orderlist.php?delete_id='+id;
											 }
										}
									</script>   
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
												<th>Order Id</th>
												<th>Quality</th>
												<th>Agent</th>
												<th>Supplier</th>
												<th>Color</th>
												<th>Delivery Date</th>
												<th>Test</th>
												<th>Action</th>
											</tr>
                                        </thead>
                                        <tbody>
										<?php
											while($details=mysql_fetch_array($result))
											{
										?>
                                            <tr>
												<td><?php echo $details['id']; ?></td>
												<td><?php echo $details['quality']; ?></td>
												<td><?php echo $details['agent']; ?></td>
												<td><?php echo $details['supplier']; ?></td>
												<td><?php echo $details['color']; ?></td>
												<td><?php echo $details['datepicker']; ?></td>
												<td><?php echo $details['testing']; ?></td>
												<td><a href="editorder.php?id=<?php echo $details['id']; ?>">Edit</a></td>
												
												
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
        

        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
              

    </body>
</html>