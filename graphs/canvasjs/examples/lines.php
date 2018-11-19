<!DOCTYPE HTML>
<html>
<head>
  <script type="text/javascript">
  window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer", {

      title:{
        text: "Fruits sold in First Quarter"
      },
      data: [//array of dataSeries
        { //dataSeries object

         /*** Change type "column" to "bar", "area", "line" or "pie"***/
         type: "line",
         dataPoints: [
		 <?php 		require("../../../dbconnect.php");		
						$query = "SELECT prj_desc,F6 FROM MMR_OUTPUT_PRJ";
						$compiled = oci_parse($db, $query);
						oci_execute($compiled);
						while($row=oci_fetch_array($compiled))
						{
							echo '{ label:'.$row[1].', y:"'. $row[0].'"},';
						
						} 	oci_close($db);
					?>
         ]
       }
       ]
     });

    chart.render();
  }
  </script>
  <script type="text/javascript" src="../dist/canvasjs.js"></script>
</head>
<body>
  <div id="chartContainer" style="height: 300px; width: 100%;">
  </div>
</body>
</html>




