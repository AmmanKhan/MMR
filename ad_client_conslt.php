<style>
	.pad_zro	{padding:5px;}
.mrgn_zro	{margin:5px;}
.mrgn_btm_zro	{margin-bottom:0px;}
.fnt_bld		{font-weight:bold;}
.het_unst		{height:unset;}
.fnt_clr_rd		{color:red;}
.rd_only		{background-color:#17a2b83b;}
/************************************/
td {vertical-align: middle !important;}
/************************************/
#myModal_edit .modal-dialog,#myModal_edit_con .modal-dialog{
-webkit-transform: translate(0,-50%);
-o-transform: translate(0,-50%);
transform: translate(0,-50%);
top: 50%;
margin: 0 auto;
}
</style>
<div class="tm-col col-12">
	<div class="bg-white tm-block h-100">

		<div class="row">
			<div class="col-6">

				<h2 class="tm-block-title">Add <b class="fnt_bld fnt_clr_rd">Clients</b></h2>
				<form id="clnt_dtl">
					<div class="form-group">
						<label for="clnt_name" class="mrgn_btm_zro fnt_bld">Client Name :</label>
						<input placeholder="Client Name" id="clnt_name" name="clnt_name" type="text" class="mrgn_btm_zro form-control validate pad_zro het_unst">
					</div>

					<div class="form-group">
						<label for="clnt_desc" class="mrgn_btm_zro fnt_bld">Description :</label>
						<input placeholder="Description" id="clnt_desc" name="clnt_desc" type="text" class="mrgn_btm_zro form-control validate pad_zro het_unst">
					</div>


					<div class="form-group">
						<input type="button" class="btn btn-info col-12 fnt_bld" value="Submit" id="clnt_sub">
					</div>
				</form>

			</div>
			
			
			<div class="col-6">
				<h2 class="tm-block-title">Add <b class="fnt_bld fnt_clr_rd">Consultant</b></h2>
				<form id="conlt_dtl">
					<div class="form-group">
						<label for="conlt_name" class="mrgn_btm_zro fnt_bld">Consultant Name :</label>
						<input placeholder="Consultant Name" id="conlt_name" name="conlt_name" type="text" class="mrgn_btm_zro form-control validate pad_zro het_unst">
					</div>

					<div class="form-group">
						<label for="conlt_desc" class="mrgn_btm_zro fnt_bld">Description :</label>
						<input placeholder="Description" id="conlt_desc" name="conlt_desc" type="text" class="mrgn_btm_zro form-control validate pad_zro het_unst">
					</div>


					<div class="form-group">
						<input type="button" class="btn btn-info col-12 fnt_bld" value="Submit" id="conlt_sub">
					</div>
				</form>
			</div>
		</div>




		
			<ul class="nav nav-tabs">
				<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab">Clients</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-2" role="tab">Consultant</a></li>
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
						<th style="white-space: nowrap; width: 2%;">ID</th>
						<th style="white-space: nowrap; width: 2%;">Client Name</th>
						<th style="white-space: nowrap; width: 2%;">Description</th>
						<th style="white-space: nowrap; width: 2%;">Status</th>
						<th style="white-space: nowrap; width: 2%;">Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						
						require("dbconnect.php");
					$query = "SELECT * FROM MMR_CLIENT";
								$compiled = oci_parse($db, $query);
								oci_execute($compiled);
								while($row=oci_fetch_array($compiled))
								{	
							?>
							<tr>
								<td><?php echo $row['CLIENT_ID'];?></td>
								<td><?php echo $row['CLIENT_NAME'];?></td>
								<td><?php echo $row['CLIENT_DESC'];?></td>
								<td><?php if($row['STATUS'] == 1) echo "Active"; else echo "Disabled";?></td>
								<td>
				<button type="button" class="btn btn-primary  edit-item" data-toggle="modal" data-target="#myModal_edit" value="<?php echo $row['CLIENT_ID']; ?>">
				<i class="far fa-edit"></i> Edit
			</button>
			
			<button type="button" class="btn btn-danger drcd_c"  value="<?php echo $row['CLIENT_ID']; ?>">
				<i class="fas fa-trash-alt"></i> Delete
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
						<th style="white-space: nowrap; width: 2%;">ID</th>
						<th style="white-space: nowrap; width: 2%;">Client Name</th>
						<th style="white-space: nowrap; width: 2%;">Description</th>
						<th style="white-space: nowrap; width: 2%;">Status</th>
						<th style="white-space: nowrap; width: 2%;">Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						
						require("dbconnect.php");
					$query = "SELECT * FROM MMR_CONSULTANT";
								$compiled = oci_parse($db, $query);
								oci_execute($compiled);
								while($row=oci_fetch_array($compiled))
								{	
							?>
							<tr>
								<td><?php echo $row['CON_ID'];?></td>
								<td><?php echo $row['CONSULTANT'];?></td>
								<td><?php echo $row['DESCR'];?></td>
								<td><?php if($row['STATUS'] == 1) echo "Active"; else echo "Disabled";?></td>
								<td>
			<button type="button" class="btn btn-primary edit-item" data-toggle="modal" data-target="#myModal_edit_con" value="<?php echo $row['CON_ID']; ?>">
				<i class="far fa-edit"></i> Edit
			</button>
			
			<button type="button" class="btn btn-danger drcd_c"  value="<?php echo $row['CON_ID']; ?>">
				<i class="fas fa-trash-alt"></i> Delete
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



					</div>
				</div>
			</div>

		
	</div>
</div>

<!-- The modal -->
					<div class="modal fade" id="myModal_edit" tabindex="-1" role="dialog" aria-labelledby="modalLabelLarge" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="modalLabelLarge">Edit Client.</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								</div>

							<div class="modal-body">
								
								
				<form id="clnt_dtl_edt">
					<div class="form-group">
						<label for="clnt_name_edt" class="mrgn_btm_zro fnt_bld">Client Name :</label>
						<input id="clnt_name_edt_id" name="clnt_name_edt_id" type="hidden" class="mrgn_btm_zro form-control validate pad_zro het_unst">
						<input placeholder="Client Name" id="clnt_name_edt" name="clnt_name_edt" type="text" class="mrgn_btm_zro form-control validate pad_zro het_unst">
					</div>

					<div class="form-group">
						<label for="clnt_desc_edt" class="mrgn_btm_zro fnt_bld">Description :</label>
						<input placeholder="Description" id="clnt_desc_edt" name="clnt_desc_edt" type="text" class="mrgn_btm_zro form-control validate pad_zro het_unst">
					</div>


					<div class="form-group">
						<input type="button" class="btn btn-info col-12 fnt_bld" value="Submit" id="clnt_sub_edt">
					</div>
				</form>
                       
								
							</div>
							 <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							</div>

							</div>
						</div>
					</div>
					
<!-- The modal -->
					<div class="modal fade" id="myModal_edit_con" tabindex="-1" role="dialog" aria-labelledby="modalLabelLarge" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="modalLabelLarge">Edit Consultant.</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								</div>

							<div class="modal-body">
								
								<form id="conlt_dtl_edt">
									<div class="form-group">
										<label for="conlt_name_edt" class="mrgn_btm_zro fnt_bld">Consultant Name :</label>
										<input placeholder="Consultant Name" id="conlt_name_edt" name="conlt_name_edt" type="text" class="mrgn_btm_zro form-control validate pad_zro het_unst">
									</div>

									<div class="form-group">
										<label for="conlt_desc_edt" class="mrgn_btm_zro fnt_bld">Description :</label>
										<input placeholder="Description" id="conlt_desc_edt" name="conlt_desc_edt" type="text" class="mrgn_btm_zro form-control validate pad_zro het_unst">
									</div>


									<div class="form-group">
										<input type="button" class="btn btn-info col-12 fnt_bld" value="Submit" id="conlt_sub_edt">
									</div>
								</form>
								
							</div>
								<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
								</div>
							</div>
						</div>
					</div>

<script>

$('#clnt_sub').unbind().click(function(){
		if($('#clnt_name').val() == "")
		{	alert("Enter Client Name");
			return false;}
	
	$.ajax({
	type: "GET",
	url: "aj_ins_clnt_conslt.php",
	data: $('#clnt_dtl').serialize(),
	success: function (data) {
		alert(data);
		}
	});
});

$('#conlt_sub').unbind().click(function(){
		if($('#conlt_name').val() == "")
		{	alert("Enter Consultant Name");
			return false;}
	$.ajax({
	type: "GET",
	url: "aj_ins_clnt_conslt.php",
	data: $('#conlt_dtl').serialize(),
	success: function (data) {
		alert(data);
		}
	});
});

</script>