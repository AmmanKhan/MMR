<?php 
	
	//error_reporting(~E_ALL);
	require("dbconnect.php");
	$query = "select C.Client_name from Mmr_Client c where C.Client_Id IN(
				select p.Client_Id from Mmr_Brief_Project p where p.Prj_Id = '".$_GET['prj_id']."')";
	$compiled = oci_parse($db, $query);
	oci_execute($compiled);
	$client = array();
	while($row=oci_fetch_array($compiled))
	{
	array_push($client,$row['CLIENT_NAME']);
 	}
	
	$client_nmes = implode(',',$client);
	
	
	/*************************************************************************************************************/
	
	$query = "select c.Consultant from  Mmr_Consultant c where c.Con_Id IN(
			select regexp_substr((select p.Con_Id from Mmr_Brief_Project p where p.Prj_Id = '".$_GET['prj_id']."'),'[^,]+', 1, level) from dual
			 connect by regexp_substr((select p.Con_Id from Mmr_Brief_Project p where p.Prj_Id = '".$_GET['prj_id']."'), '[^,]+', 1, level) is not null)";
	$compiled = oci_parse($db, $query);
	oci_execute($compiled);
	$conslt = array();
	while($row=oci_fetch_array($compiled))
	{
	array_push($conslt,$row['CONSULTANT']);
 	}
	
	$conslt_nmes = implode(',',$conslt);
	
	/**************************************************************************************************************/
	
	$query = "Select BUDGET from MMR_BRIEF_PROJECT p where p.Prj_Id = '".$_GET['prj_id']."' ";
	$compiled = oci_parse($db, $query);
	oci_execute($compiled);
	$budget = "";
	while($row=oci_fetch_array($compiled))
	{
	$budget = $row['BUDGET'];
 	}
	
		
	$Response = array('client' => $client_nmes, 'conslt' => $conslt_nmes, 'budget' => $budget);
	echo json_encode($Response);
	
	
?>