<div class="login-box">
	<div class="login-logo">
		<a href=""><b>Rapor</b>System</a>
	</div>
	<!-- /.login-logo -->
	<div class="login-box-body">
		<p class="login-box-msg">Sign in</p>
		
		<?php $this->CI = &get_instance(); $this->CI->load->view('auth/form/form_login') ?>

		<!-- <a href="#">I forgot my password</a><br> -->

	</div>
	<!-- /.login-box-body -->
</div>
