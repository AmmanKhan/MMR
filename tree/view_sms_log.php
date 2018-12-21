<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ( !isset($_SESSION['user'])) {
	//you are already logged in
  header("Location: index.php");
  exit;
 }
 include("page_access.php");
?>
<html>
<title>SMS-GW Grouping</title>
<head>
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dist/bootstrap.min.css">
    <script type="text/javascript" charset="utf8" src="dist/jquery-1.8.2.min.js"></script>
    
	<link rel="stylesheet" href="dist/style.min.css" />
    <script src="dist/jquery-2.2.4.js"></script>
    <script src="dist/_jstree.min.js"></script>
	<link href="css/sb-admin.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>	

<div id="wrapper">         
<div id="page-wrapper">
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				
                <a class="navbar-brand" href="#">Communication & Alerts</a>
            </div>
			<div style="float:right;color:white;padding-right:10px;"><dt>You are Logged in as:</dt>
			<kbd>
			<?php echo($_SESSION['user']); ?>
			</kbd>&nbsp
			
			
			
			<button type="submit" class="btn btn-danger btn-xs" id="sublg" name="sublg" onclick="window.location.href = 'sms_LgOut.php'; ">
			<span class="glyphicon glyphicon-log-out" aria-hidden="true" ><span style="font-family: Menlo,Monaco,Consolas,\"Courier New\",monospace; ">&nbsp LogOut &nbsp</span></span>
			</button>
			</div>
			
			<div class="collapse navbar-collapse navbar-ex1-collapse">
                <?php include("sms_menu.php"); ?>
            </div>
			
 </nav>
 



<div class="container-fluid">		 
 <div class="row">
         
<?php
require("dbconnect.php");

echo '<center>
		<button id="hclickon" class="btn" href="#" >Turn On SMS</button> 
		<button id="hclickoff" class="btn"  href="#">Turn Off SMS</button><br /><br />
	</center>';


//$query = "SELECT CLIENT_ID,CLIENT_NAME,CITYDESCR,COUNTRYDESCR,CLIENT_ADDRESS,CLIENT_LANDLINE,CLIENT_CELLNO,CLIENT_COMPANY,CLIENT_EMAIL,STATUS_ID,CLIENT_PASS FROM OMS_CLIENTS om LEFT JOIN OMS_CITY ci ON om.CLIENT_CITY = ci.cityid LEFT JOIN OMS_COUNTRY co ON om.CLIENT_COUNTRY = co.COUNTRYID WHERE STATUS_ID = '1'   ORDER BY CLIENT_ID DESC";
//$query = "SELECT ID,RECEIVER,MSG,SENTTIME,RECEIVEDTIME,OPERATOR,MSGTYPE,REFERENCE,STATUS,ERRORMSG FROM SMS_MSG.OZEKIMESSAGEOUT ORDER BY ID DESC";
$query = "SELECT MSG_OUT_ID,SENDER,MSG,SENTTIME,OPERATOR,MSGTYPE,STATUS,ERRORMSG FROM CFG_MESSAGE_OUT ORDER BY MSG_OUT_ID DESC";

