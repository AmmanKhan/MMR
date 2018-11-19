<?php 
		require("dbconnect.php");
		/*$query = "SELECT 'FEATID'||f.FEATID as FEATID , coalesce(d.VALUE, 'null') as VALUE
  FROM MMR_FEAT  f
    LEFT JOIN MMR_BRIEF_DETAIL d ON d.FEATID = f.FEATID 
    LEFT JOIN MMR_BRIEF_MASTER m ON m.BRID = d.BRID
    LEFT JOIN MMR_BRIEF_PROJECT p ON p.PRJ_ID = m.PRJ_ID
    WHERE p.PRJ_ID = '".$_GET['prj_id']."'  AND m.BRID = '".$_GET['brf_id']."' OR f.FEATID = ANY(
  SELECT f.PARENT
  FROM MMR_FEAT  f
    LEFT JOIN MMR_BRIEF_DETAIL d ON d.FEATID = f.FEATID 
    LEFT JOIN MMR_BRIEF_MASTER m ON m.BRID = d.BRID
    LEFT JOIN MMR_BRIEF_PROJECT p ON p.PRJ_ID = m.PRJ_ID
    WHERE p.PRJ_ID = '".$_GET['prj_id']."'  AND m.BRID = '".$_GET['brf_id']."'  OR f.FEATID = ANY(
    
                 select DISTINCT f.PARENT as node_parent from MMR_BRIEF_PROJECT p
                LEFT JOIN MMR_BRIEF_MASTER m ON m.PRJ_ID = p.PRJ_ID
                LEFT JOIN MMR_BRIEF_DETAIL d ON d.BRID = m.BRID
                LEFT JOIN MMR_FEAT f ON f.FEATID = d.FEATID
                  where p.PRJ_ID = '".$_GET['prj_id']."' AND m.BRID = '".$_GET['brf_id']."'
      )
    START WITH f.PARENT IS NULL 
    CONNECT BY PRIOR f.FEATID = f.PARENT
         )
         
    START WITH f.PARENT IS NULL 
    CONNECT BY PRIOR f.FEATID = f.PARENT";
	*/
	
	$query = "SELECT 'FEATID'||f.FEATID as FEATID , coalesce(d.VALUE, 'null') as VALUE
  FROM MMR_FEAT  f
    LEFT JOIN MMR_BRIEF_DETAIL d ON d.FEATID = f.FEATID 
    LEFT JOIN MMR_BRIEF_MASTER m ON m.BRID = d.BRID
    LEFT JOIN MMR_BRIEF_PROJECT p ON p.PRJ_ID = m.PRJ_ID
    WHERE p.PRJ_ID = '".$_GET['prj_id']."'  AND UPPER(TO_CHAR(m.FR_MN,'MON-YYYY')) = UPPER('".$_GET['brf_mon']."') OR f.FEATID = ANY(
  SELECT f.PARENT
  FROM MMR_FEAT  f
    LEFT JOIN MMR_BRIEF_DETAIL d ON d.FEATID = f.FEATID 
    LEFT JOIN MMR_BRIEF_MASTER m ON m.BRID = d.BRID
    LEFT JOIN MMR_BRIEF_PROJECT p ON p.PRJ_ID = m.PRJ_ID
    WHERE p.PRJ_ID = '".$_GET['prj_id']."'  AND UPPER(TO_CHAR(m.FR_MN,'MON-YYYY')) = UPPER('".$_GET['brf_mon']."')  OR f.FEATID = ANY(
    
                 select DISTINCT f.PARENT as node_parent from MMR_BRIEF_PROJECT p
                LEFT JOIN MMR_BRIEF_MASTER m ON m.PRJ_ID = p.PRJ_ID
                LEFT JOIN MMR_BRIEF_DETAIL d ON d.BRID = m.BRID
                LEFT JOIN MMR_FEAT f ON f.FEATID = d.FEATID
                  where p.PRJ_ID = '".$_GET['prj_id']."' AND UPPER(TO_CHAR(m.FR_MN,'MON-YYYY')) = UPPER('".$_GET['brf_mon']."')
      )
    START WITH f.PARENT IS NULL 
    CONNECT BY PRIOR f.FEATID = f.PARENT
         )
         
    START WITH f.PARENT IS NULL 
    CONNECT BY PRIOR f.FEATID = f.PARENT";
	
	$result = "";
	
		$compiled = oci_parse($db, $query);
		oci_execute($compiled);
		while($row=oci_fetch_array($compiled))
		{	
			$result.= '{"'.$row['FEATID'].'":"'.$row['VALUE'].'"},';
		}
		echo '['.rtrim($result,',').']';
	?>