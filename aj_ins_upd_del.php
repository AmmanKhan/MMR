<?php
	$debug = 0;
	require("dbconnect.php");
	
	$BD_FT_IDS  = array();		//52&41=qwerty	->	BDID&FEATID=VALUE
	$INPUT_DATA = array();		//41=qwerty		->	FEATID=VALUE
	$BRID = "";
	
	$upd_count = 0;		$upd_err_count = 0;
	$del_count = 0;		$del_err_count = 0;
	$inr_count = 0;		$inr_err_count = 0;
	
	$query = "SELECT m.BRID FROM MMR_BRIEF_MASTER m WHERE UPPER(TO_CHAR(m.FR_MN,'MON-YYYY')) = UPPER('".$_POST['brf_mon']."') AND 
				m.PRJ_ID = '".$_POST['prj_id']."'";
	$compiled = oci_parse($db, $query);
	oci_execute($compiled);
	while($row = oci_fetch_array($compiled))
	{
		$BRID = $row['BRID'];
		if($debug == 1)
		{echo "Brief Month Selected ".$BRID;
		echo '<br>';}
	}
	
	if($BRID == "" || strlen($BRID) <=0 || $BRID == NULL)
	{
		$query = "INSERT INTO MMR_BRIEF_MASTER (PRJ_ID , FR_MN) VALUES ('".$_POST['prj_id']."' , TO_DATE(UPPER('".$_POST['brf_mon']."'), 'MON-YYYY') ) RETURNING BRID INTO :br_val";
		
		$stmt = ociparse($db,$query);
		OCIBindByName($stmt,":br_val",$BRID,32);
		OCIExecute($stmt);
		if($debug == 1)
		{echo "Brief Month Created ".$BRID;
		echo '<br>';}
	}
		
	if($debug == 1)
		var_dump($_POST);
	
	
	$query = "SELECT d.BDID|| '&' ||f.FEATID as BD_FT_IDS , coalesce(d.VALUE, 'null') as VALUE /*, d.BRID*/
	  FROM MMR_FEAT  f
		LEFT JOIN MMR_BRIEF_DETAIL d ON d.FEATID = f.FEATID 
		LEFT JOIN MMR_BRIEF_MASTER m ON m.BRID = d.BRID
		LEFT JOIN MMR_BRIEF_PROJECT p ON p.PRJ_ID = m.PRJ_ID
		WHERE p.PRJ_ID = '".$_POST['prj_id']."'  AND UPPER(TO_CHAR(m.FR_MN,'MON-YYYY')) = UPPER('".$_POST['brf_mon']."') OR f.FEATID = ANY(
	  SELECT f.PARENT
	  FROM MMR_FEAT  f
		LEFT JOIN MMR_BRIEF_DETAIL d ON d.FEATID = f.FEATID 
		LEFT JOIN MMR_BRIEF_MASTER m ON m.BRID = d.BRID
		LEFT JOIN MMR_BRIEF_PROJECT p ON p.PRJ_ID = m.PRJ_ID
		WHERE p.PRJ_ID = '".$_POST['prj_id']."'  AND UPPER(TO_CHAR(m.FR_MN,'MON-YYYY')) = UPPER('".$_POST['brf_mon']."')  OR f.FEATID = ANY(
		
					 select DISTINCT f.PARENT as node_parent from MMR_BRIEF_PROJECT p
					LEFT JOIN MMR_BRIEF_MASTER m ON m.PRJ_ID = p.PRJ_ID
					LEFT JOIN MMR_BRIEF_DETAIL d ON d.BRID = m.BRID
					LEFT JOIN MMR_FEAT f ON f.FEATID = d.FEATID
					  where p.PRJ_ID = '".$_POST['prj_id']."' AND UPPER(TO_CHAR(m.FR_MN,'MON-YYYY')) = UPPER('".$_POST['brf_mon']."')
		  )
		START WITH f.PARENT IS NULL 
		CONNECT BY PRIOR f.FEATID = f.PARENT
			 )
			 
		START WITH f.PARENT IS NULL 
		CONNECT BY PRIOR f.FEATID = f.PARENT";
		
		
	
	
	$compiled = oci_parse($db, $query);
		oci_execute($compiled);
		while($row = oci_fetch_array($compiled))
		{
			array_push($BD_FT_IDS,$row['BD_FT_IDS'].'='.$row['VALUE']);
		}
		
		if($debug == 1)
			var_dump($BD_FT_IDS);
		
		foreach($_POST as $key => $value)
		{	
			if($debug == 1)
				echo $key.' -> '.$value.'<br>';
		if( /*strpos($key , 'ft_in') >= 0  &&*/ strpos($key , 'ft_in') !== false )
			{
				//echo "found";
				array_push( $INPUT_DATA, ('FEATID'.preg_replace("/[^0-9]/", '', $key).'='.trim($value)) );
			}
		}
		
		if($debug == 1)
			var_dump($INPUT_DATA);
		
		$Sze_In_Arr =  sizeof($INPUT_DATA);
		
		for($i=0; $i<$Sze_In_Arr; $i++)		//LOOP INPUT DATA
		{
			preg_match('~FEATID(.*?)=~', $INPUT_DATA[$i] , $IN_FEAT_ID);		//$IN_FEAT_ID[1]
			$IN_FEAT_VAL = explode("=", $INPUT_DATA[$i]);					//$IN_FEAT_VAL[1]
			
			for($j=0; $j<sizeof($BD_FT_IDS); $j++)	//LOOP DB DATA
			{
				preg_match('~[^&]*~', $BD_FT_IDS[$j] , $OT_BD_ID);		//$OT_BD_ID[0]
				preg_match('~&(.*?)=~', $BD_FT_IDS[$j] , $OT_FEAT_ID);	//$OT_FEAT_ID[1]
				preg_match('~=(.*?)$~', $BD_FT_IDS[$j] , $OT_VAL);		//$OT_VAL[1]
				
				if($debug == 1)
				{	echo $IN_FEAT_ID[1].'---->'.$OT_BD_ID[0].'-----'.$OT_FEAT_ID[1].'------'.$OT_VAL[1];
					echo '<br>';}
				
				if($IN_FEAT_ID[1] == $OT_FEAT_ID[1])			// IF INPUT DATA FEATURE FOUND IN DB
				{
					if($debug == 1)
					{	echo $IN_FEAT_ID[1].'---->'.$OT_BD_ID[0].'-----'.$OT_FEAT_ID[1].'------'.$OT_VAL[1];
						echo '<br>';}
				
				if($IN_FEAT_VAL[1] == $OT_VAL[1])			//IF FEATURE VALUE IN DB IS SAME AS INPUT DATA
					{
						; //DO NOTHING
					}
					
					if($IN_FEAT_VAL[1] != $OT_VAL[1] && strlen($IN_FEAT_VAL[1]) > 0)		//IF FEATURE VALUE IN DB IS NOT SAME AS INPUT DATA AND INPUT DATA IS NOT EMPTY
					{
						//UPDATE VALUE IN DB
						/***************************************************************************************************/
							$query = "UPDATE MMR_BRIEF_DETAIL SET VALUE = '".$IN_FEAT_VAL[1]."' WHERE BDID = '".$OT_BD_ID[0]."'";
							$compiled = oci_parse($db, $query);
							$stid = oci_execute($compiled,OCI_DEFAULT);
							if ($stid) {
			 
							oci_commit($db); //*** Commit Transaction ***//
							//$err = 'true';
							//echo $res = "Data Updated Successfully" ;  //  success msg
							//echo '<br>';
							$upd_count++;
								}
								else
								{	
									// Deubug i.e [Detailed ERROR Messages]
									 
										/*	 $e = oci_error($compiled);  // For oci_execute errors pass the statement handle
											print htmlentities($e['message']);
											print "\n<pre>\n";
											print htmlentities($e['sqltext']);
											printf("\n%".($e['offset']+1)."s", "^");
											print  "\n</pre>\n"; 
											*/
									// End of Deubug
									
									oci_rollback($db); //*** RollBack Transaction ***//  
									$e0 = oci_error($compiled);  
									//$err = 'false';
									//echo $res = "Data not Updated" ;  //  Fail msg
									//echo '<br>';
									$upd_err_count++;
								}
						/***************************************************************************************************/
					}
					
					if(strlen($IN_FEAT_VAL[1]) <= 0)		//IF INPUT DATA IS EMPTY
					{
						//DELETE VALUE ROW FROM DB
						/***************************************************************************************************/
							$query = "DELETE FROM MMR_BRIEF_DETAIL WHERE BDID = '".$OT_BD_ID[0]."' ";
							$compiled = oci_parse($db, $query);
							$stid = oci_execute($compiled, OCI_DEFAULT);
							if($stid)
							{
								oci_commit($db); //*** Commit Transaction ***//
								//echo "Record Deleted. at ".$OT_BD_ID[0];
								//echo '<br>';
								$del_count++;
							}
							else
							{
								oci_rollback($db); //*** RollBack Transaction ***//
								$e1 = oci_error($compiled);  
								//$err = 'false';
								//echo $res = "Fail to Delete Data" ;  //  Fail msg
								//echo '<br>';
								$del_err_count++;
							}
						/***************************************************************************************************/
					}
					
					//REMOVE FEATID FROM INPUT_DATA ARRAY
					unset($INPUT_DATA[$i]);
				}
				
			} 
		}
		//REARRANGE ARRAY INDEX
		 $INPUT_DATA = array_values($INPUT_DATA);
		 if($debug == 1)
			var_dump($INPUT_DATA);
		 
		// die();
		 
		//INSERT REMAINING FEATURES IN DB
		
		for($k=0; $k<sizeof($INPUT_DATA); $k++)
		{
			preg_match('~FEATID(.*?)=~', $INPUT_DATA[$k] , $IN_FEAT_ID);		//$IN_FEAT_ID[1]
			$IN_FEAT_VAL = explode("=", $INPUT_DATA[$k]);					//$IN_FEAT_VAL[1]
			
			if(strlen($IN_FEAT_VAL[1]) > 0)
			{
				if($debug == 1)
					echo $INPUT_DATA[$k].'<br>';
				
			//INSERT INTO DB
			/********************************************************************************************************/
			$query = "INSERT INTO MMR_BRIEF_DETAIL (VALUE , BRID , FEATID) VALUES
				('".$IN_FEAT_VAL[1]."' , '".$BRID."' , '".$IN_FEAT_ID[1]."')";
				
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
				
				//$err = 'false';
				//echo $res = "Fail to Insert Record" ;  //  Fail msg
				//echo '<br>';
				
				$inr_err_count++;
				
				/*		if($e['code']==1)
							$res.="<br> Record Already Exists.";
						else
							$res.="<br>".$e['message'];*/
					}
					else
					{
						$err = 'true';
						//echo $res = "Record Inserted Successfully" ;  //  success msg
						//echo '<br>';
						$inr_count++;
					
					}
			/********************************************************************************************************/
			}
		}
		
		if($inr_count > 0) echo "$inr_count Record(s) Inserted \n";
		if($upd_count > 0) echo "$upd_count Record(s) Updated \n";
		if($del_count > 0) echo "$del_count Record(s) Deleted \n";
		
		if(($inr_count > 0 || $upd_count > 0 || $del_count > 0) && ($inr_err_count > 0 || $upd_err_count > 0 || $del_err_count > 0))
			echo "---------------------------- \r\n";
		
		if($inr_err_count > 0) echo "Fail to Insert $inr_err_count Record(s) \n";
		if($upd_err_count > 0) echo "Fail to Update $upd_err_count Record(s) \n";
		if($del_err_count > 0) echo "Fail to Delete $del_err_count Record(s) \n";
		
		if($inr_count == 0 && $upd_count == 0 && $del_count == 0 && $inr_err_count == 0 && $upd_err_count == 0 && $del_err_count == 0)
			echo "No Changes were made in Data.... \n";
		
?>