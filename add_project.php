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
		<div class="form-group">
			<label for="budget" class="mrgn_btm_zro fnt_bld">Estimated Budget</label>
			<input placeholder="Project Budget" id="budget" name="budget" type="number" class="form-control validate mrgn_btm_zro pad_zro het_unst">
		</div>
		<!--<div class="form-group">
		 <label for="sel_client" class="mrgn_btm_zro fnt_bld">Select Client From Multiple List</label>
		 <select id="sel_client" name="sel_client[]" multiple class="form-control" >
		 
		
		
		 </select>
		</div>-->
		
		<div class="form-group">
							 <label for="sels_client" class="mrgn_btm_zro fnt_bld">Select Client From Multiple List</label>
							<select id="sel_client" name="sel_client" class="form-control validate mrgn_btm_zro pad_zro het_unst">
							<option value="" > Please Select</option>
								 <?php 
									require("dbconnect.php");
									$query = "SELECT CLIENT_ID,CLIENT_NAME,CLIENT_DESC FROM MMR_CLIENT";
									$compiled = oci_parse($db, $query);
									oci_execute($compiled);
									while($row=oci_fetch_array($compiled))
									{	
								?>
									<option value="<?php echo $row[0];?>"><?php echo $row[1] ." - (". $row[2].")";?></option>
								<?php 
									}//oci_close($db); 	
								?>
							</select>
						</div>
		
		
		
		<div class="form-group">
		  <label for="sel_con" class="mrgn_btm_zro fnt_bld">Select Consultant From Multiple List</label>
		 <select id="sel_con" name="sel_con[]" multiple class="form-control" >
		   <?php 
				//require("dbconnect.php");
				$query = "SELECT CON_ID,CONSULTANT FROM MMR_CONSULTANT";
				$compiled = oci_parse($db, $query);
				oci_execute($compiled);
				while($row=oci_fetch_array($compiled))
				{	
			?>
				<option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
			<?php 
				}//oci_close($db); 	
			?>
		 </select>
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
               
			 
			
		<div class="tm-col tm-col-big">
			<div class="bg-white tm-block h-100">
			
               
						<h2 class="tm-block-title">Add <b class="fnt_bld fnt_clr_rd">Features</b></h2>
					
					<div class="col-12">
						<form>
						<?php /*
						<div class="form-group">
							<label for="sptrn" class="mrgn_btm_zro fnt_bld">Select Pattern</label>
							<select id="sptrn" name="sptrn" class="form-control validate mrgn_btm_zro pad_zro het_unst">
								 <?php 
									//require("dbconnect.php");
									$query = "SELECT FEATID,DESCR FROM MMR_FEAT";
									$compiled = oci_parse($db, $query);
									oci_execute($compiled);
									while($row=oci_fetch_array($compiled))
									{	
								?>
									<option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
								<?php 
									}oci_close($db); 	
								?>
							</select>
						</div>
						*/ ?>
						<div class="form-group">
						<button type="button" class="btn btn-info col-12 fnt_bld" data-toggle="modal" data-target="#myModal">Open</button>
						</div>
						</form>
						<div class="btn-light" style="border: 0.5px dashed red; padding:3px;"><p><h5><kbd class="btn-danger">Note:</kbd></h5>
						Feature(s) Once Added Can not be Changed / Removed.<hr class="mrgn_zro">
						Take Extra Care in Creating them.
						</p></div>
					</div>
					</div>
                 </div>
				 
				 
				<div class="tm-col col-12">
			<div class="bg-white tm-block h-100">
				
        
			<ul class="nav nav-tabs">
				<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab">Projects</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-2" role="tab">Feature(s) Configuration</a></li>
			</ul>

			<div class="card card-tabs-1">
				<div class="card-block">
					<div class="tab-content" id="tab_features">
						<div class="tab-pane active" id="tab-1">

							<br><br>
							<center>
								<div class="table-responsive table-sm" style="width: 95%;">
						<table class="table">
						<thead class="thead-dark">
						<tr>
						<th style="white-space: nowrap; vertical-align: middle; border-right: 1px solid white; text-align:center; width: 0.5%;">Sr. No.</th>
						<th style="white-space: nowrap; vertical-align: middle; border-right: 1px solid white; text-align:center; width: 5%;">Project Title</th>
						<th style="white-space: normal; vertical-align: middle; border-right: 1px solid white; text-align:center; width: 1%;">Project Commencing Date</th>
						<th style="white-space: normal; vertical-align: middle; border-right: 1px solid white; text-align:center; width: 1%;">Project Revision Date</th>
						<th style="white-space: normal; vertical-align: middle; border-right: 1px solid white; text-align:center; width: 5%;">Clients</th>
						<th style="white-space: normal; vertical-align: middle; border-right: 1px solid white; text-align:center; width: 5%;">Consultants</th>
						<th style="white-space: nowrap; vertical-align: middle; border-right: 1px solid white; text-align:center; width: 2%;">Estimated Budget</th>
						<th style="white-space: nowrap; vertical-align: middle; border-right: 1px solid white; text-align:center; width: 2%;">Project Status</th>
						<th style="white-space: nowrap; vertical-align: middle; text-align:center; width: 2%;">Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						
						require("dbconnect.php");
					//$query = "SELECT row_number() over (order by p.PRJ_ID) Serial , p.* FROM MMR_BRIEF_PROJECT p";
					$query = "SELECT row_number() over (order by p.PRJ_ID) Serial , p.* , (select C.Client_name from Mmr_Client c where C.Client_Id IN(
								select pr.Client_Id from Mmr_Brief_Project pr where pr.Prj_Id = p.Prj_Id )) CLIENTS ,        
								(Select wm_concat(cn.Consultant) from  Mmr_Consultant cn where cn.Con_Id IN(
									select regexp_substr((select prj.Con_Id from Mmr_Brief_Project prj where prj.Prj_Id = p.Prj_Id),'[^,]+', 1, level) from dual
									 connect by regexp_substr((select prjt.Con_Id from Mmr_Brief_Project prjt where prjt.Prj_Id = p.Prj_Id), '[^,]+', 1, level) is not null)) CONSULTANTS
									FROM MMR_BRIEF_PROJECT p";
									
								$compiled = oci_parse($db, $query);
								oci_execute($compiled);
								while($row=oci_fetch_array($compiled))
								{	
							?>
							<tr>
								<td style="border-right: 1px solid #80808073; text-align:center; vertical-align: middle;"><?php echo $row['SERIAL'];?></td>
								<td style="border-right: 1px solid #80808073; vertical-align: middle;"><?php echo $row['PROJTITLE'];?></td>
								<td style="border-right: 1px solid #80808073; vertical-align: middle;"><?php echo $row['PRJ_FRM'];?></td>
								<td style="border-right: 1px solid #80808073; vertical-align: middle;"><?php echo $row['PRJ_TO'];?></td>
								<td style="border-right: 1px solid #80808073; vertical-align: middle;"><?php echo $row['CLIENTS'];?></td>
								<td style="border-right: 1px solid #80808073; vertical-align: middle;"><?php if($row['CONSULTANTS'] != null) echo $row['CONSULTANTS']->load(); ?></td>
								<td style="border-right: 1px solid #80808073; vertical-align: middle;"><?php echo $row['BUDGET'];?></td>
								<td style="border-right: 1px solid #80808073; vertical-align: middle;"><?php if($row['PRJ_STATUS'] == 1) echo "Closed"; else echo "Active";?></td>
								<td>
				<button type="button" class="btn btn-primary  edit-item" data-toggle="modal" data-target="#myModal_edit" value="<?php echo $row['PRJ_ID']; ?>">
				<i class="far fa-edit"></i> Edit
			</button>
			
			<button type="button" class="btn btn-danger drcd_c"  value="<?php echo $row['PRJ_ID']; ?>">
				<i class="fas fa-clock"></i> Close project
			</button>
								</td>
								
							<tr>
							<?php 
								}
							?>
							</tbody>
						</table>
						
						</div>

							</center>
						</div>

						<div class="tab-pane" id="tab-2">

							<br><br>
							<center>
							
							
					<div class="table-responsive table-sm" style="width: 95%;">
						<table class="table">
						<thead class="thead-dark">
						<tr>
						<th style="white-space: nowrap; width: 1%; display:none; border-right: 1px solid white; vertical-align: middle;">Feature ID</th>
						<th style="white-space: nowrap; border-right: 1px solid white; vertical-align: middle; width: 1%;">Features</th>
						<th style="white-space: nowrap; border-right: 1px solid white; vertical-align: middle; width: 1%; display:none;">Level</th>
						<th style="white-space: nowrap; border-right: 1px solid white; vertical-align: middle; width: 5%;">Data Type</th>
						<th style="white-space: nowrap; border-right: 1px solid white; vertical-align: middle; width: 5%;">Input Type</th>
						<th style="white-space: nowrap; width: 5%;">ORDER</th>
						</tr>
						</thead>
						<tbody>


						
					  <?php
						
						require("dbconnect.php");
						
						$query = "  Select distinct f.Parent from MMR_FEAT f where f.parent IS NOT null";
						$compiled = oci_parse($db, $query);
								oci_execute($compiled);
								$parents_nodes = array();
								while($row=oci_fetch_array($compiled))
								{ array_push($parents_nodes, $row['PARENT']);	}
							
							
					$query = "SELECT Lpad(f.DESCR,Length(f.DESCR) + LEVEL * 5 - 5,' ') as FEATR, f.FEATID , LEVEL , f.Data_Type , f.Input_Type , f.ORDER_SEQ  FROM MMR_FEAT  f
						/*WHERE f.PATTERN = 'P1'*/
						START WITH f.PARENT IS NULL 
						CONNECT BY PRIOR f.FEATID = f.PARENT
						ORDER SIBLINGS BY f.ORDER_SEQ";
						
								$compiled = oci_parse($db, $query);
								oci_execute($compiled);
								while($row=oci_fetch_array($compiled))
								{	
							?>
							<tr>
								<td style="display:none;"><?php echo $row['FEATID'];?></td>
								<td style="padding:0px; border-right: 1px solid #80808073; vertical-align: middle;"><pre style="font-family: verdana; font-size:15px; margin-bottom: 0px; <?php if(in_array($row['FEATID'], $parents_nodes)) echo "font-weight: bold;";?>"><?php if($row['LEVEL'] != 1) echo $row['FEATR'];?></pre></td>
								<td style="display:none;"><?php echo $row['LEVEL'];?></td>
								<td style="padding:1px; padding-left:20px; border-right: 1px solid #80808073; vertical-align: middle;">
								<?php if(in_array($row['FEATID'], $parents_nodes))
										;
									else
									{
										echo '<Select class="d_type">';
										$query_d = "SELECT * FROM MMR_DATA_FYPE";
										$compiled_d = oci_parse($db, $query_d);
										oci_execute($compiled_d);
										while($row_d=oci_fetch_array($compiled_d))
										{
											if($row['DATA_TYPE'] == $row_d['ID'])
												echo '<option value="'.$row_d['ID'].'" selected="selected">'.$row_d['TYPE'].'</option>';
											else
												echo '<option value="'.$row_d['ID'].'">'.$row_d['TYPE'].'</option>';
												
										}
										echo "</Select>";
										echo '<b style="color:green;"></b>';
									}
										
								?></td>
								<td style="padding:1px; padding-left:20px; border-right: 1px solid #80808073; vertical-align: middle;"><?php if(in_array($row['FEATID'], $parents_nodes))
										;
									else
										{
										echo '<Select class="i_type">';
										$query_i = "SELECT * FROM MMR_INPUT_TYPE";
										$compiled_i = oci_parse($db, $query_i);
										oci_execute($compiled_i);
										while($row_i=oci_fetch_array($compiled_i))
										{
											if($row['INPUT_TYPE'] == $row_i['ID'])
												echo '<option value="'.$row_i['ID'].'" selected="selected">'.$row_i['TYPE'].'</option>';
											else
												echo '<option value="'.$row_i['ID'].'">'.$row_i['TYPE'].'</option>';
										}
										echo "</Select>";
										echo '<b style="color:green;"></b>';
									}

									?></td>
									<td style="vertical-align: middle;">
										<?php if(in_array($row['FEATID'], $parents_nodes))
										;
									else {
										?>
										<input class="odr_seq col-5" type="number" style="padding:0; " value="<?php echo $row['ORDER_SEQ']; ?>">
										<?php echo '<b style="color:green;"></b>'; ?>
									<?php } ?>
									</td>
							<tr>
							<?php 
								}
							?>
							</tbody>
						</table>
						<div class="form-group">
						<button type="button" class="sub_frm_val fnt_bld col-12 btn btn-secondary" style="display:none;">Submit</button>
						</div>
					</div>
						
							</center>

						</div>



					</div>
				</div>
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
								
								
								<iframe id="ifrm1" src="tree/admin.php" style="overflow-y: scroll;" height="370px" width="100%" ></iframe>
                       
								
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
					
					$(".d_type").unbind().change(function(){
						var d_val = $(this);
						var ft_val = $(this).parent('td').siblings('td:first-child').html();
						$.ajax({
								type: "POST",
								url: "aj_dta_inpt_type.php",
								data: 'd_val='+d_val.val()+'&ft_val='+parseInt(ft_val),
								dataType: "JSON",
								 success: function(data) {
									//alert(data);
									//console.log(data);
									 if(data.status == 'true'){
										 d_val.siblings('b').css('display','none').css('color','green').html(data.content).fadeIn(500).delay(2000).fadeOut(500); 
										 d_val.val(data.dt_type);
										 d_val.parent('td').siblings('td:nth-child(5)').children('.i_type').val(data.in_type);
										 
									}else if(data.status == 'false'){
										d_val.siblings('b').css('display','none').css('color','red').html(data.content).fadeIn(500).delay(2000).fadeOut(500); 
									}
									
								}
								});
					
					});
					
					
					$(".i_type").unbind().change(function(){
						var i_val = $(this);
						var ft_val = $(this).parent('td').siblings('td:first-child').html();
						$.ajax({
								type: "POST",
								url: "aj_dta_inpt_type.php",
								data: 'i_val='+i_val.val()+'&ft_val='+parseInt(ft_val),
								dataType: "JSON",
								 success: function(data) {
									//alert(data);
									 if(data.status == 'true'){
										i_val.siblings('b').css('display','none').css('color','green').html(data.content).fadeIn(500).delay(2000).fadeOut(500); 
										 i_val.val(data.in_type);
										 i_val.parent('td').siblings('td:nth-child(4)').children('.d_type').val(data.dt_type);
									}else if(data.status == 'false'){
										i_val.siblings('b').css('display','none').css('color','red').html(data.content).fadeIn(500).delay(2000).fadeOut(500); 
									}
									
								}
								});
					});
					
					var ordr_val_org = "";
					$(".odr_seq").on('focus',function(){
						ordr_val_org = $(this).val();
						//console.log(ordr_val_org);
					});
					
					/* $(".odr_seq").keypress(function(){
						ordr_val_org = $(this).val();
					}); */
					
					
					$(".odr_seq").blur(function(){
						
						var ordr_val = $(this);
						//console.log(ordr_val.val() + '>><<' + ordr_val_org);
						if( ordr_val.val() != ordr_val_org){
						var ft_val = $(this).parent('td').siblings('td:first-child').html();
						//alert('ordr_val='+ordr_val.val()+'&ft_val='+parseInt(ft_val));
						$.ajax({
								type: "POST",
								url: "aj_feat_order.php",
								data: 'ordr_val='+ordr_val.val()+'&ft_val='+parseInt(ft_val),
								dataType: "JSON",
								 success: function(data) {
									//alert(data);
									 if(data.status == 'true'){
										ordr_val.siblings('b').css('display','none').css('color','green').html(data.content).fadeIn(500).delay(2000).fadeOut(500); 
										 
									}else if(data.status == 'false'){
										ordr_val.siblings('b').css('display','none').css('color','red').html(data.content).fadeIn(500).delay(2000).fadeOut(500); 
									}
									
								}
								});
						}
					}); 
				
					
					
									
				</script>