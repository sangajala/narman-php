<?php
$title='Add Order';
include 'header.php';
if($q['isadmin'] == 1)
{
	
if(isset($_POST['search']))
{
	$quality = $_POST['quality'];
	$query = mysql_query("SELECT * FROM quality WHERE quality = '$quality' ORDER BY id ASC") or die($query . mysql_error());
	$qt = mysql_fetch_array($query);
	$qq=$qt['quality'];
	
	if(mysql_num_rows($query) < 1)
	{
		$e_message='<div class="red">No matching found for quality</div>';
	}
		
}
$sql = mysql_query("SELECT name FROM register WHERE role='Agent' && status='1' ORDER BY id ASC") or die($sql . mysql_error());
$sql1 = mysql_query("SELECT name FROM register WHERE role='Supplier' && status='1' ORDER BY id ASC") or die($sql1 . mysql_error());
$query1 = mysql_query("SELECT name FROM component ORDER BY id ASC") or die($query1 . mysql_error());

if(isset($_POST['confirm']))
{
	
}

if(isset($_POST['order']))
{
	
	$quality = $_POST['se_quality'];
	$agent = $_POST['agent'];
	$supplier = $_POST['supplier'];
	$weight = $_POST['weight'];
	$width = $_POST['width'];
	$component = $_POST['component'];
	$construction = $_POST['construction'];
	$qualitycolor = $_POST['qualitycolor'];
	$color1 = $_POST['color'];
	$color = implode(",", $color1);
	$colordetail = $_POST['colordetail'];
	$price = $_POST['price'];
	$currency = $_POST['currency'];
	$quantity = $_POST['quantity'];
	$orderweight = $_POST['orderweight'];   
	$datepicker = $_POST['datepicker'];
	$term = $_POST['term'];
	$mode = $_POST['mode'];
	$address1 = $_POST['address1'];
	$address2 = $_POST['address2'];
	$customerref = $_POST['customerref'];
	$customer = $_POST['customer'];
	$customerdate = $_POST['customerdate'];
	$testing = $_POST['testing'];
	$tparameter1 = $_POST['tparameter'];
	$tparameter = implode(",", $tparameter1);
	$agentclarity = $_POST['agentclarity'];
	$comment = $_POST['comment'];
	$commission = $_POST['commission'];
	$filepremio1 = $_FILES['file']['name'];
	$filepremio = implode(",",$filepremio1);
	$care1 = $_POST['care'];
	$care = implode(",", $care1);
	$group = $_POST['group'];
	$trmcondition = $_POST['trmcondition'];
	
	$j = 0; //Variable for indexing uploaded image 
    
	$target_path = "upload/"; //Declaring Path for uploaded images
    for ($i = 0; $i < count($_FILES['file']['name']); $i++) {//loop to get individual element from the array

        $validextensions = array("jpeg", "jpg", "png");  //Extensions which are allowed
        $ext = basename($_FILES['file']['name'][$i]);//explode file name from dot(.) 
		$fileTmpLoc = $_FILES["file"]["tmp_name"][$i];
        //$file_extension = end($ext); //store extensions in the variable
        
		$target_path = "upload/" . $ext;//set the target path with a new name of image
        $j = $j + 1;//increment the number of uploaded images according to the files in array       
      
	 
            if (move_uploaded_file($fileTmpLoc, $target_path)) {//if file moved to uploads folder
                
            } else {//if file was not moved.
                  
            }
        
    }
	
	
	
	$insert=mysql_query("INSERT INTO `order` (`quality`, `agent`, `supplier`,`weight`, `width`, `fabric_type`, `construction`,  `qualitycolor`, `color`, `colordetail`, `price`, `currency`, `quantity`, `orderweight`, `datepicker`, `term`, `mode`, `address1`, `address2`, `customerref`, `customer`, `customerdate`, `testing`, `tparameter`, `agentclarity`, `comment`, `commission`,`symbol`, `care`, `group`, `trmcondition`) values ('$quality', '$agent', '$supplier', '$weight', '$width', '$component', '$construction', '$qualitycolor', '$color', '$colordetail', '$price', '$currency', '$quantity', '$orderweight', '$datepicker', '$term', '$mode', '$address1', '$address2', '$customerref', '$customer', '$customerdate', '$testing', '$tparameter', '$agentclarity', '$comment', '$commission', '$filepremio', '$care', '$group', '$trmcondition')") or die($sql1 . mysql_error());
	$success= "<div class='green'>Order Created successfully</div>";
}
} 
?>


            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
			<?php
			if($q['isadmin'] == 1)
			{
			?>
			<script>
				$(document).ready(function(){
					jQuery.validator.addMethod("lettersonly", function(value, element) {
				  return this.optional(element) || /^[a-z]+$/i.test(value);
				}, "Component name should be characters only");
								$('#search').validate({
									rules : {
										
										
										quality: {
											required: true,
											lettersonly: true,
											
										},
										
  	
									},
									messages: {
										quality : {
											required:"Please enter valid quality",
											lettersonly:"Quality must be characters"
										},
										
										
										},
								});
								});
							</script>
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Add Order
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
			
					<!--p><a class="change" href="componentlist.php">Back to list</a></p-->
					<div class="register_main_class">
						<div class="register_popup">
							<div class="header_tag">
								<h2>Create Order</h2>
							</div>
								<?php 
								echo $e_message;
								echo $success;
								?>
								<script>
				$(document).ready(function(){
					  $(".error_msge").hide();
					  
					jQuery.validator.addMethod("lettersonly", function(value, element) {
				  return this.optional(element) || /^[a-z]+$/i.test(value);
				}, "Component name should be characters only");
				
								$('#order').validate({
									
								invalidHandler: function(event, validator) {
            var errors = validator.numberOfInvalids();
			
			if (errors) {
              
            } else
			{
				alert("save");
			}
          }, 
       
	  ignore: "",
									rules : {
										supplier : {
											required: function () {
									   if ($("#supplier option[value='0']")) {
										   return true;
									   } else {
										   return false;
									   }
								   },
										},
										
										weight: {
											required: true,
											number: true,
											
										}, 
										width: {
											required: true,
											number: true,
											
										}, 
										component : {
											required: function () {
									   if ($("#component option[value='0']")) {
										   return true;
									   } else {
										   return false;
									   }
								   },
										},
										
										price: {
											required: true,
											
										},
										currency : {
											required: function () {
									   if ($("#currency option[value='0']")) {
										   return true;
									   } else {
										   return false;
									   }
								   },
										},
										quantity: {
											required: true,
											number: true,
											
										},
										orderweight: {
											required: true,
											number: true,
											
										},
										datepicker: {
											required: true,
											
										},
										mode : {
											required: function () {
									   if ($("#mode option[value='0']")) {
										   return true;
									   } else {
										   return false;
									   }
								   },
										},
										address1 : {
											required: function () {
									   if ($("#address1 option[value='0']")) {
										   return true;
									   } else {
										   return false;
									   }
								   },
										},
										commission: {
											number: true,
											
										},
										cnt: {
											required:true,
											range:[1,1000],
										}
								
  	
									},
									messages: {
										supplier : {
											required:"Please select a supplier"
										},
																				
										weight: {
											required: "Please enter valid weight",
											number: "Weight should be in digits",
											
										},
										width: {
											required: "Please enter valid width",
											number: "Width should be in digits",
											
										},
										component : {
											required:"Please select a component"
										},
										
										price: {
											required: "Please enter valid price",
											
										},
										currency: {
											required: "Please select a currency",
											
										},
										quantity: {
											required: "Please enter valid quantity",
											number: "Quantity should be in digits",
											
										},
										orderweight: {
											required: "Please enter valid order weight",
											number: "Order weight should be in digits",
											
										},
										datepicker: {
											required: "Please enter valid delivery date"
											
										},
										mode: {
											required: "Please select a delivery mode",
											
										},
										address1: {
											required: "Please select a delivery address",
											
										},
										commission: {
											number: "Commission should be numeric",
											
										},
										cnt: {
											required: "Preview the order",
											range: "Preview the order",
										},
										
										},
								});
								 $('#btn').click(function() {
										$("#order").valid();
										});
								});
							</script>	
								<script>
/*  jQuery ready function. Specify a function to execute when the DOM is fully loaded.  */
$(document).ready(
  
  /* This is the function that will get executed after the DOM is fully loaded */
  function () {
    $( "#datepicker" ).datepicker({
      changeMonth: true,//this option for allowing user to select month
      changeYear: true //this option for allowing user to select from year range
    });
  }

);
</script>
<script>
/*  jQuery ready function. Specify a function to execute when the DOM is fully loaded.  */
$(document).ready(
  
  /* This is the function that will get executed after the DOM is fully loaded */
  function () {
    $( "#customerdate" ).datepicker({
      changeMonth: true,//this option for allowing user to select month
      changeYear: true //this option for allowing user to select from year range
    });
  }

);
</script>
<script>
				$(document).ready(function() {
				  $('#tparameter').attr("disabled","disabled");
				  
				  $("[name='testing']").change(function() {
					var sel = $(this).val();
					if(sel == 'No') {
					  $('#tparameter').attr("disabled","disabled");
					} else if(sel == 'Yes') {
					  $('#tparameter').removeAttr("disabled");
					} 
					else if(sel == '') {
					  $('#tparameter').attr("disabled","disabled");
					}
				  });
				});
				</script> 
				<script>
				$(document).ready(function() {
				  $('#comment').attr("disabled","disabled");
				  $('#commission').attr("disabled","disabled");
				  $("[name='agentclarity']").change(function() {
					var sel = $(this).val();
					if(sel == 'Yes') {
						$('#comment').removeAttr("disabled");
					   $('#commission').removeAttr("disabled");
					 
					} else if(sel == 'No') {
					   $('#comment').attr("disabled","disabled");
					   $('#commission').attr("disabled","disabled");
					} 
					else if(sel == '') {
						
					  $('#comment').attr("disabled","disabled");
					  $('#commission').attr("disabled","disabled");
					}
				  });
				});
				</script> 
				<script>
				var abc = 0; //Declaring and defining global increement variable

$(document).ready(function() {

//To add new input file field dynamically, on click of "Add More Files" button below function will be executed
    $('#add_more').click(function() {
        $(this).before($("<div/>", {id: 'filediv'}).fadeIn('slow').append(
                $("<input/>", {name: 'file[]', type: 'file', id: 'file'}),        
                $("<br/><br/>")
                ));
    });

//following function will executes on change event of file input to select different file	
$('body').on('change', '#file', function(){
            if (this.files && this.files[0]) {
                 abc += 1; //increementing global variable by 1
				
				var z = abc - 1;
                var x = $(this).parent().find('#previewimg' + z).remove();
                $(this).before("<div id='abcd"+ abc +"' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");
               
			    var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
               
			    $(this).hide();
                $("#abcd"+ abc).append($("<img/>", {id: 'img', src: 'x.png', alt: 'delete'}).click(function() {
                $(this).parent().parent().remove();
                }));
            }
        });

//To preview image     
    function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
    };

    $('#upload').click(function(e) {
        var name = $(":file").val();
        if (!name)
        {
            alert("First Image Must Be Selected");
            e.preventDefault();
        }
    });
});
				</script>
				<script>
				document.getElementById('confirm').addEventListener('click', function(e){

  e.preventDefault();

  var form = document.forms['order']; //or this.parentNode

  //do stuff


}, true);
				</script>
