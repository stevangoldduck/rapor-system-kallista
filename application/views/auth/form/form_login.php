<div class="form-group has-feedback">
	<?php
	if (isset($_SESSION['err_credentials'])) {
		?>
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<?php echo $_SESSION['err_credentials']; ?>
	</div>
	<?php
	}
	?>
</div>
<?php echo form_open('auth/login', ['method' => 'post']); ?>
<!-- <form action="<?php echo site_url('auth/login') ?>" method="post"> -->
<div class="form-group has-feedback">
	<input type="text" class="form-control" name="username" placeholder="Username">
	<span class="glyphicon glyphicon-user form-control-feedback"></span>
	<span style="color:red"><?php echo form_error('username'); ?></span>
</div>
<div class="form-group has-feedback">
	<input type="password" class="form-control" name="password" placeholder="Password">
	<span class="glyphicon glyphicon-lock form-control-feedback"></span>
	<span style="color:red"><?php echo form_error('password'); ?></span>

</div>
<div class="row">
	<div class="col-xs-8">

		<label>
			<input type="checkbox"> Remember Me
		</label>
	</div>
	<!-- /.col -->
	<div class="col-xs-4">
		<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
	</div>
	<!-- /.col -->
</div>
</form>
