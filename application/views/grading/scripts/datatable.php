<script type="text/javascript">
	var save_method; //for save method string
	var table;

	$(document).ready(function() {
		//datatables
		table = $('#tb_grd_submission').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": '<?php echo site_url('grading-submissions/json'); ?>',
				"type": "POST"
			},
			//Set column definition initialisation properties.
			"columns": [{
					"data": "subject_name",
				},
				{
					"data": "subject_grade",
				},
				{
					"data": "gs_sy",
				},
				{
					"data": "teacher",
				},
				{
					"data": "gs_id",
					"order" : false
				}
			],

		});
	});
</script>
