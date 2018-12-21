<?php
//echo $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ( !isset($_SESSION['user'])) {
	//you are already logged in
  header("Location: login.php");
  exit;
 }

// include("page_access.php");
?>
	<html>
	<title>TreeView</title>

	<head>


	<link rel="stylesheet" href="dist/bootstrap.min.css">
	<script type="text/javascript" charset="utf8" src="dist/jquery-1.8.2.min.js"></script>
		<link rel="stylesheet" href="dist/style.min.css" />
		<script src="dist/jquery-2.2.4.js"></script>
		<script src="dist/_jstree.min.js"></script>
		<style>
		#formcon{font-size:1.2em;}
			#formcon label {
				width: 200px;
				text-align: left;
			}

			#formcon input,	#formcon select {
				/* width: 1200px; */
				
			}

			.form-group {
				border-bottom: 1px solid gray;
				padding-bottom: 3px !important;
				margin-bottom: 3px !important;
			}

			.form-control{
				height: 30px !important;
				padding: 0px 5px !important;
				font-size:1.1em;
			}
			#btnsub{
				background-color:#00a8c2;
				color:white;
				font-weight:bold;font-size:1.1em;
			}
		</style>

		<script type="text/javascript">
			function fieldset_check() {

				var chk = document.getElementById("checklist").checked;
				//alert(chk);
				if (chk == true) {
					//alert("c");
					document.getElementById("Fieldset_Radio").disabled = false;
				} else {
					//alert("b");
					document.getElementById("Fieldset_Radio").disabled = true;
				}
			}

			function myFunction() {
				var tree_ids = $('#tree-container').jstree("get_selected");
				$('#print_selected_rows').html(tree_ids);
				// var m = $('#tree-container').jstree("get_checked");
				//$('#print_selected_rows').html(JSON.stringify(tree_ids)); //JSON.stringify will convert var n in JSON format
				//var dataa = 'id'+$('#print_selected_rows').text(tree_ids);
				$('#jsondata').val(JSON.stringify(tree_ids));
				//$("#jsondata").exitval(JSON.stringify(tree_ids));
				// alert(dataa);
				// $.ajax({
				// type:"POST",
				// url:"show_contact.php",
				// //data:'id'+tree_ids+',',
				// data:'id'+$('#print_selected_rows').html(tree_ids), 
				// success:function(data)
				// {$('#print_selected_rows').append(data);}
				// });
			}



			$(document).ready(function () {
				$('.chk_box').prop("checked", true);

				$('#grp_chk_con').click(function () {
					$('.chk_box').prop("checked", true);
				});
				$('#grp_chk_con1').click(function () {
					$('.chk_box').prop("checked", false);
				});


				$('#formsms').submit(function (e) {

					if ($('#checklist').is(':checked')) {
						//alert("CHECKED");
						var chkval = 1;
					} else {
						//alert("UNCHECKED");
						var chkval = 0;
					}

					var formdata = $(this).serialize();
					var datastring = 'chkval=' + chkval + '&' + formdata;
					//alert(datastring);
					if (confirm('Are you sure you want to send SMS?')) {

						// AJAX code to send data to php file.
						$.ajax({
							type: "GET",
							url: "sms_send.php",
							data: datastring,
							dataType: "JSON",
							success: function (data) {
								//alert(data);

								if (data.status == 'true') {
									//alert(data.Content);
								} else if (data.status == 'false') {
									//alert(data.Content);
								}
							}
						});
					} else {
						//Do Not Send SMS
					}

					e.preventDefault();
				});


			});
		</script>
	</head>


	<body>

		<div id="wrapper">
			<!--<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>

				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<?php //include("sms_menu.php"); ?>
				</div>

			</nav>-->


			<div id="page-wrapper">
				<!-- YOUR CONTENT GOES HERE -->
				<div class="container-fluid" style="min-height:97%;">
					<div class="row">
						<div class="col-lg-6">

							<h4>Admin Panel</h4>
							<button type="button" class="btn btn-default" id="sel_all">Select All</button>
							<button type="button" class="btn btn-default"  id="dsel_all">DeSelect All</button>
			<br><br>
			
				<div id="tree-container">
				</div>
						
				
						
				</div>
					<div class = "col-lg-6">
					<br><br><br>
					<form class="form-horizontal" method="post" id="formcon">
					<div class="form-group ">
							<label class="control-label col-sm-2"  for="usr_nme">User Name :</label>
							<div class="col-sm-8">
							<select class="form-control" name="usr_nme" id="usr_nme">
								<option value="">Select One</option>
								<?php
									$query = "SELECT USER_ID,USER_NAME  FROM MMR_USERS WHERE STATUS_ID = 1 ORDER BY USER_NAME ASC";
								require("dbconnect.php");
								try {
										
										$stmt = oci_parse($db, $query);
										//echo $stmt; exit();
										if (!is_null($stmt))
										{
										oci_execute($stmt);
		
								
									while($row=oci_fetch_array($stmt))
										{
											
										if(isset($_POST['sub_edt'])) //For Update
										{	
											/* if($row['EMP_STATUS'] == $emap_sts)
												echo '<option value="'.$row['EMP_STATUS'].'" selected="selected">'.$row['EMP_STATUS'].'</option>';
											else
												echo '<option value="'.$row['EMP_STATUS'].'">'.$row['EMP_STATUS'].'</option>'; */
											
										}											
										else
									echo '<option value="'.$row['USER_ID'].'">'.$row['USER_NAME'].'</option>';	
										
											}
										
										}
									else
										{	//print "\$stmt is [$stmt]&lt;br /&gt;";
												;	
											}
								}
																
								catch (PDOException $ex) {
										//die("Failed to run query: " . $ex->getMessage());
										}
								
								oci_free_statement($stmt);
								//oci_close($db);
								?>
							</select>
							</div>
						</div>
						<div class="form-group ">
							<label class="control-label col-sm-2"  for="jsondata">Selected Nodes :</label>
							<div class="col-sm-8">
							<input type="text" class="form-control" id="jsondata" name="jsondata" readonly value="<?php if(isset($_POST['sub_edt'])) ; ?>"
							style="cursor: text;">
							</div>
						</div>
						
						<div class="form-group " >
							<label class="control-label col-sm-2" for="scvtyp">Select Role Type</label>
							<div class="col-sm-8">
								<label class="radio-inline" style="color: red; width: auto;"><input type="radio" name="optradio" value="Admin">Admin</label>
								<label class="radio-inline" style="width: auto;"><input type="radio" name="optradio" value="Edit">Editor</label>
								<label class="radio-inline" style="width: auto;"><input type="radio" name="optradio" checked="checked" value="User">User</label>
							</div>
						</div>
						<!--<div class="form-group" style="background-color:#e8fbff; text-align:center; font-weight:bold;">Pages</div>-->
						<?php
							/*		$query = "SELECT MENU_ID,MENU_TITLE,MENU_URL FROM CFG_MENU_ITEMS ORDER BY MENU_ID ASC";
								require_once("dbconnect.php");
								try {
										
										$stmt = oci_parse($db, $query);
										//echo $stmt; exit();
										if (!is_null($stmt))
										{
										oci_execute($stmt);
		
								
									while($row=oci_fetch_array($stmt))
										{	?>
											
							<div class="form-group " >
							<label class="control-label col-sm-2" for="scvtyp"><?php echo $row['MENU_TITLE']; ?></label>
							<div class="col-sm-8"><label style="background-color:#f5f3ef; height: 25px; width: -webkit-fill-available; font-family:monospace; font-weight:normal;">
								<input type="checkbox" name="mnu_pgs[]" style="margin-top:10px; margin-left: 10px;" value="<?php echo $row['MENU_ID']; ?>">
								<?php echo $row['MENU_URL']; ?>
							</label></div>
						</div>
										
										<?php	}
										
										}
									else
										{	//print "\$stmt is [$stmt]&lt;br /&gt;";
												;	
											}
								}
																
								catch (PDOException $ex) {
										//die("Failed to run query: " . $ex->getMessage());
										}
								
								oci_free_statement($stmt);
								oci_close($db);
								*/?>
						
						
						<div class="form-group ">
							<label class="control-label col-sm-2"  for="subitm"></label>
							<div class="col-sm-8">
							<?php if(isset($_POST['sub_edt'])) { ?>
								<input type="button" class="btn form-control" id="btnsub" value="Update" id="subitm" name="subitm">
							<?php } else { ?>
								<input type="button" class="btn form-control" id="btnsub" value="Submit" id="subitm" name="subitm">
							<?php }  ?>
						</div>
						</div>
						
							
			<?php /*		<input id="jsondata" type="text" name="getlist" value="" size="100">
					
					<button type="button " class="btn btn-sm " onclick="myFunction(); " name="btnadd " id="btnadd ">Get Selected IDs [if AutoFill dont Work]</button>
					*/ ?>
					</form>
					</div>
				</div>		
		 </div>
		</div>
	
