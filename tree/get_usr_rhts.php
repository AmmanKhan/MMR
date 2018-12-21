<?php 
error_reporting(0);
if($_SERVER['REQUEST_METHOD'] == 'POST')	
 { 
		$usr_arr = $usr_typ = '';
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
	
	
	//print_r($_POST);
	//exit();
	 
	 $query = "SELECT GROUP_ID, DESCRIPTION,MENU_ID FROM CFG_GROUP_ACCESS WHERE USER_ID = '".$_POST['usr']."'";
	try {
				$stmt = oci_parse($db, $query);
				//echo $stmt; exit();
				if (!is_null($stmt))
				{
					oci_execute($stmt);

		
			while($row=oci_fetch_array($stmt))
				{	$usr_arr = $row['GROUP_ID'];
					$usr_typ = $row['DESCRIPTION'];
					$usr_mnu = $row['MENU_ID'];
					}
			
					if($usr_arr == '')
						$usr_arr = '['.$usr_arr.']';
					else{
				$usr_arr = str_replace(',','","',$usr_arr);
				$usr_arr = trim(preg_replace('/\s+/', '', $usr_arr)); //replace new line(Enter)
					$usr_arr = '["'.$usr_arr.'"]';}
					
					
					if($usr_typ == '')
						$usr_typ = 'User';
					
					
					if($usr_mnu == '')
						$usr_mnu = '["1"]';
					else{
				$usr_mnu = str_replace(',','","',$usr_mnu);
				$usr_mnu = trim(preg_replace('/\s+/', '', $usr_mnu)); //replace new line(Enter)
					$usr_mnu = '["'.$usr_mnu.'"]';}
				
				$err = 'true';
				$res = "Record Obtained Successfully" ;  //  success msg
				
				} //if
			else
				{	//print "\$stmt is [$stmt]&lt;br /&gt;";
						;	
					}
		}
										
		catch (PDOException $ex) {
				
				//die("Failed to run query: " . $ex->getMessage());
				$e = oci_error($compiled);  // For oci_execute errors pass the statement handle
				/*print htmlentities($e['message']);
				print "\n<pre>\n";
				print htmlentities($e['sqltext']);
				printf("\n%".($e['offset']+1)."s", "^");
				print  "\n</pre>\n"; */
				
				// End of Deubug
				$err = 'false';
				$res = "Fail to GET Record".json_encode($e['message']) ;  //  Fail msg
		
				}
		
	oci_free_statement($stmt);
	oci_close($db);
	
	$Response = array('status' => $err, 'content' => $res, 'arr_d' => $usr_arr, 'usr_typ' => $usr_typ, 'usr_mnu_rts' => $usr_mnu);
	echo json_encode($Response);
								
	 /***********************************************************************************/
	
}
?>