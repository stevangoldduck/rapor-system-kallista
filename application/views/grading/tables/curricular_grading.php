<table border="1" id="tb_class_grade" width="100%" class="table table-striped" style="text-align:center">
	<thead>
		<tr>
			<th style="text-align:center;">Student</th>
			<th style="text-align:center;">Grade Symbol</th>
			<th style="text-align:center;">PMR Grade</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($club as $item) { ?>
		<tr>
			<td><?php echo $item->student_name ?></td>
			<td><input value="<?php echo $item->scg_club_grade ?>" type="text" class="form-control" name="scg_club<?php echo $item->student_id;  ?>"></td>
			<td><input value="<?php echo $item->scg_pmr_grade ?>" type="text" class="form-control"  name="scg_club<?php echo $item->student_id;  ?>"></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
