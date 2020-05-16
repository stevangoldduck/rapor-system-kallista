<!DOCTYPE html>
<html lang="en">

<head>
	<title><?php echo $title; ?></title>
	<?php $this->load->view('layouts/includes/header.php') ?>
	<?php if(isset($push_css)){echo $push_css;} ?>
</head>

<body class="skin-yellow sidebar-mini">

	<div class="wrapper">
		<?php $this->load->view('layouts/includes/navbar.php') ?>
		<?php $this->load->view('layouts/includes/sidebar.php') ?>
		<div class="content-wrapper">
			<section class="content">
				<?php echo $contents; ?>
			</section>
		</div>
	</div>

	<?php $this->load->view('layouts/includes/footer.php') ?>
	<?php if(isset($push_js)){echo $push_js;} ?>
</body>

</html>