</div> 

	
	<div id="qwerty"></div>


</body>

</html>



<script type="text/javascript">
    $(document).ready(function() {
        //fill data to tree  with AJAX call
        $('#tree-container').jstree({
            'plugins': ["wholerow", "checkbox"],
            'core': {
                'data': {
                    "url": "treeview_adm.php",
                    "plugins": ["wholerow", "checkbox"],
                    "dataType": "json" // needed only if you do not supply JSON headers
                }
            },
			"checkbox" : {
			"three_state" : false,
			},
        }).on('ready.jstree', function() {
				$('#tree-container').jstree('open_all');
				$('#jsondata').val(JSON.stringify($('#tree-container').jstree("get_selected"))); 
		});
		
	
		
		/* $('#tree-container').on('ready.jstree', function() {
				$('#tree-container').jstree('open_all');
		}); */
		Array.prototype.compare = function(testArr) {
					if (this.length != testArr.length) return false;
					for (var i = 0; i < testArr.length; i++) {
						if (this[i].compare) { //To test values in nested arrays
							if (!this[i].compare(testArr[i])) return false;
						}
						else if (this[i] !== testArr[i]) return false;
					}
					return true;
				}
				
		
		 $('#sel_all').bind('click', function() {
             $('#tree-container').jstree("select_all");
			 $('#jsondata').val(JSON.stringify($('#tree-container').jstree("get_selected")));
				var get_sel_ids = JSON.parse(JSON.stringify($('#tree-container').jstree("get_selected")));
				var idList = [];
					var jsonNodes = $('#tree-container').jstree(true).get_json('#', { flat: true });
					$.each(jsonNodes, function (i, val) {
						idList.push($(val).attr('id'));
					})
					//alert(JSON.stringify(idList));
					if(idList.sort().compare(get_sel_ids.sort())) {
						//alert("Match");
						$('#jsondata').val('["999"]');
					} else {
						//alert("no Match");
					}
            });
          
		  $('#dsel_all').bind('click', function(){
               $('#tree-container').jstree("deselect_all");
				$('#jsondata').val(JSON.stringify($('#tree-container').jstree("get_selected")));     
            });
			
					
			$("#tree-container").on("select_node.jstree", function(){
				$('#jsondata').val(JSON.stringify($('#tree-container').jstree("get_selected")));
				var get_sel_ids = JSON.parse(JSON.stringify($('#tree-container').jstree("get_selected")));
				var idList = [];
					var jsonNodes = $('#tree-container').jstree(true).get_json('#', { flat: true });
					$.each(jsonNodes, function (i, val) {
						idList.push($(val).attr('id'));
					})
					//alert(JSON.stringify(idList));
					if(idList.sort().compare(get_sel_ids.sort())) {
						//alert("Match");
						$('#jsondata').val('["999"]');
					} else {
						//alert("no Match");
					}
			});
			
			$("#tree-container").on("deselect_node.jstree", function(){
				$('#jsondata').val(JSON.stringify($('#tree-container').jstree("get_selected")));            
			});

			$('#btnsub').unbind().click(function(e){
				var dta = $('#formcon').serialize();
				if( $('#usr_nme').val() == "")
			  {
				  alert("Select User");
				  return;
			  }
				//console.log(dta);
				//return;
			$.ajax({
				type: "POST",
				url: "db_group_setting.php",
				data: dta,
				dataType: "JSON",
				success: function(data) {
					//alert(data);
					if(data.status == 'true'){
						alert(data.content);
						
					}else if(data.status == 'false'){
						alert(data.content);
						}
				
				
					}
				});
				
			});
			
			$('#usr_nme').on('change', function() {
			  //alert( this.value );
			  var dta = this.value;
			  		  
			  $.ajax({
				type: "POST",
				url: "get_usr_rhts.php",
				data: 'usr=' + dta,
				dataType: "JSON",
				success: function(data) {
					//alert(data);
					//alert(data.status);
					if(data.status == 'true'){
						var usr_obj = [];
						//var usr_mnu = [];			/*comment later*/
						$('#jsondata').val(data.arr_d);
						$("input[name=optradio][value='" + data.usr_typ +"']").prop("checked",true); //user type
						//console.log(data.arr_d);
						usr_obj = JSON.parse(data.arr_d);
						$('#tree-container').jstree("deselect_all");   
						if(usr_obj[0] == 999)
							$('#tree-container').jstree("select_all");
						else{
						for (i = 0; i < usr_obj.length; i++) { 
							//alert(usr_obj[i]);
							//console.log(usr_obj[i]);
							$('#tree-container').jstree('select_node', usr_obj[i]);
							}
						}
						//usr_mnu = JSON.parse(data.usr_mnu_rts);
						//$("input[name=mnu_pgs\\[\\]]").prop("checked",false); 
						//for (i = 0; i < usr_mnu.length; i++) {
								//alert(usr_mnu[i]);
						//	$("input[name=mnu_pgs\\[\\]][value='" + usr_mnu[i] +"']").prop("checked",true); 
						//	}
						
						
					}else if(data.status == 'false'){
						alert(data.content);
						} 
				
				
					}
				});
			})
			
				
	});
	
</script>