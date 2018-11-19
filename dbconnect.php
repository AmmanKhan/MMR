<?php 
$db = oci_pconnect("mmr_brief","mmr_brief123???","//172.16.0.119/FMW",'AL32UTF8'); 
if (!$db) { 
	die("<h3>Unable to Connect to Database.</h3></br>Contact ICT Branch, HQ NLC for Info.");
} 
?> 