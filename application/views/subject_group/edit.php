<?php $this->CI = &get_instance(); $this->CI->load->view('common/flash'); ?>
<div class="row mt-2">
	<div class="col-sm-12">
		<h3>Edit Subject Group</h3>
	</div>
</div>
<div class="row">
	<?php echo form_open('subjects-group/form-action', ['method' => 'post', 'class' => 'form-horizontal']); ?>
	<input type="hidden" name="action_type" value="update">
	<input type="hidden" name="sg_id" value="<?php echo $sg_id ?>">
	<div class="col-sm-12 col-lg-6">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Data</h3>
			</div>
			<div class="box-body">
				<?php $this->CI = &get_instance(); $this->CI->load->view('subject_group/forms/fields'); ?>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<button type="button" class="btn btn-default">Cancel</button>
				<button type="submit" class="btn btn-info pull-right">Save</button>
			</div>
			<!-- /.box-footer -->
		</div>
	</div>
</form>
</div>
