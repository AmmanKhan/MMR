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
	
	  background: linear-gradient(to top, #ffffff 11%, #99ccff 104%);
  /*background-color: #e6e6e6;*/
  border: 2px outset;
  border-radius: 3px;
  display: block;
  min-height: 25px;
  line-height: 35px;
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
	 background: linear-gradient(to bottom, #ffffff 11%, #99ccff 104%);
 /* background-color: #e6e6e6;*/
  border: 2px inset;
  border-radius: 3px;
  color: #000;
  display: none;
  left: 0px;
  padding: 2px 15px 2px 5px;
  position: absolute;
   font-family:times new roman;
  width: 650px;
  list-style: none;
  height: 150px;
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
						
						 <div class="col-sm-3"> 
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
									</tr>
								 </table>
							</div>
						 
                            <div class="col-sm-3">
                                <!-- <h2 class="tm-block-title d-inline-block">Search Project Date : </h2>-->
								 <table width="100%" valign="top">
								 <tr>
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
															<input id="chk_prj" type="checkbox" value="<?php echo $row[0];?>" /><?php echo $row[1];?>
														</li>
													<?php 
														}
													?>
												
												</ul>
											</div>										
										</dd>
									  
									</dl>
									
									</td>
									
									 </tr>
									 </table>
								
								
                            </div>
							
							<div class="col-sm-3">
								 <table width="100%" valign="top">
									<tr>
									<td valign="top">
										<input type='radio' name='group' ng-model='mValue' value='AW' />Actual Work <br />
										<input type='radio' name='group' ng-model='mValue' value='VW' />Vetted Work
									</td>
									<td valign="top">
										<button type="button" id="btn_search" class="btn btn-primary">Search Projects</button>
									 </td>
									 </tr>
							 </table>
							</div>
							
                            
                        </div>
                        <div class="table-responsive">
					
						<div id="tb_contents" >
						
						</div>
<table border="0" align="center" width="100%">
		<tr>
			<td>
				<iframe id="ifrm1" src="graphs/project_chart_SV.php" scrolling="no" style="overflow-y: hidden;" height="372px" width="100%"></iframe>
			</td>
			<td>
				<iframe id="ifrm_cv" src="graphs/project_chart_CV.php" scrolling="no" style="overflow-y: hidden;" height="372px" width="100%"></iframe>
			</td>
		</tr>
		<tr>
			<td>
				<iframe id="ifrm_spi" src="graphs/project_chart_SPI.php" scrolling="no" style="overflow-y: hidden;" height="372px" width="100%"></iframe>
			</td>
			<td>
				<iframe id="ifrm_cpi" src="graphs/project_chart_CPI.php" scrolling="no" style="overflow-y: hidden;" height="372px" width="100%"></iframe>
			</td>
		</tr>
</table>



						
                        </div>

                       	
                    </div>
					
					
					
                </div>
	


		
		<!--  <div class="tm-col tm-col-big">
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
		
		-->
	
	<script>
        $(function () {
            $('#from_date').datepicker({ dateFormat: 'dd/mm/yy' });
        });
		$(function () {
            $('#to_date').datepicker({ dateFormat: 'dd/mm/yy' });
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
            lineChart,
        barChart, pieChart;
        // DOM is ready
        $(function () {
            updateChartOptions();
            drawLineChart(); // Line Chart
            drawBarChart(); // Bar Chart
            drawPieChart(); // Pie Chart
            drawCalendar(); // Calendar

            /* $(window).resize(function () {
                updateChartOptions();
                updateLineChart();
                updateBarChart();
                reloadPage();
            }); */
        })
		var iframe = $("#ifrm1").attr('src');
		var iframe1 = $("#ifrm_cv").attr('src');
		var iframe2 = $("#ifrm_spi").attr('src');
		var iframe3 = $("#ifrm_cpi").attr('src');
		$("#btn_search").unbind().click(function()
		{
			var date_from = $("#from_date").val();
			var date_to = $("#to_date").val();
			var get_prj = "";
			
			$(".multiSel").find("span").each(function(){
				get_prj+=$(this).html();
				
			});
			//alert(get_prj.slice(0,-1));
			
			var datastring2 = 'dt_f='+date_from+'&dt_t='+date_to+'&get_p='+get_prj.slice(0,-1);
			$('#tb_contents').html('<center><img src="img/ajax-loader.gif"></center>');
			$.ajax({
						type: "GET",
						url: "project_status_process.php",
						data: datastring2,
						//dataType: "JSON",
						success: function (data) {
							//alert(data);
							
							$('#tb_contents').html(data);
						
							var fgh =  iframe + '?get_project='+get_prj.slice(0,-1);
							$('#ifrm1').attr('src', fgh);
							
							fgh =  iframe1 + '?get_project='+get_prj.slice(0,-1);
							$('#ifrm_cv').attr('src', fgh);
							
							fgh =  iframe2 + '?get_project='+get_prj.slice(0,-1);
							$('#ifrm_spi').attr('src', fgh);
							
							fgh =  iframe3 + '?get_project='+get_prj.slice(0,-1);
							$('#ifrm_cpi').attr('src', fgh);
						
						
						}
					});
			
			
		});
		
		$('#tb_contents').html('<center><img src="img/ajax-loader.gif"></center>');
		$.ajax({
						type: "GET",
						url: "project_status_process.php",
						//data: datastring2,
						//dataType: "JSON",
						success: function (data) {
							//alert(data);
							$('#tb_contents').html(data);
						}
					});
    </script>

             
 
          