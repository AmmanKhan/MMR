<option>Select One</option>
	<?php 
		require("dbconnect.php");
		$query = "SELECT BRID,TO_CHAR(FR_MN,'MON YYYY') as FR_MN FROM MMR_BRIEF_MASTER WHERE PRJ_ID = '".$_GET['prj_id']."'";
		$compiled = oci_parse($db, $query);
		oci_execute($compiled);
		while($row=oci_fetch_array($compiled))
		{	
	?>
		<option value="<?php echo $row['BRID'];?>"><?php echo $row['FR_MN'];?></option>
	<?php 
		}
	?>