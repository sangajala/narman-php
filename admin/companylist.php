<?php
$title='Company List';
include 'header.php';
foreach($_REQUEST as $key=>$value) {
										$$key	= is_array($value)? $value: trim($value);
									}
									$where	= array();
									if(!empty($se_company_type)) {
										$where[]	= "company_type LIKE '$se_company_type%'";
									}
									if(!empty($se_email)) {
										$where[]	= "contact_email = '$se_email'";
									}
									if(!empty($se_comp_name)) {
										$where[]	= "company_name = '$se_comp_name'";
									}
									if(!empty($se_phn)) {
										$where[]	= "phone = '$se_phn'";
									}
									if(!empty($se_name)) {
										$where[]	= "contact_name = '$se_name'";
									}
									if(!empty($se_active)) {
										$where[]	= "status = '0'";
									}
									
									$_sql	= (count($where)>0)? " WHERE " . implode(" && ", $where): "";
									
	$sql	= "SELECT * FROM company$_sql ORDER BY id ASC";
	
	if($q['isadmin'] == 1)
	{
		$result	= mysql_query($sql);
	}
	
	if(isset($_GET['delete_id']))
	{
		 $sql_query="DELETE FROM company WHERE id=".$_GET['delete_id'];
		 mysql_query($sql_query);
		 header("Location: companylist.php");
	}
?>


            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">   
<script>
								$(document).ready(function(){
										
								$('#search').validate({
									rules : {
										 
										se_phn : {
											number: true,
											maxlength : 15,
										},
										
										
									},
									messages: {
																				
										se_phn: {
											number: "Phone number should be digits only",
											maxlength: "Phone number should not be more than 15 digits"
										},
										
										
									
									},
								});
								});
							</script>			
                <!-- Content Header (Page header) -->
                <section class="content-header">
                   
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
										<form name="search" method="post" action="" id="search">
										<?php
											$comp_query = mysql_query("SELECT `company_type` FROM `company` WHERE `status` = '1' ORDER BY id ASC");
											if(mysql_num_rows($comp_query) > 0)
											{
											?>
											<div class="six"><select class="select" name="se_company_type" id="se_company_type">
											<option selected value="">Please select company type</option>
											<?php
											while($comp=mysql_fetch_array($comp_query))
											{
											?>
												
												<option value="<?php echo $comp['company_type']; ?>"><?php echo $comp['company_type']; ?></option>
												<?php   
											}

											?>
											</select></div>
											<?php
											}
											else
											{
											?>
											<input type="text" readonly name="se_company_type" value="" placeholder="No Company found">

											<?php	
											}
											?>
										<div class="six">
											<input type="text" name="se_comp_name" placeholder="Company Name">
										</div>
										<div class="clear"></div>
										<div class="six">
											<input type="text" name="se_phn" id="se_phn" placeholder="Phone Number">
										</div>
										<div class="six">
											<input type="text" name="se_name" placeholder="Contact Name">
										</div>
										<div class="clear"></div>
										
										<div class="six">
											Inactive <input type="checkbox" name="se_active" value="1">
										</div>
										<div class="six">
											<input type="email" name="se_email" placeholder="Contact Email">
										</div>
										<div class="full1">
											<input class="button" type="submit" name="search" value="Search">
											<input class="button" type="reset" value="Reset">
										</div>
									</form>
                                    <h3 class="box-title">All Modules</h3>  
									<script type="text/javascript">
										function delete_id(id)
										{
											 if(confirm('Sure To Remove This Record ?'))
											 {
												window.location.href='companylist.php?delete_id='+id;
											 }
										}
									</script>
									<script type="text/javascript">
										var people, asc1 = 1,
											asc2 = 1,
											asc3 = 1;
										window.onload = function () {
											people = document.getElementById("people");
										}

										function sort_table(tbody, col, asc) {
											var rows = tbody.rows,
												rlen = rows.length,
												arr = new Array(),
												i, j, cells, clen;
											// fill the array with values from the table
											for (i = 0; i < rlen; i++) {
												cells = rows[i].cells;
												clen = cells.length;
												arr[i] = new Array();
												for (j = 0; j < clen; j++) {
													arr[i][j] = cells[j].innerHTML;
												}
											}
											// sort the array by the specified column number (col) and order (asc)
											arr.sort(function (a, b) {
												return (a[col] == b[col]) ? 0 : ((a[col] > b[col]) ? asc : -1 * asc);
											});
											// replace existing rows with new rows created from the sorted array
											for (i = 0; i < rlen; i++) {
												rows[i].innerHTML = "<td>" + arr[i].join("</td><td>") + "</td>";
											}
										}
									</script>
									<!--script>
										$(document).ready(function() {
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
								
									if(mysql_num_rows($result)>0) 
									{
								?>
                                <div class="box-body table-responsive">
								
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
												<th class="sort" onclick="sort_table(people, 1, asc2); asc2 *= -1; asc3 = 1; asc1 = 1;">Company Type</th>
												<th class="sort" onclick="sort_table(people, 1, asc2); asc2 *= -1; asc3 = 1; asc1 = 1;">Company Name</th>
												<th class="sort" onclick="sort_table(people, 0, asc1); asc1 *= -1; asc2 = 1; asc3 = 1;">Phone Number</th>
												<th class="sort" onclick="sort_table(people, 1, asc2); asc2 *= -1; asc3 = 1; asc1 = 1;">Email</th>
												<th class="sort" onclick="sort_table(people, 1, asc2); asc2 *= -1; asc3 = 1; asc1 = 1;">City</th>
												<th class="sort" onclick="sort_table(people, 1, asc2); asc2 *= -1; asc3 = 1; asc1 = 1;">Country</th>
												<th>Active</th>
												<th colspan="2">Action</th>  
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											while($details=mysql_fetch_array($result))
											{
										?>
                                            <tr>
												<td><?php echo $details['company_type']; ?></td>
												<td><?php echo $details['company_name']; ?></td>
												<td><?php echo $details['phone']; ?></td>
												<td><?php echo $details['contact_email']; ?></td>
												<td><?php echo $details['city']; ?></td>
												<td><?php echo $details['country']; ?></td>
												<td><?php if($details['status'] == 1) echo "Yes"; else echo "No"; ?></td>
												<td><a href="company.php?id=<?php echo $details['id']; ?>">View</a></td>
												<td><a href="editcompany.php?id=<?php echo $details['id']; ?>">Edit</a></td>
												<!--td><a href="javascript:delete_id(<?php echo $details['id']; ?>)">Delete</a></td-->
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
                               <!-- /.box-body -->
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
        <!-- DATA TABES SCRIPT >
        <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script-->
        
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>

        <!-- page script -->
        

    </body>
</html>