<?php
if (isset($_SESSION['success'])) {
	?>
<div class="row">
	<div class="col-lg-12">
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<?php echo $_SESSION['success']; ?>
		</div>
	</div>
</div>
<?php
}
?>

<?php
if (isset($_SESSION['error'])) {
	?>
<div class="row">
	<div class="col-lg-12">
		<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<?php echo $_SESSION['error']; ?>
		</div>
	</div>
</div>
<?php
}
?>


<?php
if (!empty(validation_errors())) {
	?>
<div class="row">
	<div class="col-lg-12">
		<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<?php echo validation_errors(); ?>
		</div>
	</div>
</div>
<?php
}
?>
