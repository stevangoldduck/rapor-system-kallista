<table border="1" id="tb_class_grade" width="100%" class="table table-striped" style="text-align:center">
	<thead>
		<tr>
			<th style="text-align:center;">Student</th>
			<th style="text-align:center;">Grade Symbol</th>
			<th style="text-align:center;">Comment / Remark</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($social as $item) { ?>
		<tr>
			<td><?php echo $item->student_name ?></td>
			<td><input type="text" class="form-control" value="<?php echo $item->ssbg_grade ?>" name=""></td>
			<td><input type="text" class="form-control" value="<?php echo $item->ssbg_remark ?>" name=""></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
