<style>
.dropdown1 dd,
.dropdown1 dt {
  margin: 0px;
  padding: 0px;
}

.dropdown1 ul {
  margin: -1px 0 0 0;
}

.dropdown1 dd {
  position: relative;
}

.dropdown1 a,
.dropdown1 a:visited {
  color: #000;
  text-decoration: none;
  outline: none;
  font-family:times new roman;
}

.dropdown1 dt a {
  background-color: #e6e6e6;
  display: block;
  min-height: 25px;
  line-height: 22px;
  overflow: hidden;
  border: 0;
  width: 300px;
}

.dropdown1 dt a span,
.multiSel span {
  cursor: pointer;
  display: inline-block;
  padding: 0 3px 2px 0;
}

.dropdown1 dd ul {
  background-color: #e6e6e6;
  border: 0;
  color: #000;
  display: none;
  left: 0px;
  padding: 2px 15px 2px 5px;
  position: absolute;
   font-family:times new roman;
  width: 650px;
  list-style: none;
  height: 100px;
  overflow: auto;
}

.dropdown1 span.value {
  display: none;
}

.dropdown1 dd ul li a {
  
  display: block;
}

.dropdown1 dd ul li a:hover {
  background-color: #fff;
}

</style>
            <!-- row -->
                <div class="col-xl-12 col-lg-12 tm-md-12 tm-sm-12 tm-col">
                    <div class="bg-white tm-block h-100">
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <!-- <h2 class="tm-block-title d-inline-block">Search Project Date : </h2>-->
								 <div>
								 <table width="100%" valign="top">
								 <tr>
									<td>
                                    <input placeholder="From Date"  id="from_date" name="from_date" type="text" class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7"
                                        data-large-mode="true">
									</td>
									</td>
									<td>
									
									
									<input placeholder="To Date"  id="to_date" name="to_date" type="text" class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7"
                                        data-large-mode="true">
									</td>
									
									<!--<select multiple="multiple" class="custom-select col-xl-6 col-lg-8 col-md-8 col-sm-7" id="category">
                                        <option value="1" selected="">Project List</option>
                                        <option value="2">Const of Shabozai (N-70) to Drug Taunsa (N-55) Rd (Pkg-I & II)-68 Km</option>
                                        <option value="3">Widening of Samungli-Khojak Rd at Qta -10 Km</option>
                                    </select>-->
									<td valign="top">
									<dl class="dropdown1"> 
  
										<dt>
										<a href="#">
										  <span class="hida"><h6>Please Select Projects</h6></span>    
										  <p class="multiSel"></p>  
										</a>
										</dt>
									  
										<dd>
											<div class="mutliSelect">
												<ul>
													<?php 
														require("dbconnect.php");
														$query = "SELECT PRJ_ID,PROJTITLE FROM MMR_BRIEF_PROJECT";
														$compiled = oci_parse($db, $query);
														oci_execute($compiled);
														while($row=oci_fetch_array($compiled))
														{	
													?>
														<li>
															<input type="checkbox" value="<?php echo $row[0];?>" /><?php echo $row[1];?>
														</li>
													
													<?php 
														} 
														
													?>
												
												</ul>
											</div>										
										</dd>
									  
									</dl>
									
									</td>
									<td valign="top">
									 <button type="button" id="btn_output" class="btn btn-primary">Search Projects</button>
									 </td>
									 </tr>
									 </table>
								 </div>	
								
                            </div>
                            
                        </div>
                        <div class="table-responsive">
                            <table border="1" width="100%" id="tb_out" class="table table-hover table-striped tm-table-striped-even mt-3">
                                <thead>
                                    <tr class="tm-bg-gray"> 
                                        <th scope="col">Feature</th>
                                        <th id="21" scope="col">P1</th>
                                        <th id="24" scope="col">P2</th>
                                        <th id="42" scope="col">P3</th>
                                        <th id="43" scope="col">P4</th>
										<th id="1" scope="col">P5</th>
                                        <th id="1" scope="col">P6</th>
										<th id="1" scope="col">P7</th>
										<th id="1" scope="col">P8</th>
										<th id="1" scope="col">P9</th>
										<th id="1" scope="col">P10</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
									/*$query = "SELECT COMBINATION_ID,FEATURES,P1,P2,P3,P4,P5,P6,P7,P8,P9,P10,FEATID FROM MMR_OUTPUT";*/
									$query = "SELECT COMBINATION_ID,PRJ_DESC,F1,F2,F3,F4,F5,F6,F7,F8,F9,F10,F11,F12,F13,F14,F15 FROM MMR_OUTPUT";
									
									$compiled = oci_parse($db, $query);
									oci_execute($compiled);
									while($row=oci_fetch_array($compiled))
									{	
											
										echo "<tr id='".$row[12]."'>";
										echo "<td>".$row[1]."</td>";
										echo "<td>".$row[2]."</td>";
										echo "<td>".$row[3]."</td>";
										echo "<td>".$row[4]."</td>";
										echo "<td>".$row[5]."</td>";
										echo "<td>".$row[6]."</td>";
										echo "<td>".$row[7]."</td>";
										echo "<td>".$row[8]."</td>";
										echo "<td>".$row[9]."</td>";
										echo "<td>".$row[10]."</td>";
										echo "<td>".$row[11]."</td>";
										echo "<td>".$row[12]."</td>";
										echo "<td>".$row[13]."</td>";
										echo "<td>".$row[14]."</td>";
										echo "<td>".$row[15]."</td>";
										echo "<td>".$row[16]."</td>";
										
										//echo "<td>".$row[12]."</td>";
										echo "</tr>";
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
                        </div>

                       
                    </div>
                </div>
		
		
		  <div class="tm-col tm-col-big">
                    <div class="bg-white tm-block h-100">
                        <h2 class="tm-block-title">Project TimeLine</h2>
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
                <div class="tm-col tm-col-big">
                    <div class="bg-white tm-block h-100">
                        <h2 class="tm-block-title">Project Performance</h2>
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
                <div class="tm-col tm-col-small">
                    <div class="bg-white tm-block h-100">
                        <canvas id="pieChart" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
		 <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/moment.min.js"></script>
    <!-- https://momentjs.com/ -->
    <script src="js/utils.js"></script>
    <script src="js/Chart.min.js"></script>
    <!-- http://www.chartjs.org/docs/latest/ -->
    <script src="js/fullcalendar.min.js"></script>
    <!-- https://fullcalendar.io/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script src="js/tooplate-scripts.js"></script>
    
	 <script src="js/jquery-3.3.1.min.js"></script>
		
	
	<script>
      
		$('#btn_output').click(function() {
			$('#tb_out tr').each(function() {
				//if (!this.rowIndex) return; // skip first row
				var rowValue = this.cells[0].innerHTML;
				alert(rowValue);
			});
		});
		
		
$(".dropdown1 dt a").on('click', function() {
  $(".dropdown1 dd ul").slideToggle('fast');
});

$(".dropdown1 dd ul li a").on('click', function() {
  $(".dropdown1 dd ul").hide();
});

function getSelectedValue(id) {
  return $("#" + id).find("dt a span.value").html();
}

$(document).bind('click', function(e) {
  var $clicked = $(e.target);
  if (!$clicked.parents().hasClass("dropdown1")) $(".dropdown1 dd ul").hide();
});

$('.mutliSelect input[type="checkbox"]').on('click', function() {

  var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
    title = $(this).val() + ",";

  if ($(this).is(':checked')) {
    var html = '<span title="' + title + '">' + title + '</span>';
    $('.multiSel').append(html);
    $(".hida").hide();
  } else {
    $('span[title="' + title + '"]').remove();
    var ret = $(".hida");
    $('.dropdown1 dt a').append(ret);

  }
});
 
        var ctxLine,
            ctxBar,
            ctxPie,
            optionsLine,
            optionsBar,
            optionsPie,
            configLine,
            configBar,
            configPie,
            lineChart;
        barChart, pieChart;
        // DOM is ready
        $(function () {
            updateChartOptions();
            drawLineChart(); // Line Chart
            drawBarChart(); // Bar Chart
            drawPieChart(); // Pie Chart
            drawCalendar(); // Calendar

            $(window).resize(function () {
                updateChartOptions();
                updateLineChart();
                updateBarChart();
                reloadPage();
            });
        })
    </script>

             
 
          