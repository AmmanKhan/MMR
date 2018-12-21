<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if ( !isset($_SESSION['user'])) {
	//you are already logged in
  header("Location: index.php");
  exit;
 }

//var_dump($_SESSION);
//error_reporting(0);
require("dbconnect.php");
//$query = 'SELECT GROUP_ID AS "id",TEXT AS "text",PARENT_ID FROM CFG_GROUP ORDER BY PARENT_ID ASC';
				if($_SESSION['groups'] == "999" )
				 {
					$query = 'SELECT FEATID  AS "id", FEATID  || \'--\' || DESCR  AS "text",PARENT AS "PARENT_ID" FROM MMR_FEAT  ORDER BY FEATID  ASC';
				 }
				 else
				 {
					$query = 'SELECT FEATID AS "id",DESCR AS "text",PARENT AS "PARENT_ID"  FROM MMR_FEAT WHERE FEATID IN ('.$_SESSION['groups'].') ORDER BY FEATID ASC';
				 }




 $res = oci_parse($db, $query);

 oci_execute($res);
if (!is_null($res))
{
// $res = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
// iterate on results row and create new index array of data
    while($row = oci_fetch_assoc($res) ) { 
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
   if($item['PARENT_ID'] && isset($itemsByReference[$item['PARENT_ID']]))
      $itemsByReference[$item['PARENT_ID']]['children'][] = &$item;
 
// Remove items that were added to parents elsewhere:
foreach($data as $key => &$item) {
   if($item['PARENT_ID'] && isset($itemsByReference[$item['PARENT_ID']]))
	   unset($data[$key]);
}
// Encode:

//echo str_replace("group_id","id",strtolower(json_encode($data)));
echo json_encode($data);
//var_dump($data);

}
    
?>