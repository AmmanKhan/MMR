<?php	 
require("dbconnect.php");
if($_SERVER['REQUEST_METHOD'] == 'POST')	
	{ if(isset($_POST['ordr_val']))
		{
				
		$query = "UPDATE MMR_FEAT SET 
			ORDER_SEQ = '".$_POST['ordr_val']."'
			WHERE FEATID = ".$_POST["ft_val"]."";
		//echo $query;
		//exit;
			
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


		$Response = array('status' => $err, 'content' => $res);
		echo json_encode($Response);
		}
	}	
?>