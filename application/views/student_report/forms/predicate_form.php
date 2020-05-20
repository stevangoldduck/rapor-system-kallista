<?php $alpha = ['a','b','c','d','e','f','g'] ?>  
<?php for ($i = 0; $i < 7; $i++) { ?>

<div class="form-group">
	<label for="" class="col-lg-2 label-control"><?php echo $p = $i+1; ?></label>
	<div class="col-lg-3">
		<input type="number" name="min_score_<?php echo $i ?>" value="<?php echo (isset(${"sp_min_".$alpha[$i]})) ? ${"sp_min_".$alpha[$i]} : null ?>" class="form-control" placeholder="Min Score">
	</div>
	<div class="col-lg-3">
		<input type="number" name="max_score_<?php echo $i ?>" value="<?php echo (isset(${"sp_max_".$alpha[$i]})) ? ${"sp_max_".$alpha[$i]} : null ?>" class="form-control" placeholder="Max Score">
	</div>
	<div class="col-lg-3">
		<input type="text" name="predicate_<?php echo $i ?>" value="<?php echo (isset(${"sp_p_".$alpha[$i]})) ? ${"sp_p_".$alpha[$i]} : null  ?>" class="form-control" placeholder="Predicate e.g A+">
	</div>
</div>

<?php } ?>
