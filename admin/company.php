<?php
$title='View Company';
include 'header.php';
$id=$_GET['id'];

if($q['isadmin'] == 1)
{

$sql=mysql_query("select * from company where id='$id'") or die(mysql_error());

}
?>


            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                   
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Module</h3>  
									
									<!--script>
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
									</script-->
                                </div><!-- /.box-header -->
								<?php
								echo $error;
									if(mysql_num_rows($sql)>0) 
									{
								?>
                                <div class="box-body table-responsive">
								
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
												<th>Company Type</th>
												<th>Company Name</th>
												<th>Phone Number</th>
												<th>Email</th>
												<th>City</th>
												<th>Country</th>
												<th>Active</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											$details=mysql_fetch_array($sql);
										?>
                                            <tr>
												<td><?php echo $details['company_type']; ?></td>
												<td><?php echo $details['company_name']; ?></td>
												<td><?php echo $details['phone']; ?></td>
												<td><?php echo $details['contact_email']; ?></td>
												<td><?php echo $details['city']; ?></td>
												<td><?php echo $details['country']; ?></td>
												<td><?php if($details['status'] == 1) echo "Yes"; else echo "No"; ?></td>
											</tr>
										
                                        </tbody>
                                        
                                    </table>
									<?php		
									} 
									else 
									{
										$error	= "No result found.";
									}

									?>
									<a class="change" href="companylist.php"><input class="button" type="button" value="Back to List"></a>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            
                            
                        </div>
                    </div>

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