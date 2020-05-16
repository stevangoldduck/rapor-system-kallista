<!DOCTYPE html>
<html lang="en">

<head>
	<title><?php echo $title; ?></title>
	<?php $this->load->view('layouts/includes/header.php') ?>
</head>

<body class="hold-transition login-page">

	<?php echo $contents; ?>

	<?php $this->load->view('layouts/includes/footer.php') ?>
</body>

</html>
