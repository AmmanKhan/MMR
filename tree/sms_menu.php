 
 <?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ( !isset($_SESSION['user'])) {
	//you are already logged in
  header("Location: index.php");
  exit;
 }
 

?>



 <ul class="nav navbar-nav side-nav">
                    
<?php 
	$query = "Select d.MENU_ID FROM CFG_GROUP_ACCESS d where d.ACCESS_ID = '".$_SESSION['userid']."'";
	require("dbconnect.php");
	try {
				$stmt = oci_parse($db, $query);
				//echo $stmt; exit();
				if (!is_null($stmt))
				{
					oci_execute($stmt);

		
				while($row=oci_fetch_array($stmt))
				{	$rcd = $row['MENU_ID'];	}
				$rcd = explode(',',$rcd);
				//var_dump($rcd);
				foreach($rcd as $key)
				{	//echo $key;
					$query = "select h.MENU_ID, h.MENU_TITLE, h.MENU_URL from CFG_MENU_ITEMS h where  h.MENU_ID = '".$key."'";
					$stmt = oci_parse($db, $query);
					oci_execute($stmt);
					while($row=oci_fetch_array($stmt))
					{	?>
					<li>
                        <a href="<?php echo $row['MENU_URL']; ?>"><i class="glyphicon glyphicon-folder-open"> </i>&nbsp;&nbsp;<?php echo $row['MENU_TITLE']; ?></a>
                    </li>
						<?php }
						
						
					
				}
				
				$err = 'true';
				$res = "Record Obtained Successfully" ;  //  success msg
				
				
				} //if
			else
				{	//print "\$stmt is [$stmt]&lt;br /&gt;";
							
					
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
					
		?>			

</ul>