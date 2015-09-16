<?php
$title = 'View Users';
include 'header.php';
$id=$_GET['id'];
$sql=mysql_query("select * from register where id='$id'") or die(mysql_error());
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
                                    <h3 class="box-title">User Details</h3>  
									
                                </div><!-- /.box-header -->
								<?php
									if(mysql_num_rows($sql)>0)    
									{
								?>
                                <div class="box-body table-responsive">
								
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
												<th>NAME</th>
												<th>EMAIL</th>
												<th>ROLE</th>
												<th>COMPANY</th>  
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											$details=mysql_fetch_array($sql);
											
										?>
                                            <tr>
												<td><?php echo $details['name']; ?></td>
												<td><?php echo $details['email']; ?></td>
												<td><?php echo $details['role']; ?></td>
												<td><?php echo $details['company']; ?></td>
												
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
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            
                            
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
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