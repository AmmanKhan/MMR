<?php
	error_reporting(~E_ALL);
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		function cleanInput($input) {
 
  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );
 
    $output = preg_replace($search, '', $input);
    return $output;
  }
  
	  //create array to temporarily grab variables
	$input_arr = array();
	
	foreach ($_POST as $key => $input_arr) 
	{
		$_POST[$key] = cleanInput($input_arr);
		$_POST[$key] = addslashes($_POST[$key]);
	}
	require("dbconnect.php"); 
	
	
	$query = "INSERT INTO MMR_USERS
		(USER_NAME,
		USER_CITY,
		USER_COUNTRY,
		USER_ADDRESS,
		USER_LANDLINE,
		USER_CELLNO,
		USER_COMPANY,
		STATUS_ID,
		USER_EMAIL,
		USER_PASS,
		MIS_ID,
		ROLE) 
	
	VALUES 
	( 
	 '".$_REQUEST['TXT_USER_NAME']."',
	 '579',
	 '275',
	 '".$_REQUEST['TXT_USER_ADDRESS']."',
	 '".$_REQUEST['TXT_USER_LANDLINE']."',
	 '".$_REQUEST['TXT_USER_CELLNO']."',
	 '".$_REQUEST['TXT_USER_COMPANY']."',
	 '1',
	 '".$_REQUEST['TXT_USER_EMAIL']."',
	 '".$_REQUEST['TXT_USER_PASS']."',
	 '".$_REQUEST['SEL_MIS_ID']."',
	 '".$_REQUEST['SEL_ROLE']."'
	 )";
	
	
	
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
				// if($e['code']==1)
					// $res.="<br> Record Already Exists.";
				// else
					// $res.="<br>".$e['message'];
			}
			else
			{	$err = 'true';
				$res = "User Inserted Successfully" ;  //  success msg
			}
	
	 oci_close($db);
	
	$Response = array('status' => $err, 'content' => $res.$e['message']);
	echo json_encode($Response);
	}
?>