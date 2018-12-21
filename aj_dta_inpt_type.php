<?php	 
require("dbconnect.php");
if($_SERVER['REQUEST_METHOD'] == 'POST')	
{ if(isset($_POST['d_val'])){
	if($_POST['d_val'] == 2 )
		$query = "UPDATE MMR_FEAT SET 
			DATA_TYPE = '".$_POST['d_val']."'
			WHERE FEATID = ".$_POST["ft_val"]."";
	else
		$query = "UPDATE MMR_FEAT SET 
			DATA_TYPE = '".$_POST['d_val']."',
			INPUT_TYPE = '1'
			WHERE FEATID = ".$_POST["ft_val"]."";
	//echo $query;
	//exit;
}

if(isset($_POST['i_val'])){
	if($_POST['i_val'] != 2 )
		$query = "UPDATE MMR_FEAT SET 
			INPUT_TYPE = '".$_POST['i_val']."'
			WHERE FEATID = ".$_POST["ft_val"]."";
	else
		$query = "UPDATE MMR_FEAT SET 
			DATA_TYPE = '2',
			INPUT_TYPE = '".$_POST['i_val']."'
			WHERE FEATID = ".$_POST["ft_val"]."";
			
	//echo $query;
	//exit;
}


 $compiled = oci_parse($db, $query);
 $stid = oci_execute($compiled,OCI_DEFAULT);
	 
 if ($stid) {
	 
	oci_commit($db); //*** Commit Transaction ***//
	$err = 'true';
	$res = " Success" ;  //  success msg
	 
		}
		else
		{	
			// Deubug i.e [Detailed ERROR Messages]
			 
				/*	 $e = oci_error($compiled);  // For oci_execute errors pass the statement handle
					print htmlentities($e['message']);
					print "\n<pre>\n";
					print htmlentities($e['sqltext']);
					printf("\n%".($e['offset']+1)."s", "^");
					print  "\n</pre>\n"; 
					*/
			// End of Deubug
			
			oci_rollback($db); //*** RollBack Transaction ***//  
			$e = oci_error($compiled);  
			$err = 'false';
			$res = " Fail" ;  //  Fail msg
		}
/*****************************************************************************************************/
$query = "Select DATA_TYPE, INPUT_TYPE from MMR_FEAT f where f.FEATID = '".$_POST['ft_val']."' ";
	$compiled = oci_parse($db, $query);
	oci_execute($compiled);
	$dt_type = "";
	$in_type = "";
	while($row=oci_fetch_array($compiled))
	{
			$dt_type = $row['DATA_TYPE'];
			$in_type = $row['INPUT_TYPE'];
 	}
	

/*****************************************************************************************************/
 oci_close($db);

$Response = array('status' => $err, 'content' => $res, 'dt_type' => $dt_type, 'in_type' => $in_type);
echo json_encode($Response);
}	
?>