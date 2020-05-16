<script type="text/javascript">
	var save_method; //for save method string
	var table;

	$(document).ready(function() {
		//datatables
		table = $('#tb_subject').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": '<?php echo site_url('subjects/json'); ?>',
				"type": "POST"
			},
			//Set column definition initialisation properties.
			"columns": [{
					"data": "subject_name",
				},
				{
					"data": "subject_code",
				},
				{
					"data": "subject_grade",
				},
				{
					"data": "sg_name",
				},
				{
					"data": "subject_category",
				},
				{
					"data": "teacher",
				},
				{
					"data": "subject_id",
					"orderable": false
				}
			],

		});


		table2 = $('#tb_subject_student').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": '<?php echo site_url('subjects/student-json'); ?>',
				"type": "POST",
				"data": function(d) {
					d.subject_id = "<?php echo isset($subject_id) ? $subject_id : null ?>";
				}

			},
			//Set column definition initialisation properties.
			"columns": [{
					"data": "student_name",
				},
				{
					"data": "student_nis",
				},
				{
					"data": "student_nisn",
				}
			],
		});
	});

	$("#awk_ulangan, #awk_tugas, #awk_md, #awk_st").change(function() {
		var awk_ulangan = parseInt($("#awk_ulangan").val() ? $("#awk_ulangan").val() : 0);
		var awk_tugas = parseInt($("#awk_tugas").val() ? $("#awk_tugas").val() : 0);
		var awk_md = parseInt($("#awk_md").val() ? $("#awk_md").val() : 0);
		var awk_st = parseInt($("#awk_st").val() ? $("#awk_st").val() : 0);

		var total = awk_md + awk_ulangan + awk_tugas + awk_st;
		$("#msg_awk").text("");
		if (total != 100) {
			$("#msg_awk").text("Assesment not counted as 100% yet, make sure the total is 100%");
		}
	});

</script>
