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
		text: "Schedule Performance Index"
	},	
	axisY:{
		includeZero: false,
		gridColor: "black",
		gridThickness: 1,
		gridDashType: "dash"
	},
	data: [{        
		type: "line",       
		dataPoints: [
					<?php 		
						
						require("../dbconnect.php");	

						if(isset($_GET["get_project"]))
						{
							$query = "SELECT ot.prj_desc,ot.F6 FROM MMR_OUTPUT_PRJ ot LEFT JOIN MMR_BRIEF_MASTER  bm ON bm.Brid = ot.brid WHERE bm.prj_id IN (".$_GET["get_project"].") ";
						}
						else
						{
							$query = "SELECT prj_desc,F6 FROM MMR_OUTPUT_PRJ";
						}	
						$compiled = oci_parse($db, $query);
						oci_execute($compiled);
						while($row=oci_fetch_array($compiled))
						{
							echo '{ y:'.$row[1].', indexLabel:"'. $row[0].'",indexLabelFontSize: 12,indexLabelMaxWidth:50},';
						
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
<div id="chartContainer" style="height: 370px; max-width: 100%; margin: 0px auto;">
</div>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="canvasjs/dist/jquery.canvasjs.min.js"></script>

</body>
</html>