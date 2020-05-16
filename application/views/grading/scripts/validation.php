<script type="text/javascript">

	var students = '<?php echo json_encode($knowledge); ?>'
	var students_skill = '<?php echo json_encode($skill); ?>'
	var scm = parseInt(<?php echo $subject['subject_scc'] ?>);

	JSON.parse(students).forEach((item,index) => {
		if(item.skg_final_score < scm)
		{
			$('input[name="skg_remark'+item.student_id+'"]').css("border","1px solid red");
			$('input[name="skg_remark'+item.student_id+'"]').attr("placeholder","Need remark")
		}
	});

	JSON.parse(students_skill).forEach((item,index) => {
		if(item.ssg_final_score < scm)
		{
			$('input[name="ssg_remark'+item.student_id+'"]').css("border","1px solid red");
			$('input[name="ssg_remark'+item.student_id+'"]').attr("placeholder","Need remark")
		}
	});
</script>
