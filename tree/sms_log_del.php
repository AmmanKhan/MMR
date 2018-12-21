<?php
	require("dbconnect.php"); 
	

		//$generate_pass = RAND(100,1000);
		//$query = "SELECT MSG_OUT_ID,SENDER,MSG,SENTTIME,OPERATOR,MSGTYPE,STATUS,ERRORMSG FROM CFG_MESSAGE_OUT ORDER BY MSG_OUT_ID DESC";

		$query = "UPDATE CFG_MESSAGE_OUT SET STATUS='3'  WHERE  MSG_OUT_ID='".$_REQUEST["del_id"]."' ";
		
	//exit;
	//$query = "INSERT INTO OMS_CLIENTS (CLIENT_NAME,CLIENT_CITY,CLIENT_COUNTRY,CLIENT_ADDRESS,CLIENT_LANDLINE,CLIENT_CELLNO,CLIENT_COMPANY,CLIENT_EMAIL,CLIENT_PASS,STATUS_ID) 
	//VALUES('".$_REQUEST["txt_clnt_name"]."','".$_REQUEST["sel_city_clnt"]."','".$_REQUEST["sel_country_clnt"]."','".$_REQUEST["txt_add_clnt"]."','".$_REQUEST["txt_landline_clnt"]."','".$_REQUEST["txt_cell_clnt"]."','".$_REQUEST["txt_company_clnt"]."','".$_REQUEST["txt_email"]."','".$_REQUEST["txt_pass"]."','".$status."')" ;
		
	
	$compiled = oci_parse($db, $query);
	if(oci_execute($compiled))
	{
		echo "Deleted Successfully";
	}
	else
	{
		echo "failed ! Check DB";
	}
	//echo "<a href='themes/main.php'>Return</a>";
	oci_close($db);
	//$message = "New client has been Added.";
	//echo "<script type='text/javascript'>alert('$message');</script>";
	//header('Location:themes/main.php');
?>