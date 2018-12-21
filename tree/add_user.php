<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ( !isset($_SESSION['user'])) {
	//you are already logged in
  header("Location: index.php");
  exit;
 }
 
// include("page_access.php");
?>
<html>
<title>SMS-GW Grouping</title>

<body>	

<div id="wrapper">         
<div id="page-wrapper">

 



<div class="container-fluid">		 
 <div id="refreshdiv" class="row">

						<?php require("dbconnect.php"); ?>
			<div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
					      <div class="panel-body">
                               <form class="form-horizontal"  id="userinfo" method="POST" >
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">User Name :</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="TXT_USER_NAME" class="form-control" placeholder="Enter User Name">
                                      </div>
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
                                      <label class="col-sm-2 control-label">Address :</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="TXT_USER_ADDRESS" class="form-control" placeholder="Enter Address">
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">LandLine :</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="TXT_USER_LANDLINE" class="form-control" placeholder="Enter LandLine">
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Cell # :</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" name="TXT_USER_CELLNO" placeholder="Enter Cell Number">
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Email :</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" name="TXT_USER_EMAIL" placeholder="Enter Email ID">
                                      </div>
                                  </div>
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Pass :</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" name="TXT_USER_PASS" placeholder="Enter Password">
                                      </div>
                                  </div>
								  
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Company :</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" name="TXT_USER_COMPANY" placeholder="Enter Company">
                                      </div>
                                  </div>
								  
								  
								 <div class="form-group">
                                      <label class="col-sm-2 control-label">Project User :</label>
                                       <div class="col-sm-10">
										   <select name="SEL_MIS_ID" id="SEL_MIS_ID" class="form-control m-bot15">
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
                                  </div>
								  
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">User Role :</label>
                                       <div class="col-sm-10">
										   <select name="SEL_ROLE" id="SEL_ROLE" class="form-control m-bot15">
                                              <option value="">- - Select - -</option>
											  <option value="A">Admin</option>
											  <option value="E">Editor</option>
											  <option value="U">User</option>
											  
                                          </select>
									  </div>
                                  </div>
								  
								  
								   <!--<button type="submit"  class="btn btn-primary btn-lg btn-block">Submit</button>-->
								   <button type="button"  id="frmsub" class="btn btn-primary btn-lg btn-block">Submit</button>
							  </form>
                          </div>
                      </section>
					</div>
				</div>
         

				
<?php
/*
$query = "SELECT USER_ID,USER_NAME,ci.CITYDESCR,co.COUNTRYDESCR,USER_ADDRESS,USER_LANDLINE,USER_CELLNO,USER_COMPANY,STATUS_ID,USER_EMAIL,USER_PASS,MIS_ID,ROLE FROM CFG_USERS u LEFT JOIN OMS_CITY ci ON u.USER_CITY = ci.cityid LEFT JOIN OMS_COUNTRY co ON u.USER_COUNTRY = co.COUNTRYID WHERE STATUS_ID = '1'   ORDER BY USER_ID DESC";
$stmt = oci_parse($db, $query);
if (!is_null($stmt))
{
oci_execute($stmt);
echo '<div id="form-group input-group" class="form-group input-group"><input type="text" class="form-control"><span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></span></div>';
echo "<div style='overflow-y:scroll;min-height:150px;'><table class='table table-bordered table-hover table-striped' width='100%' border='1'>";
echo "<th>Sr #</th>";
echo "<th>User Name</th>";
echo "<th>City</th>";
echo "<th>Country</th>";
echo "<th>Address</th>";
echo "<th>LandLine</th>";
echo "<th>Cell No</th>";
echo "<th>Company</th>";
echo "<th>Status</th>";
echo "<th>Email</th>";
echo "<th>Pass</th>";
echo "<th>Project</th>";
echo "<th>Role</th>";

while($row=oci_fetch_array($stmt))
{
echo "<tr>";
echo '<td>'.$row[0].'</td>';
echo "<td>".$row[1]."</td>";
echo "<td>".$row[2]."</td>";
echo "<td>".$row[3]."</td>";
echo "<td>".$row[4]."</td>";
echo "<td>".$row[5]."</td>";
echo "<td>".$row[6]."</td>";
echo "<td>".$row[7]."</td>";
echo "<td>".$row[8]."</td>";
echo "<td>".$row[9]."</td>";
echo "<td>".$row[10]."</td>";
echo "<td>".$row[11]."</td>";
echo "<td>".$row[12]."</td>";
echo "</tr>";
}
echo "</table></div>";

}	*/						  
oci_close($db);



 ?>
	
</div>
</div>
</div>
</div>
</body>   
	
<script>
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
</html>
	



	


