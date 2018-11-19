<?php 
		require("dbconnect.php");
		$query = "SELECT BRID,TO_CHAR(FR_MN,'MON-YYYY') as FR_MN FROM MMR_BRIEF_MASTER WHERE PRJ_ID = '".$_GET['prj_id']."'";
		$compiled = oci_parse($db, $query);
		oci_execute($compiled);
		while($row=oci_fetch_array($compiled))
		{	
	?>
		<button class="btn btn-light pr_hst"><?php echo ucfirst(strtolower($row['FR_MN'])); ?></button>
	<?php 
		}
	?>
	<script>
	$('.pr_hst').click(function(){
				//alert($(this).html());
				prj_id_j = $('#dpname').val();
				$('#s_date').datepicker('setDate', new Date($(this).html()));
				brf_mon = $('#s_date').val();
				//alert(brf_mon);
				$('#prj_featrs')[0].reset();
				$('#prj_featrs').find('textarea').each(function(){
								$(this).html("");
							});
				gt_st_vals();
			});
	</script>