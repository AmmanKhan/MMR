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
	
	
    <script type="text/javascript">
	
		function fieldset_check(){
			
			 var chk = document.getElementById("checklist").checked;
			 //alert(chk);
			if(chk == true)
			{	
				//alert("c");
				document.getElementById("Fieldset_Radio").disabled = false;
				$('.chk_box').prop( "disabled", false );
				
			}
			else
			{
				//alert("b");
				document.getElementById("Fieldset_Radio").disabled = true;
				$('.chk_box').prop( "disabled", true );
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
		$(document).ready(function(){
			$('.chk_box').prop( "checked", true );
			$('.chk_box').prop( "disabled", true );
			
			$('#grp_chk_con').click(function()
			{
				$('.chk_box').prop( "checked", true );
				});
				
		$('#grp_chk_con1').click(function()
			{
		$('.chk_box').prop( "checked", false );
			});
			
			
		$('#formsms').submit(function( e ){
			
			if ($('#checklist').is(':checked')) {
				//alert("CHECKED");
				var chkval = 1;
			}else
			{
				//alert("UNCHECKED");
				var chkval = 0;
			}
			
			var formdata = $(this).serialize();
			var datastring = 'chkval=' + chkval + '&' + formdata;
			//alert(datastring);
			if (confirm('Are you sure you want to send SMS?')) {
				//alert()
			// AJAX code to send data to php file.
			   $.ajax({
					type: "GET",
					url: "sms_send.php",
					data: datastring,
					//dataType: "JSON",
					success: function(data) {
						alert(data);
						console.log(data);
						if(data.status == 'true')
						{
							//alert(data.Content);
						}
						else if(data.status == 'false')
						{
							//alert(data.Content);
						}
					}
				});
			}
				  else
				  {
					  //Do Not Send SMS
				  }
	
		e.preventDefault();
		});
			
			
		});
    </script>
</head>


<body>

<div id="wrapper" >
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
 
 
	<div id="page-wrapper" style="background-image: url('images/smsback.png');">
    <!-- YOUR CONTENT GOES HERE -->
		<div class="container-fluid">
			  <div class="row">
                    <div class="col-lg-12">
                        
                           <img src="images/gateway1.jpg" height="140px" width="100%" />
                       
                    </div>
                </div>
				
			<h4>User Panel</h4>
					
<table border="0" width="100%">
<tr>
<td valign="top" width="15%" style="border-right:1px solid lightgray ;" >		
				<div id="tree-container">
				</div>

				<center>
				<hr />
				<form method="GET">
						<input id="jsondata" type="hidden" name="getlist" value="">
						<button   type="submit" class="btn btn-default" onclick="myFunction();" name="btnadd" id="btnadd">Search Contacts</button>
						<br />
				</form>
				</center>
</td>
<td width="85%">


<div class="table-responsive">
<?php
if(ISSET($_GET['btnadd']))
{
$getcontact =  $_GET['getlist'];
$string = str_replace('[', '', $getcontact);
$string = str_replace(']', '', $string);
$string = str_replace('"', '', $string);
//echo $string; 
require("dbconnect.php");
//$query = "SELECT CONTACT_ID,MOBILE,EMPNAME,CONTACT_TYPE,STAFF_NO,EMAIL,MIS_ID FROM CFG_SMS_CONTACTS WHERE CONTACT_ID IN (".$string.")";
//$query = "SELECT CONTACT_LIST_ID,CONTACT_NO,CONTACT_NAME,CONTACT_TYPE,GROUP_ID,COMM_IDENTITY FROM CFG_SMS_CONTACT_LIST WHERE CONTACT_LIST_ID IN (".$string.")";
//$query = "SELECT cl.CONTACT_LIST_ID,cl.CONTACT_NO,cl.CONTACT_NAME,cl.CONTACT_TYPE,cl.GROUP_ID,cl.COMM_IDENTITY,gr.TEXT  FROM CFG_SMS_CONTACT_LIST cl LEFT JOIN CFG_GROUP gr ON gr.GROUP_ID = cl.GROUP_ID WHERE cl.GROUP_ID IN (".$string.")";
//$query = "SELECT cl.CONTACT_LIST_ID,cl.CONTACT_NO,cl.CONTACT_NAME,cl.CONTACT_TYPE,cl.GROUP_ID,cl.COMM_IDENTITY,gr.TEXT,cg.group_id,cg.contact_id
//FROM CFG_SMS_CONTACT_LIST cl LEFT JOIN CFG_SMS_GROUP_CONTACT_MAP cg ON cl.CONTACT_LIST_ID = cg.CONTACT_ID  LEFT JOIN CFG_GROUP gr ON gr.GROUP_ID = cg.GROUP_ID WHERE cg.GROUP_ID IN (".$string.") AND cg.status='1' ";
$stmt = "";
$query = "";
$query = "SELECT c.STAFF_NO as HRNO, h.STAFF_NAME as SNAME,mp.CONTACT_CAT,h.ORGANIZATION_DESC as ORG,h.JOB_DESC as DESIG,
			coalesce(s.CONTACTNO, 'N/A') as MOBILE, s.CONTACTNO_ID,mp.group_id FROM  
			CFG_SMS_GROUP_CONTACT_MAP mp LEFT JOIN CBK_NUMBERS s  ON mp.CONTACT_ID = s.CONTACTNO_ID
			LEFT JOIN CBK_CONTACTS c ON s.contactno_ID = c.MOBILE_ID
            LEFT JOIN PMS.SW_HR_V h  ON h.STAFF_NO = c.STAFF_NO
            WHERE s.CONTACTNO IS NOT NULL  AND mp.GROUP_ID IN (".$string.") AND mp.status='1' AND mp.CONTACT_CAT='I' ";
			
		$stmtchk = oci_parse($db, $query);
		oci_execute($stmtchk);
		$numrows = oci_fetch_all($stmtchk, $res);
		$stmt = oci_parse($db, $query);

if (!is_null($stmt))
{
	
oci_execute($stmt);
	
	
if($numrows == '0')
{
	//echo $numrows;
	$query = "SELECT ce.CONTACT_ID,ce.CONTACT_NAME,mp.CONTACT_CAT,ce.CONTACT_ADDR, coalesce(ce.EMAIL, 'N/A') as EMAIL, ne.CONTACTNO,ce.MOBILE_ID,mp.GROUP_ID FROM CFG_SMS_GROUP_CONTACT_MAP mp LEFT JOIN  CBK_CONTACTS_EXR ce ON mp.CONTACT_ID = ce.MOBILE_ID LEFT JOIN CBK_NUMBERS_EXR ne ON ce.MOBILE_ID = ne.CONTACTNO_ID  
	WHERE mp.CONTACT_CAT='E' AND ne.CONTACT_TYPE_ID = '5' AND mp.GROUP_ID IN (".$string.") AND mp.status='1'  ";	
	$stmt = oci_parse($db, $query);
	oci_execute($stmt);
}


	echo '<form>
	<table  class="table table-bordered table-hover table-striped"><tr>
		<td align="center">
					<div class="checkbox" >
                                    <label>
                                        <input onclick="fieldset_check()" id="checklist" type="checkbox">Select Contact list Manually.
                                    </label>
                    </div>
		<fieldset disabled id="Fieldset_Radio">
		<div class="form-group">
			<label class="radio-inline"><input type="radio" name="chkbox" id="grp_chk_con1" >Unselect</label>
			<label class="radio-inline"><input type="radio" name="chkbox" id="grp_chk_con" checked >Select</label>
		</div>
		</fieldset>
		</td>
		</tr>
	</table>
</form>';

echo "<form action='sms_send.php' method='GET' id='formsms'>";
echo '<div class="form-group input-group"><input type="text" class="form-control"><span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></span></div>';
echo "<div style='overflow-y:scroll;min-height:150px;'><table class='table table-bordered table-hover table-striped' width='100%' border='1'>";
echo "<th></th>";
echo "<th>Staff ID</th>";
echo "<th>Person Name</th>";
echo "<th>Category</th>";
echo "<th>Organization</th>";
echo "<th>Designation</th>";
echo "<th>Mobile</th>";
echo "<th>Contact</th>";
echo "<th>Group</th>";
$imgc = 0;

while($row=oci_fetch_array($stmt))
{
$imgc++;
echo "<tr>";
echo '<td><input type="checkbox" class="chk_box" name="sms[]" value="'.$row[6].'" ></td>';
echo '<td>'.$row[0].'</td>';
echo "<td>".$row[1]."</td>";
if($row[2] == 'I')
{	echo "<td>Internal</td>";}
else
{echo "<td>External</td>";}
echo "<input type='hidden' name='con_cat' id='con_cat' value='".$row[2]."' />";
echo "<td>".$row[3]."</td>";
echo "<td>".$row[4]."</td>";
echo "<td>".$row[5]."</td>";
echo "<td>".$row[6]."</td>";
echo "<td>".$row[7]."</td><input type='hidden' class='chk_box' name='groupid[]' value='".$row[7]."' />";
echo "</tr>";
}
echo "</table></div>";
echo '<table align="center">';
echo '<tr><td><div class="form-group">
						   <label class="col-sm-2 control-label"><img src="images/msg.JPG" width="25px" height="18px" />&nbsp;Message :</label>
                                      <div class="col-sm-10">
										   <select name="SEL_MSG" id="SEL_MSG" class="form-control m-bot15" onchange="changeFunc();">
										   <option value="">- - Select - -</option>';
                                               
												$query = "SELECT TEMPLATE_ID,TEMPLATE_MSG,STATUS,CAPTUREDATE FROM CFG_MSG_TEMPLATES ORDER BY TEMPLATE_ID DESC";

												$compiled = oci_parse($db, $query);
												oci_execute($compiled);
												while($row=oci_fetch_array($compiled))
												{
												
													echo  '<option value="'.$row[0].'">'.$row[1].'</option>';
														 
												  
												}oci_close($db);
											
echo  '</select> </div> </div>
</td></tr>
<tr><td><textarea rows="4" cols="120" id="msgtext" name="msgtext" class="form-control" placeholder="Please type SMS ... "></textarea></td></tr>';
echo '<tr><td align="center"><br /><input type="submit" class="btn btn-default" value="Send SMS" /></tr></td></table>';
echo '</form>';
//echo "<a href='home.php?contact_id=sms[]'><img alt='Send SMS' title='SMS' src='images/add.png' hspace='10' /></a>";
} //// close else of checking row
} //// close stmt is not null
?>

		</div>
		
</td>
</tr>
</table>

		
		
		
		</div>
	</div>

	</div>
	
</div>

</body>

</html>



<script type="text/javascript">
    $(document).ready(function() {
        //fill data to tree  with AJAX call
        $('#tree-container').jstree({
            'plugins': ["wholerow", "checkbox"],
            'core': {
                'data': {
                    "url": "treeview.php",
                    "plugins": ["wholerow", "checkbox"],
                    "dataType": "json" // needed only if you do not supply JSON headers
                }
            }
        }).on('ready.jstree', function(e,node) {
			console.log(node);
				$('#tree-container').jstree('open_node', $("#170_anchor"));
				// var depth = 3; 
        // data.inst.get_container().find('li').each(function(i) { 
                // if(data.inst.get_path($(this)).length<=depth){ 
                        // data.inst.open_node($(this)); 
               // } 
       // }); 
				
		});
    });
	

 function changeFunc() {
    var selectBox = document.getElementById("SEL_MSG");
    var selectedValue = selectBox.options[selectBox.selectedIndex].text;
	if(selectedValue == "- - Select - -")
	{document.getElementById("msgtext").value = "";}
	else{
	document.getElementById("msgtext").value = selectedValue;
		}//alert(selectedValue);
   }

</script>
