<option>Select One</option>
<?php 
	require("dbconnect.php");
	$query = "SELECT PRJ_ID,PROJTITLE FROM MMR_BRIEF_PROJECT";
	$compiled = oci_parse($db, $query);
	oci_execute($compiled);
	while($row=oci_fetch_array($compiled))
	{	
?>
	<option value="<?php echo $row['PRJ_ID'];?>"><?php echo $row['PROJTITLE'];?></option>
<?php 
	}
?>