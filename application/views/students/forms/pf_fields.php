<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Father Name</label>
	<div class="col-sm-10">
		<input type="text" name="f_name" class="form-control" placeholder="Father Name" value="<?php echo (isset($student_father_name)) ? $student_father_name : null ?>">
	</div>
</div>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Father Phone</label>
	<div class="col-sm-10">
		<input type="text" name="f_phone" class="form-control" placeholder="Father Phone" value="<?php echo (isset($student_father_phone)) ? $student_father_phone : null ?>">
	</div>
</div>
<div class="form-group">
	<label for="address" class="col-sm-2 control-label">Father Address</label>
	<div class="col-sm-10">
		<textarea name="f_address" class="form-control" id="" cols="30" rows="4"><?php echo (isset($student_father_address)) ? $student_father_address : null ?></textarea>
	</div>
</div>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Mother Name</label>
	<div class="col-sm-10">
		<input type="text" name="m_name" class="form-control" placeholder="Mother Phone" value="<?php echo (isset($student_mother_name)) ? $student_mother_name : null ?>">
	</div>
</div>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Mother Phone</label>
	<div class="col-sm-10">
		<input type="text" name="m_phone" class="form-control" placeholder="Mother Address" value="<?php echo (isset($student_mother_phone)) ? $student_mother_phone : null ?>">
	</div>
</div>
<div class="form-group">
	<label for="address" class="col-sm-2 control-label">Mother Address</label>
	<div class="col-sm-10">
		<textarea name="m_address" class="form-control" id="" cols="30" rows="4"><?php echo (isset($student_mother_address)) ? $student_mother_address : null ?></textarea>
	</div>
</div>

