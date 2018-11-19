<!DOCTYPE HTML>
<html>
<head>  
<meta charset="UTF-8">
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "theme3", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Schedule Variance"
	},
	axisX:{
         labelFontSize: 10,
		 labelAngle: 0,
		 labelMaxWidth: 80,
		 labelFontWeight: "bold",	//“lighter”, “normal”, “bold” , “bolder” 
		 //labelAutoFit: true,
      },
	axisY: {
		//title: "Project Forecasting",
		gridColor: "black",
		gridThickness: 1,
		gridDashType: "dash"
	},
	data: [{        
		type: "column",  
		showInLegend: false, 
		legendMarkerColor: "grey",
		legendText: "SV = Schedule Variance",
		dataPoints: [
<?php 		require("../dbconnect.php");	
	
	
			if(isset($_GET["get_project"]))
			{
				$query = "SELECT ot.prj_desc,ot.F6 FROM MMR_OUTPUT_PRJ  ot LEFT JOIN MMR_BRIEF_MASTER  bm ON bm.Brid = ot.brid WHERE bm.prj_id IN (".$_GET["get_project"].") ";
			}
			else
			{
				$query = "SELECT prj_desc,F6 FROM MMR_OUTPUT_PRJ";
			}
			$compiled = oci_parse($db, $query);
			oci_execute($compiled);
			while($row=oci_fetch_array($compiled))
			{
				echo '{ y:'.$row[1].', label:"'. $row[0].'"},';
			
			} 	oci_close($db);
?>
			/*{ y: 300878, label: "Venezuela" },
			{ y: 266455,  label: "Saudi" },
			{ y: 169709,  label: "Canada" },
			{ y: 158400,  label: "Iran" },
			{ y: 142503,  label: "Iraq" },
			{ y: 101500, label: "Kuwait" },
			{ y: 97800,  label: "UAE" },
			{ y: 80000,  label: "Russia" }*/
		]
	}]
});
chart.render();

}
</script>
</head>
<body>



<div id="chartContainer" style="height: 370px; margin: 0px auto;">
</div>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="canvasjs/dist/jquery.canvasjs.min.js"></script>
</body>
</html>






