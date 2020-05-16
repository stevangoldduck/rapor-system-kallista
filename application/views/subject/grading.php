<?php $this->CI = &get_instance();
$this->CI->load->view('common/flash'); ?>
<div class="row mt-2">
	<div class="col-sm-12">
		<h3>Grade <?php echo $subject['subject_grade'] ?>- <?php echo $subject['subject_name'] ?></h3>
	</div>
</div>

<?php echo form_open('subjects/grading-form', ['method' => 'post', 'class' => 'form-horizontal']); ?>
<input type="hidden" name="subject_id" value="<?php echo $subject['subject_id'] ?>">
<input type="hidden" name="grade" value="<?php echo $subject['subject_grade'] ?>">
<input type="hidden" name="type" value="<?php echo $subject['subject_category'] ?>">
<?php if($subject['subject_category'] == "subject"){ ?>
<div class="row">
	<div class="col-sm-12 col-lg-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Knowledge</h3>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<?php $this->CI = &get_instance();
					$this->CI->load->view('subject/tables/subject_grading'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12 col-lg-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Skill</h3>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<?php $this->CI = &get_instance();
					$this->CI->load->view('subject/tables/subject_skill_grading'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } elseif($subject['subject_category'] == "moral"){?>
	<div class="row">
	<div class="col-sm-12 col-lg-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Spiritual Behaviour</h3>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<?php $this->CI = &get_instance();
					$this->CI->load->view('subject/tables/spiritual_grading'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } elseif($subject['subject_category'] == "social"){?>
	<div class="row">
	<div class="col-sm-12 col-lg-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Social Behaviour</h3>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<?php $this->CI = &get_instance();
					$this->CI->load->view('subject/tables/social_grading'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } else{?>
	<div class="row">
	<div class="col-sm-12 col-lg-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Co-Curricular Grade</h3>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<?php $this->CI = &get_instance();
					$this->CI->load->view('subject/tables/curricular_grading'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<div class="row">
	<div class="col-lg-12">
	<button class="btn btn-success" type="submit">Submit</button>
	</div>
</div>
</form>
