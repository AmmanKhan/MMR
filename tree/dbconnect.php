<?php

    // $dbc = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 172.16.0.21)(PORT = 1521)))(CONNECT_DATA=(SID=CUSTDB)))" ;

    // if($db = OCILogon("sms", "SMS123", $dbc))
    // {
       // // echo "Successfully connected to Oracle.\n";
        // //OCILogoff($c);
    // }
    // else
    // {
        // $err = OCIError();
// //        echo "Connection failed." . $err[text];
    // }

$db = oci_pconnect("mmr_brief","mmr_brief123???","//172.16.0.119/FMW",'AL32UTF8'); 
if (!$db) { 
	//die('Could not connect to ORCL: ' . oci_error()); 
	die("<h3>Unable to Connect to Database.</h3></br>Contact ICT Branch, HQ NLC for Info.");
} 
//echo 'Connection OK'; 
//oci_close($db); 


	
	
	
//if($db=oci_connect("sms", "SMS123", 'CUSTDB')) {
//echo "Successfully connected to Oracle.\n";
//} else {
//$err = OCIError();
//echo "Connection failed." . $err[text];
//}
?>