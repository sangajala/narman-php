<?php
$title = 'All Users';
include 'header.php';

$supplier	= $q['supplier'];
$role	= $q['role'];
$isadmin	= $q['isadmin'];

if($q['adminaccess'] == 1) {

	$sql="SELECT * FROM register WHERE supplier='$supplier' && id != '$data' && role='$role'";

	$result= mysql_query($sql);

} if($q['isadmin'] == 1) {

	$sql	= "SELECT * FROM register ORDER BY id ASC";

	$result	= mysql_query($sql);

}

if(isset($_GET['delete_id'])) {

	 $sql_query="DELETE FROM register WHERE id=".$_GET['delete_id'];

	 mysql_query($sql_query);

	 header("Location: users.php");

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
								<?php
									
								?>
									<form name="search" method="post" action="" id="search">
										<div class="four">
											<input type="text" name="se_username" placeholder="Username">
										</div>
										<div class="four">
											<input type="email" name="se_email" placeholder="Email">
										</div>
										<div class="four">
											<select name="se_role" id="se_role">
												<option selected value="">Please select a role</option>
												<option value="Mother">Mother Company</option>
												<option value="Supplier">Supplier</option>
												<option value="Agent">Agent</option>
												<option value="Customer">Customer</option>
											</select>
										</div>
										<div class="clear"></div>
										<?php
										if($q['adminaccess'] == 1)
										{
											?>
												<div class="four">
												<input type="text" readonly name="se_supplier" value="<?php echo $supplier;?>">
												</div>
											<?php
										}
										else
										{
											$comp_query = mysql_query("SELECT `company_name` FROM `company` WHERE `status` = '1'");
											if(mysql_num_rows($comp_query) > 0)
											{
											?>
											<div class="four"><select class="select" name="se_company" id="se_company">
											<option selected value="">Please select a company</option>
											<?php
											while($comp=mysql_fetch_array($comp_query))
											{
											?>
												
												<option value="<?php echo $comp['company_name']; ?>"><?php echo $comp['company_name']; ?></option>
												<?php   
											}

											?>
											</select></div>
											<?php
											}
											else
											{
											?>
											<input type="text" readonly name="se_company" value="" placeholder="No Company found">

											<?php	
											}
										}
											?>
										<div class="four check">
											Admin Access <input type="checkbox" name="se_adminaccess" value="1">
										</div>
										<div class="four check">
											Active User <input type="checkbox" name="se_active" value="1">
										</div>
										<div class="full">
											<input class="button" type="submit" name="search" value="Search">
											<input class="button" type="reset" value="Reset">
										</div>
									</form>
									<?php  ?>
                                    <h3 class="box-title">All Users</h3>  
									<script type="text/javascript">
										function delete_id(id)
										{
											 if(confirm('Sure To Remove This Record ?'))
											 {
												window.location.href='users.php?delete_id='+id;
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
                                </div><!-- /.box-header -->
								<?php
								$nr = mysql_num_rows($result);
								if (isset($_GET['pn']))
								{ 
									$pn = preg_replace('#[^0-9]#i', '', $_GET['pn']); 
    
								} 
								else 
								{ 
									$pn = 1;
								} 
									$itemsPerPage = 8; 
									$lastPage = ceil($nr / $itemsPerPage);
								if ($pn < 1) 
								{ 
									$pn = 1; 
								}
								else if ($pn > $lastPage) 
								{ 
									$pn = $lastPage;
								} 
								$centerPages = "";
								$sub1 = $pn - 1;
								$sub2 = $pn - 2;
								$add1 = $pn + 1;
								$add2 = $pn + 2;
								if ($pn == 1) {
									$centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
									$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
								} else if ($pn == $lastPage) {
									$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
									$centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
								} else if ($pn > 2 && $pn < ($lastPage - 1)) {
									$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub2 . '">' . $sub2 . '</a> &nbsp;';
									$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
									$centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
									$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
									$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add2 . '">' . $add2 . '</a> &nbsp;';
								} else if ($pn > 1 && $pn < $lastPage) {
									$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
									$centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
									$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
								}
								$limit = 'LIMIT ' .($pn - 1) * $itemsPerPage .',' .$itemsPerPage; 
								
								foreach($_REQUEST as $key=>$value) {
										$$key	= is_array($value)? $value: trim($value);
									}
									$where	= array();
									if(!empty($se_username)) {
										$where[]	= "name LIKE '$se_username%'";
									}
									if(!empty($se_email)) {
										$where[]	= "email = '$se_email'";
									}
									if(!empty($se_role)) {
										$where[]	= "role = '$se_role'";
									}
									if(!empty($se_company)) {
										$where[]	= "company = '$se_company'";
									}
									if(!empty($se_supplier)) {
										$where[]	= "supplier = '$se_supplier'";
									}
									if(!empty($se_adminaccess)) {
										$where[]	= "adminaccess = '$se_adminaccess'";
									}
									if(!empty($se_active)) {
										$where[]	= "status = '$se_active'";
									}
									$_sql	= (count($where)>0)? " WHERE " . implode(" && ", $where): "";
									$_sqll	= (count($where)>0)? "&&" . implode(" && ", $where): "";
								if($q['adminaccess'] == 1)
								{
										
									$sql2 = mysql_query("SELECT * FROM register WHERE supplier='$supplier' && id != '$data' && role='$role' $_sqll ORDER BY id ASC $limit");
								}
								if($q['isadmin'] == 1)
								{
									
									$sql2 = mysql_query("SELECT * FROM register$_sql ORDER BY id ASC $limit");
								}
								$paginationDisplay = ""; 
								
								if ($lastPage != "1"){
									
									$paginationDisplay .= 'Page <strong>' . $pn . '</strong> of ' . $lastPage. '&nbsp;  &nbsp;  &nbsp; ';
									
									if ($pn != 1) {
										$previous = $pn - 1;
										$paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $previous . '"> Back</a> ';
									} 
									
									$paginationDisplay .= '<span class="paginationNumbers">' . $centerPages . '</span>';
									
									if ($pn != $lastPage) {
										$nextPage = $pn + 1;
										$paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $nextPage . '"> Next</a> ';
									} 
								}
								$c = mysql_num_rows($sql2);
									if(mysql_num_rows($sql2)>0) 
									{
										
								?>
								
                                <div class="box-body table-responsive">
								
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
												<th class="sort" onclick="sort_table(people, 0, asc1); asc1 *= -1; asc2 = 1; asc3 = 1;">Id</th>
												<th class="sort" onclick="sort_table(people, 1, asc2); asc2 *= -1; asc3 = 1; asc1 = 1;">Username</th>
												<th class="sort" onclick="sort_table(people, 1, asc2); asc2 *= -1; asc3 = 1; asc1 = 1;">Email</th>
												<th class="sort" onclick="sort_table(people, 1, asc2); asc2 *= -1; asc3 = 1; asc1 = 1;">Role</th>
												<th class="sort" onclick="sort_table(people, 1, asc2); asc2 *= -1; asc3 = 1; asc1 = 1;">Company</th>
												<th>Supplier</th>
												<th>Active</th>
												<th>Admin Access</th>
												<th colspan="3">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="people">
										<?php
										while($details=mysql_fetch_array($sql2))
											{
												
										?>
										  
                                            <tr>
											
												<td><?php echo $details['id']; ?></td>
												<td><?php echo $details['name']; ?></td>
												<td><?php echo $details['email']; ?></td>
												<td><?php echo $details['role']; ?></td>
												<td><?php echo $details['company']; ?></td>
												<td><?php echo $details['supplier']; ?></td>
												<td><?php if($details['status'] == 1) echo "Yes"; else echo "No"; ?></td>
												<td><?php if($details['adminaccess'] == 1) echo "Yes"; elseif($details['adminaccess'] == 2) echo "Pending"; else echo "No"; ?></td>
												<td><a href="user.php?id=<?php echo $details['id']; ?>">View</a></td>
												<td><a href="edit.php?id=<?php echo $details['id']; ?>">Edit</a></td>
												<td><a href="javascript:delete_id(<?php echo $details['id']; ?>)">Delete</a></td>
											</tr>
										<?php
											}	  

										?>
                                        </tbody>
                                        
                                    </table>
									<?php
									if($paginationDisplay !="")
									{
									?>
									<div class="paginationdiv"><?php echo $paginationDisplay; ?></div>
									<?php		
									} 
									}
									else 
									{
										echo $error	= "<div class='red'>No result found.</div>";
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
        <!--script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script-->
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <!--script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script-->
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>

        <!-- page script -->
        

    </body>
</html>