	 
	 <style type="text/css">
	 		
		.pad_zro	{padding:5px;}
		.mrgn_zro	{margin:5px;}
		.mrgn_btm_zro	{margin-bottom:0px;}
		.fnt_bld		{font-weight:bold;}
		.het_unst		{height:unset;}
		.fnt_clr_rd		{color:red;}
		/************************************/
		#myModal .modal-dialog {
			-webkit-transform: translate(0,-50%);
			-o-transform: translate(0,-50%);
			transform: translate(0,-50%);
			top: 50%;
			margin: 0 auto;
		}
		
		/* FANCY COLLAPSE PANEL STYLES */
			.fancy-collapse-panel .panel-default > .panel-heading {
			padding: 0;

			}
			.fancy-collapse-panel .panel-heading a {
			padding: 8px 35px 8px 50px;
			display: inline-block;
			width: 100%;
			/*background-color: #EE556C;
			color: #ffffff;*/
			background-color: #e6eaec;
			color: #000000;
			position: relative;
			text-decoration: none;
			}
			.fancy-collapse-panel .panel-heading a:before {
			font-family: "FontAwesome";
			content: "\f147";
			position: absolute;
			left: 20px;
			font-size: 20px;
			font-weight: bold;
			top: 50%;
			line-height: 1;
			margin-top: -10px;
			/*margin-right:5px;*/
			}

			.fancy-collapse-panel .panel-heading a.collapsed:before {
			content: "\f196";
			}
		
      </style>
	<button id="info" class="btn"> Info </button>
	<fieldset id="field_info" style="font-size:12px;font-family:verdana;">
						<?php 		require("dbconnect.php");		
											$query = "SELECT DESCR,ACRONYM FROM MMR_FEAT WHERE ACRONYM IS NOT NULL ORDER BY FEATID ASC";
											$compiled = oci_parse($db, $query);
											oci_execute($compiled);
											echo "<ul>";
											//$count = 0;
											while($row=oci_fetch_array($compiled))
											{//$count++;
											?>
											<li>
												<?php echo $row[1]."-". $row[0];?>
											</li>
											 
											<?php 
											/*if($count == 3)
												{
													echo "</ul><ul class='col-sm-6'>";
												}*/
											} 	
											echo "</ul>";											
											?>
	</fieldset>
	
	   
				

					
					
					
					
					
