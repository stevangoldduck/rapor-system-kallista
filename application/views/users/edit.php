<?php $this->CI = &get_instance(); $this->CI->load->view('common/flash'); ?>
<div class="row mt-2">
	<div class="col-sm-12">
		<h3>Edit User</h3>
	</div>
</div>
<div class="row">
	<?php echo form_open('users/update', ['method' => 'post', 'class' => 'form-horizontal']); ?>
	<input type="hidden" name="user_id" value="<?php echo $id ?>">
	<div class="col-sm-12 col-lg-6">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Data</h3>
			</div>
			<div class="box-body">
				<?php $this->CI = &get_instance(); $this->CI->load->view('users/forms/edit'); ?>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<button type="button" class="btn btn-default">Cancel</button>
				<button type="submit" class="btn btn-info pull-right">Save</button>
			</div>
			<!-- /.box-footer -->
			
		</div>
	</div>
	<div class="col-sm-12 col-lg-6">
		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title">Permissions</h3>
			</div>
			<div class="box-body">
				<?php $this->CI = &get_instance(); $this->CI->load->view('users/forms/permissions'); ?>
			</div>
		</div>
	</div>
	</form>
</div>
