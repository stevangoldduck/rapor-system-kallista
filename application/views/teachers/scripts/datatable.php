<script type="text/javascript">
	var save_method; //for save method string
	var table;

	$(document).ready(function() {
		//datatables
		table = $('#tb_teachers').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": '<?php echo site_url('teachers/json'); ?>',
				"type": "POST"
			},
			//Set column definition initialisation properties.
			"columns": [
				{
					"data": "teacher_name",
				},
				{
					"data": "teacher_nip",
				},
				{
					"data": "department_name",
				},
				{
					"data": "teacher_id",
					"orderable": false
				}
			],

		});

	});
</script>
