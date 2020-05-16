<script type="text/javascript">
	var save_method; //for save method string
	var table, table2, table3;

	$(document).ready(function() {
		//datatables
		table = $('#tb_class').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": '<?php echo site_url('classes/json'); ?>',
				"type": "POST"
			},
			//Set column definition initialisation properties.
			"columns": [{
					"data": "class_name",
				},
				{
					"data": "class_code",
				},
				{
					"data": "class_grade",
				},
				{
					"data": "department_name",
				},
				{
					"data": "teacher",
				},
				{
					"data": "class_id",
					"orderable": false
				}
			],

		});

		table2 = $('#tb_class_student').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": '<?php echo site_url('classes/student-list'); ?>',
				"type": "POST",
				"data": function(d) {
					d.dp_id = "<?php echo isset($class_department_id) ? $class_department_id : null ?>";
					d.class_id = "<?php echo isset($class_id) ? $class_id : null ?>";
				}
			},
			//Set column definition initialisation properties.
			"columns": [{
					"data": "student_id",
					"orderable": false,
					"render": function(data, type, row) {
						var class_id = "<?php echo isset($class_id) ? $class_id : null ?>";
						if (class_id == row.sclass_class_id) {
							return `<input checked type="checkbox" name="student_id[]" value="${row.student_id}">`
						} else {
							return `<input type="checkbox" name="student_id[]" value="${row.student_id}">`
						}
					}
				},
				{
					"data": "student_name",
				},
				{
					"data": "student_nisn",
				}
			],

		});

		table3 = $('#tb_class_subjects').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": '<?php echo site_url('classes/subject-list'); ?>',
				"type": "POST",
				"data": function(d) {
					d.grade = "<?php echo isset($class_grade) ? $class_grade : null ?>";
				}
			},
			//Set column definition initialisation properties.
			"columns": [{
					"data": "subject_id",
					"orderable": false,
					"render": function(data, type, row) {
						var class_id = "<?php echo isset($class_id) ? $class_id : null ?>";
						if (class_id == row.cs_class_id) {
							return `<input checked type="checkbox" name="subject_id[]" value="${row.subject_id}">`
						} else {
							return `<input type="checkbox" name="subject_id[]" value="${row.subject_id}">`
						}
					}
				},
				{
					"data": "subject_name",
				},
				{
					"data": "subject_code",
				}
			],

		});

	});
</script>