$stmt = oci_parse($db, $query);
if (!is_null($stmt))
{
oci_execute($stmt);
//echo '<div class="form-group input-group"><input type="text" class="form-control"><span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></span></div>';
//echo "<div style='overflow-y:scroll;min-height:150px;'><table class='table table-bordered table-hover table-striped' width='100%' border='1'>";
//echo '<div class="form-group input-group"><input type="text" class="form-control"><span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></span></div>';

echo "<div style='overflow-y:scroll;height:800px;'><table class='table table-bordered table-hover table-striped' width='100%' border='1'>";
echo "<th>Sr #</th>";
echo "<th>Sender</th>";
echo "<th>Message</th>";
echo "<th>Sent Time</th>";
echo "<th>Operator</th>";
echo "<th>Message Type</th>";
echo "<th>Status</th>";
echo "<th>Error Msg</th>";
echo "<th>Action</th>";

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
echo '<td>
		<div class="btn-group">
           <a class="btn btn-danger dlt" href="'.$row[0].'"><i class="icon_close_alt2">Del</i></a>
         </div>
	</td>';
echo "</tr>";
}
echo "</table></div>";

}							  
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
		
	var datastring_0 = $('#coninfo').serialize() + '&obj_company=' + $('#sel_company option:selected').text() + '&obj_client=' + $('#sel_client option:selected').text() + '&obj_field=' + $('#sel_field option:selected').text();
	//alert(datastring_0);
	//return false;
	
    $.ajax({
            type: "POST",
			url: "add_contact_process.php",
			 data: datastring_0,
           dataType: "JSON",
            success: function(data) {
				//alert(data);
				if(data.status == 'true'){
					
						alert(data.content);								
						$('#coninfo')[0].reset();
					
				}else if(data.status == 'false'){
						
						alert(data.content);
					}
				
			}
			
		});
	   
	   e.preventDefault();
   });
   
   
   $("table").on("click", '.dlt', function(e) {
		
		 var rm_tbl_rw = $(this).closest("tr");
		 var datastring = 'del_id=' + $(this).attr('href');
		 //alert(datastring);
		 
		 if(confirm("Are You Sure ?"))
			 {
				 $.ajax({
						type: "POST",
						url: "sms_log_del.php",
						data: datastring,
						//dataType: "JSON",
						success: function(data) {
							//alert(data);
							if(data.indexOf("Successfully")>=0);
									//rm_tbl_rw.remove();
								//rm_tbl_rw.refresh();
								
									location.reload();
								
								/*  if(data.status == 'true'){
									 alert(data.content);
									  
									 }else if(data.status == 'false'){
										 alert(data.content);
										 } */
						}
					});

			 }else{
				;
			 }
			 e.preventDefault();
	  });


	  $("#hclickon").click(function(){
		// var on_btn = $(this).attr("href");
		//var on_btn = "on";
		//alert(on_btn);
		 // return;
		   if(confirm("Are You Sure ?"))
			 {
				 $.ajax({
						type: "POST",
						url: "sms_connect_process.php?bt=ON",
						
						//data: datastring,
						//dataType: "JSON",
						//console.log(data);
						//alert(datastring);
						success: function(data) {
							console.log(data);
							//alert(data);
							alert(data);
							if(data.indexOf("Successfully")>=0);
							
							 $("#hclickon").prop("disabled", true);
							  $("#hclickoff").prop("disabled", false);
									//rm_tbl_rw.remove();
								//rm_tbl_rw.refresh();
								
								//////////////////location.reload();
								
								/*  if(data.status == 'true'){alert(data.content); }
								else if(data.status == 'false'){
										 alert(data.content);
										 } */
						}
					});

			 }else{
				;
			 }
		
	  });
	  
	  
	  
	  
	  
	  $("#hclickoff").click(function(){
		// var on_btn = $(this).attr("href");
		//var on_btn = "on";
		//alert(on_btn);
		 // return;
		   if(confirm("Are You Sure ?"))
			 {
				 $.ajax({
						type: "POST",
						url: "sms_connect_process.php?bt=OFF",
						//data: datastring,
						//dataType: "JSON",
						//console.log(data);
						//alert(datastring);
						success: function(data) {
							console.log(data);
							//alert(data);
							alert(data);
							if(data.indexOf("Successfully")>=0);
							
							 $("#hclickon").prop("disabled", false);
							  $("#hclickoff").prop("disabled", true);
									//rm_tbl_rw.remove();
								//rm_tbl_rw.refresh();
								
								//////////////////location.reload();
								
								/*  if(data.status == 'true'){
									 alert(data.content);
									  
									 }else if(data.status == 'false'){
										 alert(data.content);
										 } */
						}
					});

			 }else{
				;
			 }
		
	  });
	  
	  
	  $.ajax({
						type: "POST",
						url: "sms_connect_check.php",
						
						//data: datastring,
						//dataType: "JSON",
						//console.log(data);
						//alert(datastring);
						success: function(data) {
							console.log(data);
							//alert(data);
							//alert(data);
							if(data.indexOf("ON")>=0)							
							{$("#hclickon").prop("disabled", true);
							$("#hclickoff").prop("disabled", false);}
							if(data.indexOf("OFF")>=0)							
							{$("#hclickon").prop("disabled", false);
							$("#hclickoff").prop("disabled", true);}
									//rm_tbl_rw.remove();
								//rm_tbl_rw.refresh();
								
								//////////////////location.reload();
								
								/*  if(data.status == 'true'){alert(data.content); }
								else if(data.status == 'false'){
										 alert(data.content);
										 } */
						}
					});
	  
	  
});



</script>
</html>
	


