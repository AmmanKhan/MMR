
		<style>
		.pad_zro	{padding:5px;}
		.mrgn_zro	{margin:5px;}
		.mrgn_btm_zro	{margin-bottom:0px;}
		.fnt_bld		{font-weight:bold;}
		.het_unst		{height:unset;}
		.fnt_clr_rd		{color:red;}
		.rd_only		{background-color:#17a2b83b;}
		/************************************/
		#myModal .modal-dialog {
			-webkit-transform: translate(0,-50%);
			-o-transform: translate(0,-50%);
			transform: translate(0,-50%);
			top: 50%;
			margin: 0 auto;
		}
		</style>
				<div class="tm-col col-12">
                    <div class="bg-white tm-block h-100">
						<h2 class="tm-block-title">Add/Edit Project  <b class="fnt_bld fnt_clr_rd">Brief</b></h2>
			<div class="row">
		<div class="col-6">
							
				
				<div class="form-group">
				<label for="dpname" class="mrgn_btm_zro fnt_bld">Select Project</label>
					<div class="input-group">
						
						<select id="dpname" name="dpname" class="form-control validate mrgn_btm_zro pad_zro het_unst">
							<option>Select One</option>
							<?php 
								require("dbconnect.php");
								$query = "SELECT PRJ_ID,PROJTITLE FROM MMR_BRIEF_PROJECT";
								$compiled = oci_parse($db, $query);
								oci_execute($compiled);
								while($row=oci_fetch_array($compiled))
								{	
							?>
								<option value="<?php echo $row['PRJ_ID'];?>"><?php echo $row['PROJTITLE'];?></option>
							<?php 
								}
							?>
						</select>
						<!-- <div class="input-group-append">
							<button id="dprj_rfsh" class="btn btn-outline-secondary" type="button">Refresh</button>
						  </div> -->
					</div>
				</div>
				
				
				<div class="form-group">
					<label for="s_date" class="mrgn_btm_zro fnt_bld">Upto</label>
					<input placeholder="Select Month" id="s_date" name="s_date" type="text" readonly class="mrgn_btm_zro form-control validate pad_zro het_unst">
				</div>
				
					
				</div>		
				<div class="col-6"style="border: 1px dashed grey;">
					<center><h5 style="font-weight:bold;">Project History</h5></center>
					<div id="prj_hstry">
					</div>
				</div>
			</div>
			
			
			
			
			<form id="prj_featrs">	
				<ul class="nav nav-tabs">
				<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab">Sheet 1</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-2" role="tab">Sheet 2</a></li>
			  </ul>
			  
		<div class="card card-tabs-1">
			<div class="card-block">
				  <div class="tab-content" id="tab_features">
					<div class="tab-pane active" id="tab-1">
						
					<br><br><center>
					  <div class="table-responsive table-sm" style="width: 95%;">
						<table class="table">
						<thead class="thead-dark">
						<tr>
						<th style="white-space: nowrap; width: 1%; display:none;">Feature ID</th>
						<th style="white-space: nowrap; width: 1%;">Features</th>
						<th style="white-space: nowrap; width: 1%; display:none;">Level</th>
						<th style="white-space: nowrap; width: 100%;">Value</th>
						</tr>
						</thead>
						<tbody>


						
					  <?php
						
						require("dbconnect.php");
					$query = "SELECT Lpad(f.DESCR,Length(f.DESCR) + LEVEL * 5 - 5,' ') as FEATR, f.FEATID , LEVEL  FROM MMR_FEAT  f
						WHERE f.PATTERN = 'P1'
						START WITH f.PARENT IS NULL 
						CONNECT BY PRIOR f.FEATID = f.PARENT";
								$compiled = oci_parse($db, $query);
								oci_execute($compiled);
								while($row=oci_fetch_array($compiled))
								{	
							?>
							<tr>
								<td style="display:none;"><?php echo $row['FEATID'];?></td>
								<td style="padding:0px;"><pre style="font-family: verdana; font-size:15px; margin-bottom: 0px; <?php if($row['LEVEL'] == 1) echo "font-weight: bold;";?>"><?php echo $row['FEATR'];?></pre></td>
								<td style="display:none;"><?php echo $row['LEVEL'];?></td>
								<td style="padding:1px; padding-left:20px;">
								<?php if($row['LEVEL'] != 1 || $row['FEATID'] == 112){if($row['FEATID'] == 112) 
									echo '<textarea disabled class="rm_dis" id="ft_in'.$row['FEATID'].'" name="ft_in'.$row['FEATID'].'" style="width: 100%; min-height:100px;"></textarea>'; 
								else 
								echo '<input disabled class="rm_dis" id="ft_in'.$row['FEATID'].'" name="ft_in'.$row['FEATID'].'" type="text">'; }?></td>
							<tr>
							<?php 
								}
							?>
							</tbody>
						</table>
						<div class="form-group">
						<button disabled type="button" class="sub_frm_val rm_dis fnt_bld col-12 btn btn-secondary">Submit</button>
						</div>
						</div>
						
						</center>
					</div>
					
					<div class="tab-pane" id="tab-2">
					  
					  <br><br><center>
					  <div class="table-responsive table-sm" style="width: 95%;">
						<table class="table">
						<thead class="thead-dark">
						<tr>
						<th style="white-space: nowrap; width: 1%; display:none;">Feature ID</th>
						<th style="white-space: nowrap; width: 1%;">Features</th>
						<th style="white-space: nowrap; width: 1%; display:none;">Level</th>
						<th style="white-space: nowrap; width: 100%;">Value</th>
						</tr>
						</thead>
						<tbody>
					  <?php
						
						require("dbconnect.php");
					$query = "SELECT Lpad(f.DESCR,Length(f.DESCR) + LEVEL * 5 - 5,' ') as FEATR, f.FEATID , LEVEL  FROM MMR_FEAT  f
						WHERE f.PATTERN = 'P2'
						START WITH f.PARENT IS NULL 
						CONNECT BY PRIOR f.FEATID = f.PARENT";
								$compiled = oci_parse($db, $query);
								oci_execute($compiled);
								while($row=oci_fetch_array($compiled))
								{	
							?>
							<tr>
								<td style="display:none;"><?php echo $row['FEATID'];?></td>
								<td style="padding:0px;"><pre style="font-family: verdana; font-size:15px; margin-bottom: 0px; <?php if($row['LEVEL'] == 1) echo "font-weight: bold;";?>"><?php echo $row['FEATR'];?></pre></td>
								<td style="display:none;"><?php echo $row['LEVEL'];?></td>
								<td style="padding:1px; padding-left:20px;">
								<?php if($row['LEVEL'] != 1){ ?><input disabled class="rm_dis" id="ft_in<?php echo $row['FEATID']; ?>" name="ft_in<?php echo $row['FEATID']; ?>" type="text">
								<?php } ?></td>
							<tr>
							<?php 
								}
							?>
							</tbody>
						</table>
						<div class="form-group">
						<button disabled type="button" class="sub_frm_val rm_dis fnt_bld col-12 btn btn-secondary">Submit</button>
						</div>
						</div>
						
						</center>
						
					</div>
					
					
					
				</div>
			</div>
		</div>
		
		</form>
							</div>
					</div>
				
				<script>
				
					var prj_id_j = "";
					var brf_mon = "";
					
					$(function () {
						$('#frm_date').datepicker();
					});
					
					$(function () {
						$('#t_date').datepicker();
					});
					
					$(function () {
						$('#s_date').datepicker({
							changeMonth: true,
							changeYear: true,
							showButtonPanel: true,
							dateFormat: 'M-yy',
							onClose: function(dateText, inst) { 
								$(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
								$(".ui-datepicker-calendar").hide();
								//$(".ui-datepicker-month").hide();
								$(".ui-datepicker-prev").hide();
								$(".ui-datepicker-next").hide();
								$(".ui-datepicker-current").hide();
								
								$('#prj_featrs')[0].reset();
								$('#prj_featrs').find('textarea').each(function(){
								$(this).html("");
							});
								brf_mon = $('#s_date').val();
								
								//alert(brf_mon);
								if(prj_id_j !="")
									gt_st_vals();
									
								},
								 beforeShow: function (input, inst) {
									setTimeout(function () {
										inst.dpDiv.css({
											top: $("#s_date").offset().top + 35,
											left: $("#s_date").offset().left
										});
									}, 0);
								}
							
						});
						
						$("#s_date").focus(function () {
							$(".ui-datepicker-calendar").hide();
							//$(".ui-datepicker-month").hide();
							$(".ui-datepicker-prev").hide();
							$(".ui-datepicker-next").hide();
							$(".ui-datepicker-current").hide();
						});
						
					   $("#s_date").blur(function () {
							$(".ui-datepicker-calendar").hide();
							//$(".ui-datepicker-month").hide();
							$(".ui-datepicker-prev").hide();
							$(".ui-datepicker-next").hide();
							$(".ui-datepicker-current").hide();
						});
						
						var enforceModalFocusFn = $.fn.modal.Constructor.prototype.enforceFocus;
						$.fn.modal.Constructor.prototype.enforceFocus = function() {};
									
									
					});
					
					/*$('#prj_rfsh').unbind().click(function(){
						//alert("123");
						$(this).prop('disabled',true);
						$(this).html('Loading...');
						$.ajax({
						type: "GET",
						url: "prj_lst.php",
						success: function (data) {
							$('#spname').html(data);
							$('#prj_rfsh').html('Refresh');
							$('#prj_rfsh').prop('disabled',false);
						}
						});
					});*/
					
					
					
					$('#dprj_rfsh').unbind().click(function(){
						//alert("123");
						$(this).prop('disabled',true);
						$(this).html('Loading...');
						prj_id_j = "";
						brf_mon = "";
						//$('#ds_date').html('<option>Select One</option>');
						//$('#ds_date').prop('disabled',true);
						gt_st_vals();
						
						$.ajax({
						type: "GET",
						url: "prj_lst.php",
						success: function (data) {
							$('#dpname').html(data);
							$('#dprj_rfsh').html('Refresh');
							$('#dprj_rfsh').prop('disabled',false);
						}
						});
					});
					
					
					$('#dpname').change(function(){
						//alert();
						//$('#ds_date').prop('disabled',true);
						//brf_mon = "";
						prj_id_j = $(this).val();
						brf_mon = $('#s_date').val();
						$('#prj_featrs')[0].reset();
						$('#prj_featrs').find('textarea').each(function(){
								$(this).html("");
							});
						gt_st_vals();
						
						var dta = $(this).val();
						$.ajax({
							type:	"GET",
							url:	"prj_history.php",
							data:	"prj_id="+dta,
							success: function (data) {
								$('#prj_hstry').html(data);
								
						}
						});
						
						
					});
					
					/*$('#ds_date').change(function(){
						br_id_j = $(this).val();
						gt_st_vals();
					});*/
					
					function gt_st_vals(){
						//alert("prj_id="+$('#dpname').val()+'&brf_mon='+$('#s_date').val());
						if(prj_id_j > 0 && brf_mon != "")
						{
							//alert("prj_id="+$('#dpname').val()+'&brf_mon='+$('#s_date').val());
							$.ajax({
								type:	"GET",
								url:	"aj_ft_vals.php",
								data:	"prj_id="+$('#dpname').val()+'&brf_mon='+$('#s_date').val(),
								datatype: "JSON",
								success: function (data) {
									var json_obj = [];
										json_obj = JSON.parse(data);
									
									$('#tab_features').find('input').each(function(){
										var input_id = $(this);
									var attr = $(this).attr('id').replace( /^\D+/g, '');
										//console.log(attr);
										for (var i = 0; i < json_obj.length; i++) {
											if(typeof json_obj[i]['FEATID'+attr] !== "undefined")
											{input_id.val(json_obj[i]['FEATID'+attr]);
											break; }
											
										}
									});
									
									$('#tab_features').find('textarea').each(function(){
										var input_id = $(this);
									var attr1 = $(this).attr('id').replace( /^\D+/g, '');
										//console.log(attr1);
										for (var j = 0; j < json_obj.length; j++) {
											if(typeof json_obj[j]['FEATID'+attr1] !== "undefined")
											{input_id.html(json_obj[j]['FEATID'+attr1]);
											break; }
										}
									});
								}
							});
							
							
							
							$('.rm_dis').prop('disabled',false);
						}else{
							$('#prj_featrs')[0].reset();
							$('#prj_featrs').find('textarea').each(function(){
								$(this).html("");
							});
							$('.rm_dis').prop('disabled',true);
						}
					}
					
					
					$('.sub_frm_val').unbind().click(function(){
						
						$('.rm_dis').prop('readonly',true);
						$('.rm_dis').addClass('rd_only');
						$.ajax({
						type: "POST",
						url: "aj_ins_upd_del.php",
						data:	"prj_id=" + $('#dpname').val() + '&brf_mon=' + $('#s_date').val() + '&' + $('#prj_featrs').serialize(),
						success: function (data) {
							alert(data);
							$('.rm_dis').prop('readonly',false);
						$('.rm_dis').removeClass('rd_only');
							}
						});
						
					});
			
					$("input").focus(function () {
						$('html, body').animate({
							scrollTop: $(this).offset().top - 80 
							}, 100);
					});
					
					
					
					
									
				</script>