<table class="table table-hover table-striped tm-table-striped-even mt-3" >
                                <thead>
                                    <tr class="tm-bg-gray">
                                        <th scope="col">Projects</th>
										<th scope="col"></th>
										
                                        <th scope="col"><button class="btn" data-toggle="tooltip" data-placement="top" title="Budget at Completion (BAC)">F1</button></th>
                                        <th scope="col"><button class="btn" data-toggle="tooltip" data-placement="top" title="Planned Value (PV)">F2</button></th>
                                        <th scope="col"><button class="btn" data-toggle="tooltip" data-placement="top" title="Earned Value (EV)">F3</button></th>
                                        <th scope="col"><button class="btn" data-toggle="tooltip" data-placement="top" title="Actal Cost (AC)">F4</button></th>
										<th scope="col"><button class="btn" data-toggle="tooltip" data-placement="top" title="Project Duration">F5</button></th>
                                        <th scope="col"><button class="btn" data-toggle="tooltip" data-placement="top" title="Schedule Variance (SV)">F6</button></th>
										<th scope="col"><button class="btn" data-toggle="tooltip" data-placement="top" title="Schedule Performance Index (SPI)">F7</button></th>
										<th scope="col"><button class="btn" data-toggle="tooltip" data-placement="top" title="Time Estimate to Complete (ETCt)">F8</button></th>
										<th scope="col"><button class="btn" data-toggle="tooltip" data-placement="top" title="Cost Variance (CV)">F9</button></th>
										<th scope="col"><button class="btn" data-toggle="tooltip" data-placement="top" title="Cost Performance Index (CPI)">F10</button></th>
										<th scope="col"><button class="btn" data-toggle="tooltip" data-placement="top" title="Estimate at Completion (EAC)">F11</button></th>
										<th scope="col"><button class="btn" data-toggle="tooltip" data-placement="top" title="Estimate to Complete (ETC)">F12</button></th>
										<th scope="col"><button class="btn" data-toggle="tooltip" data-placement="top" title="To-Complete Performance Index (TCPI)">F13</button></th>
										<th scope="col"><button class="btn" data-toggle="tooltip" data-placement="top" title="Variance at Completion">F14</button></th>
										<th scope="col"></th>
										
                                    </tr>
                                </thead>
                                <tbody>
								
								<?php
								
								if(isset($_GET["dt_f"]) || isset($_GET["dt_t"]) || isset($_GET["get_p"]))
								{
									//echo $_GET["dt_f"]."".$_GET["dt_t"]."".$_GET["get_p"];
									//echo "AMMAN";
									//exit("Unable to connect to $site");
									//$query = "SELECT COMBINATION_ID,PRJ_DESC,F1,F2,F3,F4,F5,F6,F7,F8,F9,F10,F11,F12,F13,F14,F15 FROM MMR_BRIEF_MASTER bm LEFT JOIN MMR_OUTPUT_PRJ opr ON bm.prj_id = opr  WHERE prj_id = ''";
									$query = "SELECT COMBINATION_ID,PRJ_DESC,F1,F2,F3,F4,F5,F6,F7,F8,F9,F10,F11,F12,F13,F14,F15
											  FROM MMR_OUTPUT_PRJ j LEFT JOIN  MMR_BRIEF_MASTER m ON m.BRID = j.BRID
											  LEFT JOIN MMR_BRIEF_PROJECT prj ON     m.PRJ_ID = prj.PRJ_ID  
											  LEFT JOIN 
											  WHERE m.PRJ_ID IN (".$_GET["get_p"].")  ";
											//WHERE m.PRJ_ID IN ('".$_GET["get_p"]."') or ( TO_DATE(FR_MN, 'dd/mm/yy') BETWEEN TO_DATE('".$_GET["dt_f"]."', 'dd/mm/yy') AND TO_DATE('".$_GET["dt_t"]."', 'dd/mm/yy'))";
												
											  //WHERE m.PRJ_ID IN ('')  OR  ( TO_DATE(PRJ_FRM, 'dd/mm/yy') >= TO_DATE('".$_GET["dt_f"]."', 'dd/mm/yy') AND TO_DATE(PRJ_To, 'dd/mm/yy') <= TO_DATE(,'dd/mm/yy'))";
											  //WHERE m.PRJ_ID IN (".$_GET["get_p"].")  ";
											  // WHERE m.PRJ_ID IN (42,24)  AND  ( TO_DATE(PRJ_FRM, 'dd/mm/yy') >= TO_DATE('01/06/2018', 'dd/mm/yy') OR TO_DATE(PRJ_To, 'dd/mm/yy') <= TO_DATE('30/11/2018','dd/mm/yy'));
											  //PRJ_FRM >= TO_DATE('2014/02/01', 'yyyy/mm/dd') AND PRJ_To <= TO_DATE('2014/02/28','yyyy/mm/dd');
											  
								}
								else
								{
									$query = "SELECT COMBINATION_ID,PRJ_DESC,F1,F2,F3,F4,F5,F6,F7,F8,F9,F10,F11,F12,F13,F14,F15 FROM MMR_OUTPUT_PRJ";
								}
									
								$compiled = oci_parse($db, $query);
									oci_execute($compiled);
									while($row=oci_fetch_array($compiled))
									{	echo "<tr>";
										echo "<td colspan='2'><a href='#' data-toggle='modal' data-target='#myModal'><img src='img/notifys.jpg' /></a>".$row[1]."</td>";
										echo "<td style=' background: linear-gradient(to top, #ffffff 11%, #99ccff 104%);'>".$row[2]."</td>";
										echo "<td style=' background: linear-gradient(to top, #ffffff 11%, #99ccff 104%);'>".$row[3]."</td>";
										echo "<td style=' background: linear-gradient(to top, #ffffff 11%, #99ccff 104%);'>".$row[4]."</td>";
										echo "<td style=' background: linear-gradient(to top, #ffffff 11%, #99ccff 104%);'>".$row[5]."</td>";
										echo "<td style=' background: linear-gradient(to top, #ffffff 11%, #99ccff 104%);'>".$row[6]."</td>";
										echo "<td>".$row[7]."</td>";
										echo "<td>".$row[8]."</td>";
										echo "<td>".$row[9]."</td>";
										echo "<td>".$row[10]."</td>";
										echo "<td>".$row[11]."</td>";
										echo "<td>".$row[12]."</td>";
										echo "<td>".$row[13]."</td>";
										echo "<td>".$row[14]."</td>";
										echo "<td>".$row[15]."</td>";
										//echo "<td>".$row[16]."</td>";
										echo "<td><a href='#'><img src='img/print.png' title='Do you want to print this report.'/></a></td>";
										
										echo "</tr>";
										
											 //<!-- The modal -->
				echo '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modalLabelLarge" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="modalLabelLarge">Pattern No.</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								</div>

							<div class="modal-body">
							Features Goes Here........
							</div>

							</div>
						</div>
					</div>';
										
										
									}oci_close($db);
								
								?>
								
                                  <!--  <tr>
                                        <td>
                                           Budget at Completion (BAC)
                                        </td>
                                        <td >122</td>
                                        <td >145</td>
                                        <td >255</td>
                                        <td>201</td>
                                        <td>321</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Schedule Variance (SV)
                                        </td>
                                        <td>243</td>
                                        <td>240</td>
                                        <td>260</td>
                                        <td>201</td>
                                        <td>23</td>
                                    </tr>-->
                                   
                                    
                                </tbody>
                            </table>
							
							
							<script>
							
							$(document).ready(function() {
							  var par = $('#field_info');
							  $(par).hide();
							  
							  $('#info').click(function(e) {
								  $(par).slideToggle('slow');
								  e.preventDefault();
							  });
							});
							
							
							
								/*$("#info").click(function(){
									$( "#field_info" ).slideToggle('slow');
								});*/
								
								$('[data-toggle="tooltip"]').tooltip(); 
							</script>