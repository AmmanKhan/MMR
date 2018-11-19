<!DOCTYPE HTML>
<html>
<head>  
<meta charset="UTF-8">
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Top Oil Reserves"
	},
	axisY: {
		title: "Reserves(MMbbl)"
	},
	data: [{        
		type: "column",  
		showInLegend: true, 
		legendMarkerColor: "grey",
		legendText: "SV = Schedule Variance",
		dataPoints: [
<?php 		require("../dbconnect.php");		
			$query = "SELECT PRJ_DESC,F6 FROM MMR_OUTPUT_PRJ";
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

<?php 		require("../dbconnect.php");		
			$query = "SELECT PRJ_DESC,F6 FROM MMR_OUTPUT_PRJ";
			$compiled = oci_parse($db, $query);
			oci_execute($compiled);
			while($row=oci_fetch_array($compiled))
			{
				echo $row[0]."-". $row[1];
			
			} 	oci_close($db);
?>


<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
<script src="../../canvasjs.min.js"></script>
</body>
</html>