<script>
$(document).ready(function () {
  var count = 0;

  $('#preview').click(function () {
    count += 1;
$(".cnt").attr("value",count);

    
  });
})();
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('.hasDatepicker').keypress(function(key) {
		alert("hello");
		if((key.charCode < 97 || key.charCode > 122) && (key.charCode < 65 || key.charCode > 90) && (key.charCode != 45)) return false;

    });
</script>

								<form action="" method="post" name="search" id="search">
									<div class="section_inner_ lrg">
										<div class="six">
											<input type="text" name="quality" value="" placeholder="Quality" id="country_id" onkeyup="autocomplet()">
											<ul id="country_list_id"></ul>
										</div>
										<div class="six">
											<input type="submit" name="search" value="Search" class="button">
										</div>
										<div class="clear"></div>
									</div>
								</form>
								<?php
								if(mysql_num_rows($query) > 0)
								{
								?>
									<form action="" method="post" name='order' id="order" enctype="multipart/form-data">
										<div class="section_inner_ lrg">
										<div class="input-group">
											<div class="drop_b">
											<input type="hidden" id="se_quality" name="se_quality" value="<?php echo $qq; ?>">
												<select class="select" name="agent" id="agent">
												
												<?php
												if(mysql_num_rows($sql) > 0)
												{
													
													echo '<option value="">Please select an agent</option>';
													while($rw=mysql_fetch_array($sql))
													{
														echo '<option value="'.$rw['name'].'">'.$rw['name'].'</option>';
													}
												}
												else
												{
													
													echo '<option value="">No active agent</option>';
												}
												?>
												</select>
											</div>
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk ffff"></i>
                                            </div>
											</div>
											
											<h4>Quality Details</h4> 

											<div class="input-group">
												<div class="drop_b">
													<select class="select" name="supplier" id="supplier">
													
													<?php
													if(mysql_num_rows($sql1) > 0)
													{
														
														?><option value="">Please select a supplier</option>
														<?php
														
														while($rw1=mysql_fetch_array($sql1))
														{
															$ss = $rw1['name'];
															?>
															
															<option value="<?php echo $rw1['name'];?>" <?php if($qt['supplier'] == $ss) echo 'selected="selected"'; ?>><?php echo $rw1['name']; ?></option>
															<?php
														}
													}
													else
													{
														
														echo '<option value="">No active supplier</option>';
													}
													?>
													</select>
												</div>
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk"></i>
                                            </div>
											</div>
											
											<div class="input-group">
												<input type="text" name="weight" id="weight" value="<?php echo $qt['weight']; ?>" placeholder="Weight in kgs">
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk"></i>
                                            </div>
											</div>
											
											<div class="input-group">
												<input type="text" name="width" id="width" value="<?php echo $qt['width']; ?>" placeholder="Width in mts">
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk"></i>
                                            </div>
											</div>
											
											<div class="input-group">
												<div class="drop_b">  
													<select name="component" id="component">
														<option value="">Please select a component</option>
														<?php
															if(mysql_num_rows($query1) > 0)
															{
															while($result1 = mysql_fetch_array($query1))
															{
																$fab = $result1['name'];
																?>
															<option value="<?php echo $result1['name']; ?>" <?php if($qt['fabric_type'] == $fab) echo 'selected="selected"'; ?>><?php echo $result1['name']; ?></option>
															<?php
															}
															}
															else
															{
																
															}
														?>
													</select>
												</div>
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk"></i>
                                            </div>
											</div>
											
											<div class="input-group">
												<textarea rows="4" cols="50" name="construction" id="construction" placeholder="Construction details"><?php echo $qt['constrution']; ?></textarea>
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk ffff"></i>
                                            </div>
											</div>
											
											<div class="input-group">
												<input type="text" name="qualitycolor" id="qualitycolor" value="" placeholder="Quality Color">
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk ffff"></i>
                                            </div>
											</div>
											
											
											<h4>Color Details</h4>

											<div class="input-group">
												<div class="drop_b">   
													 <input type="text" name="color[]" id="color1" class="colour" value="" placeholder="Add his own color">
													 <select name="color[]" multiple="multiple" id="color2" class="colour1">
													 <?php
													 
													 $comp	= explode(",", $qt['colour']);
													 
													 $clr = mysql_query("SELECT color FROM color_component ORDER BY id ASC")or die($clr . mysql_error());
													 while($rw2=mysql_fetch_array($clr))
													 {
														 $cl = $rw2['color'];
														 ?>
														 <option value="<?php echo $rw2['color']; ?>" <?php if(in_array($cl, $comp)) echo "selected"; ?>><?php echo $rw2['color']; ?></option>
														 <?php
													 }
													 ?>
													 
													 </select>
												</div>
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk"></i>
                                            </div>
											</div> 
											
											<div class="input-group">
												<input type="text" name="colordetail" id="colordetail" value="" placeholder="Color Details">
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk ffff"></i>
                                            </div>
											</div>
											
											<div class="input-group">
												<input type="text" name="price" id="price" value="" placeholder="Price">
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk"></i>
                                            </div>
											</div>
											
											<div class="input-group">
												<div class="drop_b">   
													 <select name="currency" id="currency">
														 <option value="">Please select a currency</option>
														 <option value="INR">INR</option>
														 <option value="DOLLER">DOLLAR</option>
													 </select>
												</div>
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk"></i>
                                            </div>
											</div>
											
											<div class="input-group">
												<input type="text" name="quantity" id="quantity" value="" placeholder="Quantity in mts">
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk"></i>
                                            </div>
											</div>
											
											<div class="input-group">
												<input type="text" name="orderweight" id="orderweight" value="" placeholder="Order Weight in Kgs">
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk"></i>
                                            </div>
											</div>
											
											<div class="input-group">
												<input type="text" name="datepicker" id="datepicker" class="datepicker" placeholder="Delivery date">
												<div class="input-group-addon">
                                                <i class="fa fa-asterisk"></i>
                                            </div>
											</div>
											<a href="" target="_blank"><input type="button" name="button" value="Add color of Fabric" class="button adclr"></a>
											
											<h4>Additional Details</h4>
											
											<div class="input-group">
												<div class="drop_b">   
													 <select name="term" id="term">
														 <option value="">Please select a Delivery term</option>
														 <option value="FOB">FOB</option>
														 <option value="FOB">FOB</option>
													 </select>
												</div>
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk ffff"></i>
                                            </div>
											</div>
											
											<div class="input-group">
												<div class="drop_b">   
													 <select name="mode" id="mode">
														 <option value="">Please select a Delivery mode</option>
														 <option value="Sea">Sea</option>
														 <option value="Sea">Sea</option>
													 </select>
												</div>
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk"></i>
                                            </div>
											</div>
											
											<div class="input-group">
												<div class="drop_b">   
													 <select name="address1" id="address1">
														 <option value="">Please select a Delivery address</option>
														 <option value="151 Lathom Road">151 Lathom Road</option>
														 <option value="151 Lathom Road">151 Lathom Road</option>
													 </select>
												</div>
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk"></i>
                                            </div>
											</div>
											
											<div class="input-group">
												<div class="drop_b">   
													 <select name="address2" id="address2">
														 <option value="">Please select a Delivery address</option>
														 <option value="Immediate 70 advance">Immediate 70 advance</option>
														 <option value="Immediate 70 advance">Immediate 70 advance</option>
													 </select>
												</div>
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk ffff"></i>
                                            </div>
											</div>
											
											<div class="input-group">
												<input type="text" name="customerref" id="customerref" placeholder="Customer Reference">
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk ffff"></i>
                                            </div>
											</div>
											
											<div class="input-group">
												<input type="text" name="customer" id="customer" placeholder="Customer">
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk ffff"></i>
                                            </div>
											</div>
											
											<div class="input-group">
												<input type="text" name="customerdate" id="customerdate" placeholder="Customer Reference date">
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk ffff"></i>
                                            </div>
											</div>
											
											<div class="input-group">
												<div class="drop_b">   
													 <select name="testing" id="testing">
														 <option value="">Testing</option>
														 <option value="Yes">Yes</option>
														 <option value="No">No</option>
													 </select>
												</div>
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk ffff"></i>
                                            </div>
											</div>
											
											<div class="input-group">
												<div class="drop_b">   
													 <select name="tparameter[]" id="tparameter" multiple="multiple">
														 <option value="Test">Test</option>
														 <option value="Test1">Test1</option>
														 <option value="Test2">Test2</option>
													 </select>
												</div>
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk ffff"></i>
                                            </div>
											</div>
											<div id="mypic">
											<div id="filediv"><input name="file[]" type="file" id="file"/></div>
											<input type="button" id="add_more" class="button" value="Add More Symbole"/>
											</div>
											<div class="input-group">
												<div class="drop_b">   
													 <select name="care" id="care" multiple="multiple">
														 <option value="Carewording">Carewording</option>
														 <option value="Carewording1">Carewording1</option>
														 <option value="Carewording2">Carewording2</option>
													 </select>
												</div>
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk ffff"></i>
                                            </div>
											</div>
											
											<div class="input-group">
												<div class="drop_b">   
													 <select name="agentclarity" id="agentclarity">
														 <option value="">Agent Clarified</option>
														 <option value="Yes">Yes</option>
														 <option value="No">No</option>
													 </select>
												</div>
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk ffff"></i>
                                            </div>
											</div>
											
											<div class="input-group">
												<textarea rows="4" cols="50" name="comment" id="comment" placeholder="Order Comment"></textarea>
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk ffff"></i>
                                            </div>
											</div>
											
											<div class="input-group">
												<input type="text" name="commission" id="commission" value="" placeholder="Agent commission">
											<div class="input-group-addon">
                                                <i class="fa fa-asterisk ffff"></i>
                                            </div>
											</div>
											
											<div class="clear"></div>
											<div class="six">
												<input class="button bb" type="reset" name="reset" value="Reset" >
											</div>
											<div class="six">
											<input class="button bb" type="button" name="confirm" id="btn" value="confirm" >
												<!--button class="button bb" name="confirm" id="confirm" data-toggle="modal" data-target="#myconfirm">Confirm</button-->
											</div>
											<div class="clear"></div>
											
											<div class="six">
											
												<div class="drop_b">   
													 <select name="group" id="group">
														 <option value="">Select a group</option>
														 <option value="Group1">Group1</option>
														 <option value="Group2">Group2</option>
													 </select>
												</div>
											
											
											</div>
											<div class="six">
											
												<div class="drop_b">   
													 <select name="trmcondition" id="trmcondition">
														 <option value="">Term & Condition</option>
														 <option value="I agree">I agree</option>
													 </select>
												</div>
											
											
											</div>
											<div class="six">
												<button class="button bb" name="grp" id="grp" data-toggle="modal" data-target="#mygrp">View Group</button>
											</div>
											<div class="modal fade" id="mygrp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" id="confirm" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" id="myModalLabel">GROUP A</h4>
														</div>
														<div class="modal-body">
															PURCHASE ORDER DATE 7/1/2015<br>
															LEADTIME 45<br>
															DELIVERY DATE 8/15/2015 45 DAYS FROM ORDER RECEIVED<br>
															FIRST COLOUR DUE 8/1/2015 14 DAYS BEFORE ETD DATE<br>
															DESIGN DUE 8/5/2015 4 DAYS AFTER FIRST BULK DATE<br>
															DOCS DUE 8/11/2015 3 DAYS BEFORE ETD DATE<br>
															PAYMENT DUE (DA 90 DAYS) 11/13/2015 90 DAYS AFTER ETD

														</div>
														<h4 class="modal-title" id="myM">GROUP B</h4>
														<div class="modal-body">
															PURCHASE ORDER DATE 7/1/2015<br>
															LEADTIME 45<br>
															DELIVERY DATE 8/15/2015 45 DAYS FROM ORDER RECEIVED<br>
															FIRST COLOUR DUE 8/1/2015 14 DAYS BEFORE ETD DATE<br>
															DESIGN DUE 8/5/2015 4 DAYS AFTER FIRST BULK DATE<br>
															DOCS DUE 8/11/2015 3 DAYS BEFORE ETD DATE<br>
															PAYMENT DUE (DA 90 DAYS) 11/13/2015 90 DAYS AFTER ETD

														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
															
														</div>
													</div>
												</div>
											</div>
											<div class="six">
												<button class="button bb" name="trm" id="trm" data-toggle="modal" data-target="#mytrm">View Term and Condition</button>
											</div>
											<div class="modal fade" id="mytrm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" id="confirm" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" id="myModalLabel">Term and Condition</h4>
														</div>
														<div class="modal-body">
														........
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
															
														</div>
													</div>
												</div>
											</div>
											<div class="clear"></div>
											<div class="six">
												<button class="button bb" name="preview" id="preview" data-toggle="modal" data-target="#myModal">Preview</button>
											</div>
											<div class="six">
											<input type="hidden" style="display:none;" class="cnt" value="" name="cnt" id="cnt">
												<input type="submit" name="order" value="Create Order" class="button bb" id="crtorder">
											</div>
											<div class="clear"></div>
											
											<div class="modal fade" id="myconfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" id="confirm" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" id="myModalLabel">Order is saved in Database</h4>
														</div>
														<div class="modal-body">
														</div>
													</div>
												</div>
											</div>
											
											<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" id="myModalLabel">Your Order</h4>
														</div>
														<div class="modal-body">
														<script>
														$(document).ready(function() {
															$('#preview').click(function() {
														var text = $('#order').find('input[name="se_quality"]').val();
														document.getElementById("pse_quality").innerHTML = text;
														
														var text = $('#order').find('#agent option:selected').val();
														document.getElementById("pagent").innerHTML = text;
														
														var text = $('#order').find('#supplier option:selected').val();
														document.getElementById("psupplier").innerHTML = text;
														
														var text = $('#order').find('input[name="weight"]').val();
														document.getElementById("pweight").innerHTML = text;
														
														var text = $('#order').find('input[name="width"]').val();
														document.getElementById("pwidth").innerHTML = text;
														
														var text = $('#order').find('#component option:selected').val();
														document.getElementById("pcomponent").innerHTML = text;
														
														var text = $('#order').find('textarea[name="construction"]').val();
														document.getElementById("pconstruction").innerHTML = text;
														
														var text = $('#order').find('input[name="qualitycolor"]').val();
														document.getElementById("pqualitycolor").innerHTML = text;
																												
														var text = $('#order').find('input[name="color[]"]').val();
														document.getElementById("pcolor").innerHTML = text;
														var foo = []; 
														$('#color2 :selected').each(function(i, selected){ 
														  foo[i] = $(selected).text(); 
														  document.getElementById("pcolor").innerHTML +=","+foo[i];
														});
														
														var text = $('#order').find('input[name="colordetail"]').val();
														document.getElementById("pcolordetail").innerHTML = text;
														
														var text = $('#order').find('input[name="price"]').val();
														document.getElementById("pprice").innerHTML = text;
														
														var text = $('#order').find('#currency option:selected').val();
														document.getElementById("pcurrency").innerHTML = text;
														
														var text = $('#order').find('input[name="quantity"]').val();
														document.getElementById("pquantity").innerHTML = text;
														
														var text = $('#order').find('input[name="orderweight"]').val();
														document.getElementById("porderweight").innerHTML = text;
														
														var text = $('#order').find('input[name="datepicker"]').val();
														document.getElementById("pdatepicker").innerHTML = text;
														
														var text = $('#order').find('#term option:selected').val();
														document.getElementById("pterm").innerHTML = text;
														
														var text = $('#order').find('#mode option:selected').val();
														document.getElementById("pmode").innerHTML = text;
														
														var text = $('#order').find('#address1 option:selected').val();
														document.getElementById("paddress1").innerHTML = text;
														
														var text = $('#order').find('#address2 option:selected').val();
														document.getElementById("paddress2").innerHTML = text;
														
														var text = $('#order').find('input[name="customerref"]').val();
														document.getElementById("pcustomerref").innerHTML = text;
														
														var text = $('#order').find('input[name="customer"]').val();
														document.getElementById("pcustomer").innerHTML = text;
														
														var text = $('#order').find('input[name="customerdate"]').val();
														document.getElementById("pcustomerdate").innerHTML = text;
														
														var text = $('#order').find('#testing option:selected').val();
														document.getElementById("ptesting").innerHTML = text;
														
														var foo1 = []; 
														$('#tparameter :selected').each(function(i, selected){ 
														  foo1[i] = $(selected).text(); 
														  document.getElementById("ptparameter").innerHTML +=","+foo1[i];
														});
														
														var foo2 = []; 
														$('#care :selected').each(function(i, selected){ 
														  foo2[i] = $(selected).text(); 
														  document.getElementById("pcare").innerHTML +=","+foo2[i];
														});
														
														var text = $('#order').find('#agentclarity option:selected').val();
														document.getElementById("pagentclarity").innerHTML = text;
														
														var text = $('#order').find('textarea[name="comment"]').val();
														document.getElementById("pcomment").innerHTML = text;
														
														var text = $('#order').find('input[name="commission"]').val();
														document.getElementById("pcommission").innerHTML = text;
														
														var text = $('#order').find('#group option:selected').val();
														document.getElementById("pgroup").innerHTML = text;
														
														var text = $('#order').find('#trmcondition option:selected').val();
														document.getElementById("ptrmcondition").innerHTML = text;
														
														
														var a = $('#mypic').html();
														var b = $('#pimg').html(a);


														
														});
														});
														</script>
														<div class="clear"></div>
														<div class="six">
														<label>Quality : </label>
														<span id="pse_quality"></span>
														</div>
														
														<div class="six">
														<label>Agent : </label>
														<span id="pagent"></span>
														</div>
														
														<div class="six">
														<label>Supplier : </label>
														<span id="psupplier"></span>
														</div>
														
														<div class="six">
														<label>Weight : </label>
														<span id="pweight"></span>
														</div>
														
														<div class="six">
														<label>Width : </label>
														<span id="pwidth"></span>
														</div>
														
														<div class="six">
														<label>Component : </label>
														<span id="pcomponent"></span>
														</div>
														
														<div class="six">
														<label>Construction : </label>
														<span id="pconstruction"></span>
														</div>
														
														<div class="six">
														<label>Quality color : </label>
														<span id="pqualitycolor"></span>
														</div>
														<div class="clear"></div>
														<h4>Color Details</h4>
														
														<div class="six">
														<label>Color : </label>
														<span id="pcolor"></span>
														</div>
														
														<div class="six">
														<label>Color Detail : </label>
														<span id="pcolordetail"></span>
														</div>
														
														<div class="six">
														<label>Price : </label>
														<span id="pprice"></span>
														</div>
														<div class="six">
														<label>Currency : </label>
														<span id="pcurrency"></span>
														</div>
														<div class="six">
														<label>Quantity : </label>
														<span id="pquantity"></span>
														</div>
														<div class="six">
														<label>Order Weight : </label>
														<span id="porderweight"></span>
														</div>
														<div class="six">
														<label>Delivery Date : </label>
														<span id="pdatepicker"></span>
														</div>
														<div class="clear"></div>
														<h4>Aditional Details</h4>
														
														<div class="six">
														<label>Delivery Term : </label>
														<span id="pterm"></span>
														</div>
														<div class="six">
														<label>Delivery Mode : </label>
														<span id="pmode"></span>
														</div>
														<div class="six">
														<label>Delivery Address : </label>
														<span id="paddress1"></span>
														</div>
														
														<div class="six">
														<label>Delivery Address : </label>
														<span id="paddress2"></span>
														</div>
														
														<div class="six">
														<label>Customer Reference : </label>
														<span id="pcustomerref"></span>
														</div>
														<div class="six">
														<label>Customer : </label>
														<span id="pcustomer"></span>
														</div>
														
														<div class="six">
														<label>Customer reference date : </label>
														<span id="pcustomerdate"></span>
														</div>
														
														<div class="six">
														<label>Testing : </label>
														<span id="ptesting"></span>
														</div>
														<div class="six">
														<label>Testing Parameter: </label>
														<span id="ptparameter"></span>
														</div>
														<div class="six">
														<label>Care Wording: </label>
														<span id="pcare"></span>
														</div>
														<div class="six">
														<label>Agent clarity: </label>
														<span id="pagentclarity"></span>
														</div>
														<div class="six">
														<label>Comment: </label>
														<span id="pcomment"></span>
														</div>
														<div class="six">
														<label>Commission: </label>
														<span id="pcommission"></span>
														</div>
														
														<div class="six">
														<label>Group: </label>
														<span id="pgroup"></span>
														</div>
														
														<div class="six">
														<label>Term and Condition: </label>
														<span id="ptrmcondition"></span>
														</div>
														<div class="six">
														<label>Image : </label>
														<span id="pimg"></span>
														</div>
														
														<div class="clear"></div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
															
														</div>
													</div>
												</div>
												
											</div>
											
										</div>  
									</form>
							<?php
								}
								
							?>
							<div class="footer_tag"><a href="orderlist.php">Cancel</a></div>
							
							
							
							
						</div>

					</div>
                    <!-- Small boxes (Stat box) -->   
                    <!-- /.box -->

                        </section><!-- right col -->
						<?php
			}
						?>
                    </div><!-- /.row (main row) -->

                </section>

				
		 

				<!-- /.content -->
            </aside><!-- /.right-side -->
			
        </div><!-- ./wrapper -->
		
        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        
        <!-- Bootstrap -->
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		
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
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" href="js/style.css" />

    </body>
</html>