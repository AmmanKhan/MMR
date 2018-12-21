<?php
error_reporting(0);
if($_SERVER['REQUEST_METHOD'] == 'POST')	
 { 
		
/*****************************************************************************/
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

	function addslashesextended(&$arr_r)  //addslashes() on a multi-dimensional array
	{  
	  if(is_array($arr_r))  
	  {  
		foreach ($arr_r as &$val)  
		  is_array($val) ? addslashesextended($val):$val=addslashes($val);  
		unset($val);  
	  }  
	  else  
		$arr_r=addslashes($arr_r);  
	} 

  //create array to temporarily grab variables
	$input_arr = array();

	foreach ($_POST as $key => $input_arr) 
	{
		$_POST[$key] = cleanInput($input_arr);
		//$_POST[$key] = addslashes($_POST[$key]);
	}
	addslashesextended($_POST);
	//print_r($_POST);
/*****************************************************************************/
	
	require("dbconnect.php");
	
	$_POST["jsondata"] = str_replace('"','',$_POST["jsondata"]);
	$_POST["jsondata"] = str_replace('[','',$_POST["jsondata"]);
	$_POST["jsondata"] = str_replace(']','',$_POST["jsondata"]);
	$_POST["jsondata"] = str_replace(' ','',$_POST["jsondata"]);
	$_POST["jsondata"] = str_replace('\\','',$_POST["jsondata"]);
	$_POST["jsondata"] = trim(preg_replace('/\s+/', '', $_POST["jsondata"]));
	
	//print_r($_POST);
	//exit();
	/*$mnu_pgs = "";
	
	foreach($_POST["mnu_pgs"] as $key => $mnu_items){
        $mnu_pgs .= $mnu_items .",";
    }	
	$mnu_pgs = rtrim($mnu_pgs,","); //remove last comma
	*/
	//echo $mnu_pgs;
	//exit;
	 
	 $query = "begin
			   INSERT INTO CFG_GROUP_ACCESS (GROUP_ID, USER_ID, STATUS,	DESCRIPTION, MIS_ID	) 
			   VALUES 	( 	'".$_POST["jsondata"]."',	'".$_POST["usr_nme"]."',	 'Y',	 '".$_POST["optradio"]."',	 '5' );

			   exception
				  when dup_val_on_index then
					 update CFG_GROUP_ACCESS
						set GROUP_ID = '".$_POST["jsondata"]."'
						
					   where USER_ID = '".$_POST["usr_nme"]."';
			end;";
	 
	 
	 $compiled = oci_parse($db, $query);
	 $stid = oci_execute($compiled);
	 
	 if (!$stid) {
		 
		 // Deubug i.e [Detailed ERROR Messages]
		 
				$e = oci_error($compiled);  // For oci_execute errors pass the statement handle
				/*print htmlentities($e['message']);
				print "\n<pre>\n";
				print htmlentities($e['sqltext']);
				printf("\n%".($e['offset']+1)."s", "^");
				print  "\n</pre>\n"; */
				
		// End of Deubug
		$err = 'false';
		$res = "Fail to Insert Record".json_encode($e['message']) ;  //  Fail msg
		
			}
			else
			{	$err = 'true';
				$res = "Record Inserted Successfully" ;  //  success msg
			}
	
	 oci_close($db);
	
	$Response = array('status' => $err, 'content' => $res);
	echo json_encode($Response);
  //echo json_encode($err);
  //echo $res;

}
 ?>