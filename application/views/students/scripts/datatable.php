<script type="text/javascript">
	var save_method; //for save method string
	var table;

	$(document).ready(function() {
		//datatables
		table = $('#tb_students').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": '<?php echo site_url('students/json'); ?>',
				"type": "POST"
			},
			//Set column definition initialisation properties.
			"columns": [
				{
					"data": "student_name",
				},
				{
					"data": "student_nisn",
				},
				{
					"data": "student_address",
				},
				{
					"data": "student_dob",
				},
				{
					"data": "student_department_id",
				},
				{
					"data": "student_id",
					"orderable": false
				}
			],

		});

	});
</script>
