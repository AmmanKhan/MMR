<?php
	require("dbconnect.php"); 
	
	if($_REQUEST["txt_pass"] == "")
	{
		$status = 0;
	}
	else
	{
		$status = 1;
	}
	//exit;
	$query = "INSERT INTO MMR_BRIEF_DETAIL (BRID,FEATID,VALUE) 
	VALUES('".$_REQUEST[""]."','".$_REQUEST[""]."','".$_REQUEST[""]."')" ;
	$compiled = oci_parse($db, $query);
	if(oci_execute($compiled))
	{
		echo "success";
	}
	else
	{
		echo "failed";
	}
	//echo "<a href='themes/main.php'>Return</a>";
	oci_close($db);
	$message = "New client has been Added.";
	echo "<script type='text/javascript'>alert('$message');</script>";
	header('Location:index.php');
?>