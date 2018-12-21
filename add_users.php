
		
	
               
			 
			 
			 
		

				
				<div class="tm-col col-12">
                    <div class="bg-white tm-block h-100">
					
					
					
					
					
					
					<?php require("dbconnect.php"); ?>
                        <h2 class="tm-block-title">Add <b class="fnt_bld fnt_clr_rd">Users</b></h2>
						             <form class="form-inline"  id="userinfo" method="POST" >
                                
                                   
                                     <div class="form-group">
                                          <input type="text" name="TXT_USER_NAME" class="form-control" placeholder="Enter User Name">
									</div>
                                 
								  <div class="form-group">
								  <!-- <label class="col-sm-2 control-label">City :</label>
                                      <div class="col-sm-10">
										   <select name="SEL_USER_CITY" id="SEL_USER_CITY" class="form-control m-bot15">
										   <option value="">- - Select - -</option>
                                               <?php
											/*	$query = "SELECT CITYID,CITYCODE,CITYDESCR,COUNTRYID FROM OMS_CITY WHERE STATUS = '0' " ;
												$compiled = oci_parse($db, $query);
												oci_execute($compiled);
												while($row=oci_fetch_array($compiled))
												{
												?>
															  <option value="<?php echo $row[0];?>"><?php echo $row[2];?></option>
														 
												<?php	  
												}//oci_close($db);
												*/?>
                                          </select>
									  </div>-->
								 </div>
								<div class="form-group">
								  <!--   <label class="col-sm-2 control-label">Country :</label>
                                      <div class="col-sm-10">
										  <select name="SEL_USER_COUNTRY" id="SEL_USER_COUNTRY" class="form-control m-bot15">
                                              <option value="">- - Select - -</option>
											  <?php
											/*	$query = "SELECT COUNTRYID,COUNTRYCODE,COUNTRYDESCR FROM OMS_COUNTRY WHERE STATUS = '0' " ;
												$compiled = oci_parse($db, $query);
												oci_execute($compiled);
												while($row=oci_fetch_array($compiled))
												{
												?>
												 <option value="<?php echo $row[0];?>"><?php echo $row[2];?></option>
												<?php	  
												}*/
												?>
                                          </select>
									  </div>-->
								</div>	  
								  <div class="form-group">
                                     
                                          <input type="text" name="TXT_USER_ADDRESS" class="form-control" placeholder="Enter Address">
                                      
                                  </div>
								  <div class="form-group">
                                     
                                          <input type="text" name="TXT_USER_LANDLINE" class="form-control" placeholder="Enter LandLine">
                                     
                                  </div>
								  <div class="form-group">
                                      
                                          <input type="text" class="form-control" name="TXT_USER_CELLNO" placeholder="Enter Cell Number">
                                     
                                  </div>
								  <div class="form-group">
                                      
                                          <input type="text" class="form-control" name="TXT_USER_EMAIL" placeholder="Enter Email ID">
                                     
                                  </div>
								   <div class="form-group">
                                     
                                          <input type="text" class="form-control" name="TXT_USER_PASS" placeholder="Enter Password">
                                     
                                  </div>
								  
								   <div class="form-group">
                                     
                                          <input type="text" class="form-control" name="TXT_USER_COMPANY" placeholder="Enter Company">
                                     
                                  </div>
								  
								  
								 <div class="form-group">
                                     
										   <select name="SEL_MIS_ID" id="SEL_MIS_ID" class="form-control m-bot15" style="padding: 0px 0px; ">
                                              <option value="">- - Select - -</option>
											  <option value="1">DCMS</option>
											  <option value="2">ECP</option>
											  <option value="3">Order Booking System</option>
											  <option value="4">Project Management</option>
											  <option selected="true"  value="5">Monthly Monitoring System</option>
											  <option value="6">Career Portal</option>
											  <option value="7">Monthly Monitoring Report</option>
											  <option value="8">Task Management System</option>
											  <option value="9">Other</option>
                                          </select>
									  
                                  </div>
								  
								  <div class="form-group">
                                     
										   <select name="SEL_ROLE" id="SEL_ROLE" class="form-control m-bot15" style="padding: 0px 0px; ">
                                              <option value="">- - Select - -</option>
											  <option value="A">Admin</option>
											  <option value="E">Editor</option>
											  <option value="U">User</option>
											  
                                          </select>
									  
                                  </div>
								  
								  
								   <!--<button type="submit"  class="btn btn-primary btn-lg btn-block">Submit</button>-->
								   <button type="button"  id="frmsub" class="btn btn-primary btn-lg btn-block">Submit</button>
							  </form>
					
					
					<br />
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
							<iframe id="ifrm1" src="tree/group_setting.php" style="overflow-y: hidden;" height="500px" width="100%" ></iframe>
					</div>
				</div>
			
					
					
					
					
					
					<script>
				
					
					$(function () {
						$('#frm_date').datepicker({
							dateFormat: 'dd-M-yy'
						});
					});
					
					$(function () {
						$('#t_date').datepicker({
							dateFormat: 'dd-M-yy'
						});
					});
					
					/*
					$(function () {
						$('#s_date').datepicker({
							changeMonth: true,
							changeYear: true,
							showButtonPanel: true,
							dateFormat: 'MM yy',
							onClose: function(dateText, inst) { 
								$(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
								$(".ui-datepicker-calendar").hide();
								$(".ui-datepicker-month").hide();
								$(".ui-datepicker-prev").hide();
								$(".ui-datepicker-next").hide();
								$(".ui-datepicker-current").hide();
								}
							
						});
						
						$("#s_date").focus(function () {
							$(".ui-datepicker-calendar").hide();
							//$(".ui-datepicker-month").hide();
							$(".ui-datepicker-prev").hide();
							$(".ui-datepicker-next").hide();
							$(".ui-datepicker-current").hide();
						});
						
					   $("#s_date").blur(function () {
							$(".ui-datepicker-calendar").hide();
							//$(".ui-datepicker-month").hide();
							$(".ui-datepicker-prev").hide();
							$(".ui-datepicker-next").hide();
							$(".ui-datepicker-current").hide();
						});
						
						var enforceModalFocusFn = $.fn.modal.Constructor.prototype.enforceFocus;
						$.fn.modal.Constructor.prototype.enforceFocus = function() {};
									
									
					});*/
					
					
					$('#sub_ad_prj').click(function(){
						//alert($('#ad_n_prj').serialize());
						//return false;
						$.ajax({
							type:	"GET",
							url:	"ad_nw_prj.php",
							data:	$('#ad_n_prj').serialize(),
							dataType: "JSON",
							success:function(data){
								//alert(data);
								alert(data.content);
								if(data.status == 'true')
								$('#ad_n_prj')[0].reset();
							}
							
						});
					});
					
					
				
					
					

$(document).ready(function() {
	
	$("#frmsub").unbind().click(function(e) {
		
	var datastring_0 = $('#userinfo').serialize();
	//alert(datastring_0);
	//return false;
	
    $.ajax({
            type: "POST",
			url: "add_user_process.php",
			 data: datastring_0,
           dataType: "JSON",
            success: function(data) {
				//alert(data);
				if(data.status == 'true'){
					
						alert(data.content);	
						//$('#coninfo')[0].reset();
						//$('#refreshdiv').load(add_user.php);
						location.reload();
					
				}else if(data.status == 'false'){
						
						alert(data.content);
					}
				
			}
			
		});
	   
	   e.preventDefault();
   });

});
</script>