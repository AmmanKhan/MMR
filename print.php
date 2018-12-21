<?php //die("<br><br><br><center><pre><h1>Under Development</h1></pre></center>"); ?>
<html>
<head>

</head>
<body <?php //onload="window.print()"?>>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg .tg-c1h2{font-weight:bold;background-color:#2dafd4;color:#ffffff;text-align:center;vertical-align:top}
.tg .tg-exyz{font-weight:bold;background-color:#fffe65;text-align:left;vertical-align:top}
.tg .tg-0lax{text-align:left;vertical-align:top}

#prbtn,#clbtn {margin:10px;}
@media print
{
	#prbtn,#clbtn {display:none;}
}
h3,h4{margin-bottom: 0px;
    margin-top: 3px;}
</style>
<button onclick="myFunction()" id="prbtn" style="float:right; margin-right: 50px;">Print this page</button>
<button onclick="closeWin()" id="clbtn" style="float:right;">Close Window</button>
<div style="clear:both;"></div>
<center>
<h3>HQ NATIONAL LOGISTICS CELL</h3>
<h4>(MONITORING BRANCH)</h4>
<h4><?php echo $_GET['prj_tle']; ?></h4>
<br>
<table class="tg" style="undefined;table-layout: fixed; width: 606px">
<colgroup>
<col style="width: 25px">
<col style="width: 200px">
<col style="width: 50px">
<col style="width: 150px">
</colgroup>
  <tr>
    <th class="tg-c1h2">Ser</th>
    <th class="tg-c1h2">Description</th>
    <th class="tg-c1h2">Values</th>
    <th class="tg-c1h2">Remarks</th>
  </tr>
  <tr>
    <td class="tg-exyz" colspan="4">Input Data</td>
  </tr>
  
<?php
//error_reporting(E_ALL);
//var_dump($_GET);
if(isset($_GET['brid']))
{
	$query = "SELECT * FROM MMR_OUTPUT_PRJ p where p.BRID = ".$_GET['brid'];
	require("dbconnect.php");
	try {
        $stmt = oci_parse($db, $query);
		//echo $stmt; exit();
        if (!is_null($stmt))
        {
        oci_execute($stmt);
		
	
while($row=oci_fetch_array($stmt))
{
?>

  <tr>
    <td class="tg-0lax">a.</td>
    <td class="tg-0lax">Budget at Completion (BAC)</td>
    <td class="tg-0lax"><?php echo $row['F1']; ?></td>
    <td class="tg-0lax">Scope of Work</td>
  </tr>
  <tr>
    <td class="tg-0lax">b.</td>
    <td class="tg-0lax">Planned Value (PV)</td>
    <td class="tg-0lax"><?php echo $row['F2']; ?></td>
	<td class="tg-0lax">Planned Value of Work</td>
  </tr>
  <tr>
    <td class="tg-0lax">c.</td>
    <td class="tg-0lax">Earned Value (EV)</td>
    <td class="tg-0lax"><?php echo $row['F3']; ?></td>
	<td class="tg-0lax">Vetted Work Done</td>
  </tr>
  <tr>
    <td class="tg-0lax">d.</td>
    <td class="tg-0lax">Actual Cost (AC)</td>
    <td class="tg-0lax"><?php echo $row['F4']; ?></td>
	<td class="tg-0lax">Actual Expenses</td>
  </tr>
  <tr>
    <td class="tg-0lax">e.</td>
    <td class="tg-0lax">Original Project Duration (PD)</td>
    <td class="tg-0lax"><?php echo $row['F5']; ?></td>
	<td class="tg-0lax">Months</td>
  </tr>
  <?php /*
  <tr>
    <td class="tg-0lax">f.</td>
    <td class="tg-0lax">Extended Project Duration (EPD)</td>
    <td class="tg-0lax"><?php echo ""; ?></td>
	<td class="tg-0lax">Months</td>
  </tr>
  <tr>
    <td class="tg-0lax">g.</td>
    <td class="tg-0lax">Duration Since Start of the Proj</td>
    <td class="tg-0lax"><?php echo ""; ?></td>
	<td class="tg-0lax">Months</td>
  </tr> */ ?>
  <tr>
    <td class="tg-exyz" colspan="4">Project Forecasting</td>
  </tr>
  <tr>
    <td class="tg-0lax">a.</td>
    <td class="tg-0lax">Schedule Variance (SV)</td>
    <td class="tg-0lax"><?php echo $row['F6']; ?></td>
	<td class="tg-0lax">+ve shows ahead of Sch<br>-ve shows behind Sch</td>
  </tr>
  <tr>
    <td class="tg-0lax">b.</td>
    <td class="tg-0lax">Schedule Performance Index (SPI)</td>
    <td class="tg-0lax"><?php echo $row['F7']; ?></td>
	<td class="tg-0lax">>1 means ahead of Sch<br><1 means behind Sch</td>
  </tr>
  <tr>
    <td class="tg-0lax">c.</td>
    <td class="tg-0lax">Time Estimate to Complete (ETCt)</td>
    <td class="tg-0lax"><?php echo $row['F8']; ?></td>
	<td class="tg-0lax">Months</td>
  </tr>
  <tr>
    <td class="tg-0lax">d.</td>
    <td class="tg-0lax">Cost Variance (CV)</td>
    <td class="tg-0lax"><?php echo $row['F9']; ?></td>
	<td class="tg-0lax">+ve shows under the budget<br>-ve shows over the budget</td>
  </tr>
  <tr>
    <td class="tg-0lax">e.</td>
    <td class="tg-0lax">Cost Performance Index (CPI)</td>
    <td class="tg-0lax"><?php echo $row['F10']; ?></td>
	<td class="tg-0lax">>1 means under the planned Budget<br><1 means over the planned Budget</td>
  </tr>
  <tr>
    <td class="tg-0lax">f.</td>
    <td class="tg-0lax">Estimate at Completion (EAC)</td>
    <td class="tg-0lax"><?php echo $row['F11']; ?></td>
	<td class="tg-0lax">Proj likely cost</td>
  </tr>
  <tr>
    <td class="tg-0lax">g.</td>
    <td class="tg-0lax">Estimate to Complete (ETC)</td>
    <td class="tg-0lax"><?php echo $row['F12']; ?></td>
	<td class="tg-0lax">Cost of remaining work</td>
  </tr>
  <tr>
    <td class="tg-0lax">h.</td>
    <td class="tg-0lax">To-Complete Performance Index (TCPI)</td>
    <td class="tg-0lax"><?php echo $row['F13']; ?></td>
	<td class="tg-0lax">Efficiency at which remaining resources are to be utilized<br>>1 harder to complete<br><1 easier to complete</td>
  </tr>
  <tr>
    <td class="tg-0lax">i.</td>
    <td class="tg-0lax">Variance at Completion</td>
    <td class="tg-0lax"><?php echo $row['F14']; ?></td>
	<td class="tg-0lax">Under or over the budget at completion of proj</td>
  </tr>



<?php
}


}
else
           // print "\$stmt is [$stmt]&lt;br /&gt;";
	   ;
	}
	
	
	catch (PDOException $ex) {
        // For testing, you could use a die and message. 
        //die("Failed to run query: " . $ex->getMessage());
        
        //or just use this use this one:
        $response["success"] = 0;
        $response["message"] = "Database Error2. Please Try Again!";
        die(json_encode($response));
    }
	oci_free_statement($stmt);
	oci_close($db);
}
?>

</table>
</center>
</body>
<script>
function myFunction() {
    window.print();
}
function closeWin() {
    window.close();   // Closes the new window
}
</script>
</html>