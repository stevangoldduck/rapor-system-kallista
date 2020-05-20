<div class="row">
	<div class="col-lg-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Filter</h3>
			</div>
			<div class="box-body">
				<form target="_blank" action="<?php echo site_url('student-report/generate_student_report') ?>" method="POST">
				<div class="col-sm-4">
					<label for="">Student Name</label>
					<select name="student_id" class="form-control select2" style="width: 100%;">
						<?php foreach ($students as $item) { ?>
						<option value="<?php echo $item->student_id ?>"><?php echo $item->student_name ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-sm-4">
					<label for="">Academic Year</label>
					<select name="ac_year" class="form-control">
						<option selected="selected" value="2018/2019">2018/2019</option>
						<option value="2019/2020">2019/2020</option>
						<option value="2020/2021">2020/2021</option>
					</select>
				</div>
				<div class="col-sm-4">
					<label for="">Raport Type</label>
					<select name="raport_type" class="form-control">
						<option value="1" selected="selected">Midterm Raport</option>
						<option value="2">Final Raport</option>
					</select>
				</div>
				<div class="col-sm-12" style="margin-top:15px;">
					<button type="submit" class="btn btn-success">Generate Selected Student Report</a>
				</div>
				
				</form>
			</div>
		</div>
	</div>
</div>
