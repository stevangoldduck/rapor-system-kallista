<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Subject Name</label>
	<div class="col-sm-10">
		<select name="grade" id="grade" class="form-control">
			<option value="" selected disabled>Select Grade</option>
			<?php $grades = 1; ?>
			<?php while ($grades < 13) { ?>
			<option value="<?php echo $grades ?>"><?php echo $grades ?></option>
			<?php $grades++;
			} ?>
		</select>
	</div>
</div>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Year</label>
	<div class="col-sm-10">
		<input type="radio" name="year[]"> Current Year &nbsp; <input name="year[]" type="radio" > All Year 
	</div>
</div>
