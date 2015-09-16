<?php
$title='Add Quality';
include 'header.php';
if($q['isadmin'] == 1)
{
	$sql = mysql_query("SELECT name FROM register WHERE role='Supplier' && status='1' ORDER BY id ASC") or die($sql . mysql_error());
	$query = mysql_query("SELECT name FROM component ORDER BY id ASC") or die($sql . mysql_error());

if(isset($_POST['quality']))
{
	$supplier = $_POST['supplier'];
	$weight = $_POST['weight'];
	$quality = $_POST['quality_text'];
	$component = $_POST['component'];
	$width = $_POST['width'];
	$color = $_POST['color'];
	$colour = implode(",",$color);
	$constrution = $_POST['constrution'];
	$cloth1 = $_POST['cloth'];
	$cloth = implode(",", $cloth1);
	$percent1 = $_POST['percent'];
	$percent = implode(",", $percent1);
	$percent2 = array_sum($percent1);
	 if($percent2 == 100)
	 {
		 $sql1=mysql_query("INSERT INTO quality (`supplier`,`weight`, `quality`, `fabric_type`, `width`, `colour`,`constrution`, `cloth`, `percent`) values ('$supplier', '$weight', '$quality', '$component', '$width', '$colour', '$constrution', '$cloth', '$percent')") or die($sql1 . mysql_error());
	$success= "<div class='green'>Quality added successfully</div>";
	 }
	 else
	 {
		$e_message= "<div class='red'>Check your cloth component percent</div>"; 
	 }
	
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
								$('#quality').validate({
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
											range : [1,10000],
										}, 
										quality_text: {
											required: true,
											maxlength : 100,
										},
										component : {
											required: function () {
									   if ($("#component option[value='']")) {
										   return true;
									   } else {
										   return false;
									   }
								   },
										},
										
										width: {
											required: true,
											number: true,
											range : [1,10000],
										},
										
										'cloth[]' : {
											required: function () {
									   if ($("#cloth option[value='']")) {
										   return true;
									   } else {
										   return false;
									   }
								   },
										},
										'percent[]': {
											required: true,
											number: true,
											range : [1,100],
										},
										total: {
											required: true,
											range : [100,100],
										}
  	
									},
									messages: {
										supplier : {
											required:"Please select at least one Supplier"
										},
										weight: {
											required: "Please enter valid weight",
											number: "Weight should be in digits",
											range: "Please enter a valid number"
										},
										quality_text: {
											required: "Please enter valid Quality",
											maxlength: "Quality text should not more than 100"
										},
										component : {
											required:"Please select at least one component"
										},
										width: {
											required: "Please enter valid width",
											number: "Width should be in digits",
											range: "Please enter a valid width"
										},
										
										'color[]' : {
											require_from_group:"Please select at least one colour"
										},
										component : {
											required:"Please enter valid component"
										},
										'cloth[]' : {
											required:"Please select at least one cloth component"
										},
										'percent[]' : {
											required:"Please enter valid number",
											number:"Please enter valid number",
											range:"Number not in range"
										},
										total : {
											required:"Please enter valid number",
											range:"Number not in range"
										},
										},
								});
								});
							</script>
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Add Quality
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
			
					<!--p><a class="change" href="componentlist.php">Back to list</a></p-->
					<div class="register_main_class">
						<div class="register_popup">
							<div class="header_tag">
								<h2>Create Quality</h2>
							</div>
								<?php 
								echo $e_message;
								echo $success;
									
								?>
							<form action="" method="post" name='quality' id="quality">
								<div class="section_inner_ lrg">
									
									<div class="input-group">
									<div class="drop_b">
										<select name="supplier" id="supplier">
											<option value="">Please select a supplier</option>
											<?php
												if(mysql_num_rows($sql) > 0)
												{
												while($result = mysql_fetch_array($sql))
												{
												echo '<option value="'.$result['name'].'">'.$result['name'].'</option>';
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
										<input type="text" name="weight" id="weight" value="" placeholder="Weight in gms">
									<div class="input-group-addon">
                                        <i class="fa fa-asterisk"></i>
                                    </div>
									</div>
									
									<div class="input-group">
									<input type="text" name="quality_text" id="quality_text" value="" placeholder="Quality">
									<div class="input-group-addon">
                                        <i class="fa fa-asterisk"></i>
                                    </div>
									</div>
									
									<div class="input-group">
									<div class="drop_b">  
										<select name="component" id="component">
											<option value="">Please select a component</option>
											<?php
												if(mysql_num_rows($query) > 0)
												{
												while($result1 = mysql_fetch_array($query))
												{
												echo '<option value="'.$result1['name'].'">'.$result1['name'].'</option>';
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
									 <input type="text" name="width" id="width" value="" placeholder="Width in mts">
									 <div class="input-group-addon">
                                        <i class="fa fa-asterisk"></i>
                                    </div>
									</div>
									
									<div class="input-group">
									 <div class="drop_b">   
										 <input type="text" name="color[]" id="color1" class="colour" value="" placeholder="Add his own color">
										 <select name="color[]" multiple="multiple" id="color2" class="colour1">
										 <?php
										 $clr = mysql_query("SELECT color FROM color_component ORDER BY id ASC")or die($clr . mysql_error());
										 while($rw=mysql_fetch_array($clr))
										 {
											 ?>
											 <option value="<?php echo $rw['color']; ?>"><?php echo $rw['color']; ?></option>
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
									<textarea rows="4" cols="50" name="constrution" id="constrution" placeholder="Constrution details"></textarea> 
									<div class="input-group-addon">
                                        <i class="fa fa-asterisk ffff"></i>
                                    </div>
									</div>
									
									<h2 style="text-align:center;">Quality Composition</h2>
									<div class="six" id="six">
									<div class="drop_b">   
										 
										 <select name="cloth[]" id="cloth">
										 <option value="">Please select a cloth component</option>
										 <option value="Cotton">Cotton</option>
										 <option value="Silk">Silk</option>
										 <option value="Jeans">Jeans</option>
										 <option value="Whool">Whool</option>
										 </select>
										 
									 </div>
									 </div>
									 <div class="section">
									 <div class="six" id="six">
									 <input type="text" class="qty1" name="percent[]" id="percent" value="" placeholder="Percent(%)">
									 </div>
									 <div class="clear"></div>
									 <div id="buildyourform">
    
									 </div>
									 <div id="build">
    
									 </div>
									 <input type="text" id="total" name="total" class="total" value="" />
									
									 </div>
									 <div class="six"></div>
									 <div class="six">
									 <input type="button" value="Add Cloth" class="add button" id="add" name="add" />
									 
									 </div>
									
									<div class="clear"></div>
									<div class="six">
										<input class="button" type="reset" name="reset" value="Reset" />
									</div>
									<div class="six">
										<input class="button" type="submit" name="quality" value="Save" />
									</div>
									<div class="clear"></div>
								</div>  
							</form>
							<div class="footer_tag"><a href="componentlist.php">Cancel</a></div>
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
<script>
$(document).on("change", ".qty1", function() {
    var sum = 0;
    $(".qty1").each(function(){
        sum += +$(this).val();
    });
    $(".total").attr("value",sum);
	});
</script>
				<script>

				$(document).ready(function() {
    $("#add").click(function() {
		var tt = document.getElementById('total').value ;
		
		if (tt > 100)
		{
			alert("Enter valid number")
		}
		
		else if (tt < 100)
		{
			var intId = $("#buildyourform div").length + 1;
        var fieldWrapper = $("<div class=\"fieldwrapper\" id=\"field" + intId + "\"/>");
        var fName = $("<div class=\"six\" id=\"six\"><input type=\"text\" class='qty1' name='percent[]' id=\"percent\" placeholder=\"Percent(%)\"/></div>");
        var fType = $("<div class=\"six\" id=\"six\"><div class=\"drop_b\"><select class=\"fieldtype\" name=\"cloth[]\" id=\"cloth\"><option value=\"\">Please select a cloth component</option><option value=\"Cotton\">Cotton</option><option value=\"Silk\">Silk</option><option value=\"Jeans\">Jeans</option><option value=\"Whool\">Whool</option></select></div></div>");
        var removeButton = $("<input type=\"button\" class=\"remove button\" value=\"Remove\" />");
        removeButton.click(function() {
            $(this).parent().remove();
        });
		fieldWrapper.append(fType);   
        fieldWrapper.append(fName);
        fieldWrapper.append(removeButton);
        $("#buildyourform").append(fieldWrapper);
		}
		
	else{
        
		alert("Equal");
	}
    });
	
    $("#preview").click(function() {
        $("#yourform").remove();
        var fieldSet = $("");
        $("#buildyourform div").each(function() {
            var id = "input" + $(this).attr("id").replace("field","");
            var label = $("<label for=\"" + id + "\">" + $(this).find("input.fieldname").first().val() + "</label>");
            var input;
            switch ($(this).find("select.fieldtype").first().val()) {
                case "checkbox":
                    input = $("<input type=\"checkbox\" id=\"" + id + "\" name=\"" + id + "\" />");
                    break;
                case "textbox":
                    input = $("<input type=\"text\" id=\"" + id + "\" name=\"" + id + "\" />");
                    break;
                case "textarea":
                    input = $("<textarea id=\"" + id + "\" name=\"" + id + "\" ></textarea>");
                    break;    
            }
            fieldSet.append(label);
            fieldSet.append(input);
        });
        $("body").append(fieldSet);
    });
});

		</script>
		 

				<!-- /.content -->
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