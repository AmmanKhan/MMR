<!DOCTYPE HTML>
<html>
<head>  
<meta charset="UTF-8">
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light1",
	title:{
		text: "Cost Performance Index"
	},
	
	axisY:{
		includeZero: false,
		titleFontSize: 2,
		gridColor: "black",
		gridThickness: 1,
		gridDashType: "dash"
	},
	data: [{        
		type: "line", 
		dataPoints: [
					<?php 		require("../dbconnect.php");


						//if(isset($_GET["get_project"]))
							if(isset($_GET["get_project"]) && !EMPTY($_GET["get_project"]))
						{
							$query = "SELECT ot.prj_desc,ot.F10, bm.FR_MN FROM MMR_OUTPUT_PRJ ot LEFT JOIN MMR_BRIEF_MASTER  bm ON bm.Brid = ot.brid WHERE bm.prj_id IN (".$_GET["get_project"].") AND bm.brid IN (".$_GET["brid"].") ";
						}
						else
						{
							$query = "SELECT ot.prj_desc,ot.F10, bm.FR_MN FROM MMR_OUTPUT_PRJ ot LEFT JOIN MMR_BRIEF_MASTER  bm ON bm.Brid = ot.brid ";
						}	
						//$query = "SELECT prj_desc,F10 FROM MMR_OUTPUT_PRJ";
						$compiled = oci_parse($db, $query);
						oci_execute($compiled);
						while($row=oci_fetch_array($compiled))
						{
							echo '{ y:'.$row[1].', indexLabel:"'. $row[0] .' ('.$row[2].')" ,indexLabelFontSize: 12,indexLabelMaxWidth:50},';
						
						} 	oci_close($db);
					?>
					
		
		
		/*	{ y: 450 },
			{ y: 414},
			{ y: 520, indexLabel: "highest",markerColor: "red", markerType: "triangle" },
			{ y: 460 },
			{ y: 450 },
			{ y: 500 },
			{ y: 480 },
			{ y: 480 },
			{ y: 410 , indexLabel: "lowest",markerColor: "DarkSlateGrey", markerType: "cross" },
			{ y: 500 },
			{ y: 480 },
			{ y: 510 }*/
		]
	}]
});
chart.render();

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; max-width: 650px; margin: 0px auto;">
</div>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="canvasjs/dist/jquery.canvasjs.min.js"></script>

</body>
</html>