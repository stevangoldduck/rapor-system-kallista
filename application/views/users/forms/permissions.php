<div class="form-group">
	<?php foreach($access as $item){ ?>
	<div class="col-lg-4">
		<?php echo $item['ap_name'] ?> <input type="checkbox" name="<?php echo $item['ap_permission'] ?>" value="1">
	</div>
	<?php } ?>
</div>
