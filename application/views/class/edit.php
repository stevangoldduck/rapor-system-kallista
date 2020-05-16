<?php $this->CI = &get_instance();
$this->CI->load->view('common/flash'); ?>
<div class="row mt-2">
	<div class="col-sm-12">
		<h3>Edit Class</h3>
	</div>
</div>
<div class="row">
	<?php echo form_open('classes/form-action', ['method' => 'post', 'class' => 'form-horizontal']); ?>
	<input type="hidden" name="action_type" value="update">
	<input type="hidden" name="class_id" value="<?php echo $class_id ?>">
	<div class="col-sm-12 col-lg-12">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Data</h3>
			</div>
			<div class="box-body">
				<?php $this->CI = &get_instance();
				$this->CI->load->view('class/forms/fields'); ?>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<button type="button" class="btn btn-default">Cancel</button>
				<button type="submit" class="btn btn-info pull-right">Save</button>
			</div>
			<!-- /.box-footer -->
			</form>
		</div>
	</div>
</div>
<div class="row">
	<?php echo form_open('classes/add-subject-and-student', ['method' => 'post', 'class' => 'form-horizontal']); ?>
	<input type="hidden" name="class_id" value="<?php echo $class_id ?>">
	<div class="col-sm-12 col-lg-12">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-body">
				<div class="row">
					<div class="col-sm-6">
						<h3>Student List</h3>
						<table id="tb_class_student" width="100%">
							<thead>
								<tr>
									<th><input type="checkbox" id=""></th>
									<th>Student Name</th>
									<th>NIS</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					<div class="col-sm-6">
						<h3>Subject List</h3>
						<table id="tb_class_subjects" width="100%">
							<thead>
								<tr>
									<th><input type="checkbox" id=""></th>
									<th>Subject Name</th>
									<th>Subject Code</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" class="btn btn-info pull-right">Select All Checked</button>
			</div>
			<!-- /.box-footer -->
			</form>
		</div>
	</div>
</div>
