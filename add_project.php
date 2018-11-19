		<style>
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
		</style>
		
		<div class="tm-col tm-col-big">
                    <div class="bg-white tm-block h-100">
                        <h2 class="tm-block-title">Add <b class="fnt_bld fnt_clr_rd">New Project</b></h2>
                        
		<div class="col-12">
						
		<form id="ad_n_prj">
		<div class="form-group">
			<label for="pname" class="mrgn_btm_zro fnt_bld">Project Name</label>
			<input placeholder="Enter Poject name" id="pname" name="pname" type="text" class="form-control validate mrgn_btm_zro pad_zro het_unst">
		</div>
		<div class="form-group">
			<label for="frm_date" class="mrgn_btm_zro fnt_bld">Project Commencing Date</label>
			<input placeholder="From Date" id="frm_date" name="frm_date" type="text" readonly class="mrgn_btm_zro form-control validate pad_zro het_unst" data-large-mode="true">
		</div>
		<div class="form-group">
			<label for="t_date" class="mrgn_btm_zro fnt_bld">Project Revision Date</label>
			<input placeholder="To Date" id="t_date" name="t_date" type="text" readonly class="mrgn_btm_zro form-control validate pad_zro het_unst" data-large-mode="true">
		</div>
		
		<div class="form-check">
		  <label class="form-check-label fnt_bld">
			<input type="checkbox" class="form-check-input" id="prj_stus" name="prj_stus" value="1" name="prj_closed"> Project Closed
		  </label>
		</div>
		
		
			<div class="form-group">
				<button type="button" id="sub_ad_prj" class="fnt_bld col-12 btn btn-info">Submit</button>
			</div>
			</form>
		</div>

	
                        </div>
         </div>
               
			   
			   
			   
			  <!--
        <div class="tm-col tm-col-big">
			<div class="bg-white tm-block h-100">
				<h2 class="tm-block-title">Add <b class="fnt_bld fnt_clr_rd">Month</b> of Project Brief</h2>
			
			<div class="col-12">
							
				<form>
				<div class="form-group">
				<label for="spname" class="mrgn_btm_zro fnt_bld">Select Project</label>
					<div class="input-group">
						
						<select id="spname" name="spname" class="form-control validate mrgn_btm_zro pad_zro het_unst">
							<option>Select One</option>
							<?php 
								/*require("dbconnect.php");
								$query = "SELECT PRJ_ID,PROJTITLE FROM MMR_BRIEF_PROJECT";
								$compiled = oci_parse($db, $query);
								oci_execute($compiled);
								while($row=oci_fetch_array($compiled))
								{	*/
							?>
								<option value="<?php /*echo $row['PRJ_ID'];?>"><?php echo $row['PROJTITLE']; */?></option>
							<?php 
							/*	}*/
							?>
						</select>
						<div class="input-group-append">
							<button id="prj_rfsh" class="btn btn-outline-secondary" type="button">Refresh</button>
						  </div>
					</div>
				</div>
					<div class="form-group">
						<label for="s_date" class="mrgn_btm_zro fnt_bld">Select Month</label>
						<input placeholder="Select Month" id="s_date" name="s_date" type="text" readonly class="mrgn_btm_zro form-control validate pad_zro het_unst" data-large-mode="true">
					</div>
					<div class="form-group">
						<button type="button" class="fnt_bld col-12 btn btn-info">Submit</button>
					</div>
				</form>
			</div>
        </div>
		</div>-->
				
		<div class="tm-col tm-col-big">
			<div class="bg-white tm-block h-100">
			
               
						<h2 class="tm-block-title">Add <b class="fnt_bld fnt_clr_rd">Features</b></h2>
					
					<div class="col-12">
						<form>
						<div class="form-group">
							<label for="sptrn" class="mrgn_btm_zro fnt_bld">Select Pattern</label>
							<select id="sptrn" name="sptrn" class="form-control validate mrgn_btm_zro pad_zro het_unst">
								<option>Latest Progress - Pattern 1</option>
								<option>Performance Matrix - Pattern 2</option>
							</select>
						</div>
						<div class="form-group">
						<button type="button" class="btn btn-info col-12 fnt_bld" data-toggle="modal" data-target="#myModal">Select</button>
						</div>
						</form>
						<div class="btn-light" style="border: 0.5px dashed red; padding:3px;"><p><h5><kbd class="btn-danger">Note:</kbd></h5>
						Feature(s) Once Added Can not be Changed / Removed.<hr class="mrgn_zro">
						Take Extra Care in Creating them.
						</p></div>
					</div>
					</div>
                 </div>

				 <!-- The modal -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modalLabelLarge" aria-hidden="true">
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
					</div>
					
					
					
					
					
					<script>
				
					
					$(function () {
						$('#frm_date').datepicker({
							dateFormat: 'dd-M-yy'
						});
					});
					
					$(function () {
						$('#t_date').datepicker({
							dateFormat: 'dd-M-yy'
						});
					});
					
					/*
					$(function () {
						$('#s_date').datepicker({
							changeMonth: true,
							changeYear: true,
							showButtonPanel: true,
							dateFormat: 'MM yy',
							onClose: function(dateText, inst) { 
								$(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
								$(".ui-datepicker-calendar").hide();
								$(".ui-datepicker-month").hide();
								$(".ui-datepicker-prev").hide();
								$(".ui-datepicker-next").hide();
								$(".ui-datepicker-current").hide();
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
									
									
					});*/
					
					
					$('#sub_ad_prj').click(function(){
						//alert($('#ad_n_prj').serialize());
						//return false;
						$.ajax({
							type:	"GET",
							url:	"ad_nw_prj.php",
							data:	$('#ad_n_prj').serialize(),
							dataType: "JSON",
							success:function(data){
								//alert(data);
								alert(data.content);
								if(data.status == 'true')
								$('#ad_n_prj')[0].reset();
							}
							
						});
					});
					
					
				
					
					
									
				</script>