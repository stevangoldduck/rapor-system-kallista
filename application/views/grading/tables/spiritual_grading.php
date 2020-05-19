<table border="1" id="tb_class_grade" width="100%" class="table table-striped" style="text-align:center">
	<thead>
		<tr>
			<th style="text-align:center;">Student</th>
			<th style="text-align:center;">Grade Symbol</th>
			<th style="text-align:center;">Comment / Remark</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($spiritual as $item) { ?>
		<tr>
			<td><?php echo $item->student_name ?></td>
			<td><input type="text" class="form-control" name="sspg_grade<?php echo $item->student_id ?>" value="<?php echo $item->sspg_grade ?>"></td>
			<td><input type="text" class="form-control" name="sspg_remark<?php echo $item->student_id ?>" value="<?php echo $item->sspg_remark ?>"></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
