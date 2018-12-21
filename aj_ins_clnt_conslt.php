<?php
ini_set('html_errors', false);
error_reporting(~E_ALL);

require("dbconnect.php");
if(isset($_GET['clnt_name']))
	$query = "INSERT INTO MMR_CLIENT (CLIENT_NAME , CLIENT_DESC) VALUES
				('".$_GET['clnt_name']."' , '".$_GET['clnt_desc']."')";
				
elseif(isset($_GET['conlt_name']))
	$query = "INSERT INTO MMR_CONSULTANT (CONSULTANT , DESCR) VALUES
				('".$_GET['conlt_name']."' , '".$_GET['conlt_desc']."')";
	
if(isset($_GET['clnt_name']) || isset($_GET['conlt_name']))
{
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
		
		//$err = 'false';
		echo $res = "Fail to Insert Record" ;  //  Fail msg
		//echo '<br>';
		
		
		
				if($e['code']==1)
					echo $res = " Record Already Exists.";
				/*else
					echo $res = $e['message'];*/
			}
			else
			{
				//$err = 'true';
				echo $res = "Record Inserted Successfully" ;  //  success msg
				//echo '<br>';
				
			
			}
}
	
?>