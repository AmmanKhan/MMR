<?php
 
$query = "select MENU_ID FROM CFG_MENU_ITEMS where  MENU_URL = '".basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING'])."'";
require("dbconnect.php");
	try {	$stmt = oci_parse($db, $query);
			//echo $stmt; exit();
			if (!is_null($stmt)){
			oci_execute($stmt);
	while($row=oci_fetch_array($stmt))
			{	$curr_pge = $row['MENU_ID'];
		
		
				}			
			}
		else
			{	//print "\$stmt is [$stmt]&lt;br /&gt;";
					;	
				}
	}									
	catch (PDOException $ex) {
			//die("Failed to run query: " . $ex->getMessage());
			}
	oci_free_statement($stmt);
	
	$usr_pgs=array();
	$query = "  select regexp_substr((select MENU_ID from CFG_GROUP_ACCESS WHERE USER_ID = '".$_SESSION['userid']."'),'[^,]+', 1, level)  as com_val from dual
		connect by regexp_substr((select MENU_ID from CFG_GROUP_ACCESS WHERE USER_ID = '".$_SESSION['userid']."'), '[^,]+', 1, level) is not null";
	try {	$stmt = oci_parse($db, $query);
				//echo $stmt; exit();
				if (!is_null($stmt)){
				oci_execute($stmt);
		while($row=oci_fetch_array($stmt))
				{	$usr_pgs[]+= $row['COM_VAL'];
						
					}			
				}
			else
				{	//print "\$stmt is [$stmt]&lt;br /&gt;";
						;	
					}
		}									
		catch (PDOException $ex) {
				//die("Failed to run query: " . $ex->getMessage());
				}
		oci_free_statement($stmt);	
		
		//print_r($usr_pgs);
		
		if(array_search($curr_pge,$usr_pgs)>=0)
		{	//echo "FOUND";
				
		}
		else
		{	//echo "NOT FOUND";
			Die("You Dont Have Access to this Page");
			}		
?>