<div class="form-group">
	<?php foreach($access as $item){ ?>
	<div class="col-lg-4" style="margin-bottom:10px;">
	<?php $permissions = $user_access ? json_decode($user_access, TRUE): [] ?>
		<?php echo $item['ap_name'] ?> 
		<input type="checkbox" <?php foreach($permissions as $key => $val){if($key == $item['ap_permission']){ echo "checked";}}  ?> name="<?php echo $item['ap_permission'] ?>" value="1">
	</div>
	<?php } ?>
</div>
