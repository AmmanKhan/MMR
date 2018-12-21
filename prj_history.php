<?php 
		require("dbconnect.php");
		$query = "SELECT BRID,TO_CHAR(FR_MN,'MON-YYYY') as FR_MN FROM MMR_BRIEF_MASTER WHERE PRJ_ID = '".$_GET['prj_id']."' ORDER BY TO_DATE(FR_MN,'MON-YYYY') ASC";
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
				var dte = "01-" + $(this).html();
				dte = dte.replace('-','/');
				dte = dte.replace('-','/');
				
				prj_id_j = $('#dpname').val();
				$('#s_date').datepicker('setDate', new Date(dte));
				brf_mon = $('#s_date').val();
				//alert(brf_mon);
				$('#prj_featrs')[0].reset();
				$('#prj_featrs').find('textarea').each(function(){
								$(this).html("");
							});
				gt_st_vals();
			});
	</script>