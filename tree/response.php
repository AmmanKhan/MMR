<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/* $node = 5;
$nodeText = 'HELLO';
$sql = "INSERT INTO CFG_GROUP_LOG (ACTION,U_ID)  VALUES  ('Rename GP_ID:".$node."Name:".$nodeText."','145')";
echo $sql;
exit; */


if ( !isset($_SESSION['user'])) {
	//you are already logged in
  header("Location: index.php");
  exit;
 }

 $stid = "";
require("dbconnect.php");
if(isset($_GET['operation'])) {
	try {
		$result = null;
		
		switch($_GET['operation']) {
			case 'get_node':
				$node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
				
				if($_SESSION['groups'] == "999" )
				{
					$sql = 'SELECT FEATID AS "id",DESCR  AS "text",PARENT  AS "parent_id" FROM MMR_FEAT  ORDER BY FEATID ASC';
				}
				else
				{
					$sql = 'SELECT FEATID AS "id",DESCR  AS "text",PARENT  AS "parent_id" FROM MMR_FEAT  WHERE FEATID IN ('.$_SESSION['groups'].') ORDER BY FEATID ASC';
				}
				
				
				$res = oci_parse($db, $sql);
				oci_execute($res);
 
				if(is_null($res)){
				 //add condition when result is zero
				} else {
					//iterate on results row and create new index array of data
					while( $row = oci_fetch_assoc($res) ) { 
						$data[] = $row;
					}
					$itemsByReference = array();

				// Build array of item references:
				foreach($data as $key => &$item) {
				   $itemsByReference[$item['id']] = &$item;
				   // Children array:
				   $itemsByReference[$item['id']]['children'] = array();
				   // Empty data class (so that json_encode adds "data: {}" ) 
				   $itemsByReference[$item['id']]['data'] = new StdClass();
				}

				// Set items as children of the relevant parent item.
				foreach($data as $key => &$item)
				   if($item['parent_id'] && isset($itemsByReference[$item['parent_id']]))
					  $itemsByReference [$item['parent_id']]['children'][] = &$item;

				// Remove items that were added to parents elsewhere:
				foreach($data as $key => &$item) {
				   if($item['parent_id'] && isset($itemsByReference[$item['parent_id']]))
					  unset($data[$key]);
				}
				}
				$result = $data;
				//oci_close($db);
				break;
			case 'create_node':				//Create Node
				$node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
				
				$nodeText = isset($_GET['text']) && $_GET['text'] !== '' ? $_GET['text'] : '';
				$sql ="INSERT INTO MMR_FEAT  (DESCR, PARENT) VALUES('".$nodeText."', '".$node."')  returning FEATID into :id";
				$query = oci_parse($db, $sql);
				oci_bind_by_name($query,":id",$id,-1,SQLT_INT);
				$stid = oci_execute($query, OCI_NO_AUTO_COMMIT);
				
				if (!$stid){
						oci_rollback($db);						
					}else
					{
						$sql = "INSERT INTO CFG_GROUP_LOG (ACTION,U_ID)  VALUES  ('Crtd GP_ID:".$id.",Name:".$nodeText."','".$_SESSION['userid']."')";
						$query = oci_parse($db, $sql);
						$stid = oci_execute($query, OCI_NO_AUTO_COMMIT);
						if (!$stid){
							oci_rollback($db);		
						}else
						{
							oci_commit($db);
						}
					}
				$result = array('id' => "$id");
				echo json_encode($result);die;
				//oci_close($db);
				break;
			case 'rename_node':			//Rename Node
				$node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
				//print_R($_GET);
				$nodeText = isset($_GET['text']) && $_GET['text'] !== '' ? $_GET['text'] : '';
				$sql ="UPDATE MMR_FEAT  SET DESCR  ='".$nodeText."' WHERE FEATID  = '".$node."'";
				$compiled = oci_parse($db, $sql);
				$stid = oci_execute($compiled,OCI_NO_AUTO_COMMIT);
				
				if (!$stid){
						oci_rollback($db);						
					}else
					{
				
						$sql = "INSERT INTO CFG_GROUP_LOG (ACTION,U_ID)  VALUES  ('Rename GP_ID:".$node.",Name:".$nodeText."','".$_SESSION['userid']."')";
						//echo $sql;
						//exit;
						$query = oci_parse($db, $sql);
						$stid = oci_execute($query,OCI_NO_AUTO_COMMIT);
						
						if (!$stid){
							oci_rollback($db);		
						}else
						{
							oci_commit($db);
						}
						
					}
	 
				
				break;
			case 'delete_node':				//Delete Node
				$node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
				//$query1 = "SELECT FEATID  FROM CFG_SMS_GROUP_CONTACT_MAP gr WHERE gr.GROUP_ID = '".$node."'";
				$query2 = "SELECT FEATID  FROM MMR_FEAT gr WHERE gr.PARENT = '".$node."'";
				//$query1 = oci_parse($db, $query1);
				//$stid = oci_execute($query1,OCI_DEFAULT);
				//$row = oci_fetch_assoc($query1);
				//if($row == "") {
					//oci_free_statement($query1);
					
					$query2 = oci_parse($db, $query2);
					$stid = oci_execute($query2,OCI_DEFAULT);
					$row1 = oci_fetch_assoc($query2);
					
					if($row1 == "")
					{
						oci_free_statement($query2);
						$sql ="DELETE FROM MMR_FEAT WHERE FEATID = '".$node."'";
						$compiled = oci_parse($db, $sql);
						$stid = oci_execute($compiled,OCI_DEFAULT);
						if (!$stid){
						oci_rollback($db);						
						}else
						{
				
							$sql = "INSERT INTO CFG_GROUP_LOG (ACTION,U_ID)  VALUES  ('Del GP_ID:".$node."','".$_SESSION['userid']."')";
							$query = oci_parse($db, $sql);
							$stid = oci_execute($query,OCI_NO_AUTO_COMMIT);
							if (!$stid){
								oci_rollback($db);		
							}else
							{
								oci_commit($db);
							}
						
						 }
					}
					
				//}
				break;
			case 'paste_node':
				$node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
				$nodeText = isset($_GET['text']) && $_GET['text'] !== '' ? $_GET['text'] : '';
				$node_p = isset($_GET['parent']) && $_GET['parent'] !== '#' ? (int)$_GET['parent'] : 0;
				$sql ="UPDATE MMR_FEAT  SET PARENT ='".$node_p."' WHERE FEATID = '".$node."'";
				$compiled = oci_parse($db, $sql);
				$stid = oci_execute($compiled,OCI_NO_AUTO_COMMIT);
				if (!$stid){
					oci_rollback($db);		
				}else
				{
					$sql = "INSERT INTO CFG_GROUP_LOG (ACTION,U_ID)  VALUES  ('Paste GP_ID:".$node."Group ID:".$node_p.",Name:".$nodeText."','".$_SESSION['userid']."')";
						$query = oci_parse($db, $sql);
						$stid = oci_execute($query, OCI_NO_AUTO_COMMIT);
						if (!$stid){
							oci_rollback($db);		
						}else
						{
							oci_commit($db);
						}
				}
				break;
				
			default:
				throw new Exception('Unsupported operation: ' . $_GET['operation']);
				break;
		}
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($result);
	}
	catch (Exception $e) {
		header($_SERVER["SERVER_PROTOCOL"] . ' 500 Server Error');
		header('Status:  500 Server Error');
		echo $e->getMessage();
	}
	die();
}


?>
