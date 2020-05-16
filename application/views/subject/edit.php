<?php $this->CI = &get_instance();
$this->CI->load->view('common/flash'); ?>
<div class="row mt-2">
	<div class="col-sm-12">
		<h3>Edit Subject</h3>
	</div>
</div>
<div class="row" style="margin-bottom:5px;">
	<div class="col-sm-12">
		<a href="<?php echo site_url('subjects/' . $subject_id . '/grade/' . $subject_grade . '/grading') ?>" class="btn btn-success">
			Grade now
		</a>
	</div>
</div>
<div class="row mt-5">
	<?php echo form_open('subjects/form-action', ['method' => 'post', 'class' => 'form-horizontal']); ?>
	<input type="hidden" name="action_type" value="update">
	<input type="hidden" name="subject_id" value="<?php echo $subject_id ?>">
	<div class="col-sm-12 col-lg-6">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Data</h3>
			</div>
			<div class="box-body">
				<?php $this->CI = &get_instance();
				$this->CI->load->view('subject/forms/fields'); ?>
			</div>
			<div class="box-footer">
				<button type="button" class="btn btn-default">Cancel</button>
				<button type="submit" class="btn btn-info pull-right">Save</button>
			</div>
		</div>
	</div>
	<?php if ($subject_category == "subject") { ?>
	<div class="col-sm-12 col-lg-3">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Assesment Weight Knowledge</h3>
			</div>
			<div class="box-body">
				<span style="color:red" id="msg_awk"></span>
				<?php $this->CI->load->view('subject/forms/aw_knowledge_form'); ?>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-lg-3">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Assesment Weight Skill</h3>
			</div>
			<div class="box-body">
				<span style="color:red" id="msg_aws"></span>
				<?php $this->CI->load->view('subject/forms/aw_skill_form'); ?>
			</div>
		</div>
	</div>
	
	<?php } ?>
</div>

<?php if ($subject_category == "subject") { ?>
<div class="row mt-5">
	<div class="col-sm-12 col-lg-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Predicate Conversion</h3>
			</div>
			<div class="box-body">
				<?php $this->CI = &get_instance();
					$this->CI->load->view('subject/forms/predicate_form'); ?>
			</div>
		</div>
	</div>
</div>
</form>
<?php } ?>

<div class="row">
	<div class="col-sm-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Student List</h3>
			</div>
			<div class="box-body">
				<table id="tb_subject_student" width="100%">
					<thead>
						<tr>
							<th>Name</th>
							<th>NIS</th>
							<th>NISN</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
