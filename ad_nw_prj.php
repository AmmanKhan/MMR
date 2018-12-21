<?php
	error_reporting(~E_ALL);
	require("dbconnect.php");
	
	$consultant = implode(",",$_GET['sel_con']);
	
	$query = "INSERT INTO MMR_BRIEF_PROJECT (PROJTITLE , PRJ_FRM , PRJ_TO , PRJ_STATUS,CLIENT_ID,CON_ID,budget)
				VALUES 	('".$_GET['pname']."' , '".$_GET['frm_date']."' , '".$_GET['t_date']."' , '".$_GET['prj_stus']."','".$_GET['sel_client']."','".$consultant."','"$_GET['budget']"' )";
	 
	 $compiled = oci_parse($db, $query);
	 $stid = oci_execute($compiled);
	 
	 if (!$stid) {
		 
		 // Deubug i.e [Detailed ERROR Messages]
		 
				 $e = oci_error($compiled);  // For oci_execute errors pass the statement handle
				/* print htmlentities($e['message']);
				print "\n<pre>\n";
				print htmlentities($e['sqltext']);
				printf("\n%".($e['offset']+1)."s", "^");
				print  "\n</pre>\n"; */
				
		// End of Deubug
		$err = 'false';
		$res = "Fail to Insert Record" ;  //  Fail msg
			if($e['code']==1)
					$res.="\n Project Name Already Exists.";
				else
					$res.="\n".$e['message'];
				
			}
			else
			{	$err = 'true';
				$res = "Record Inserted Successfully" ;  //  success msg
			}
	
	 oci_close($db);
	
	$Response = array('status' => $err, 'content' => $res);
	echo json_encode($Response);
?>