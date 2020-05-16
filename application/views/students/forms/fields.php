<div class="form-group">
	<label for="name" class="col-sm-2 control-label">NIS</label>
	<div class="col-sm-10">
		<input type="text" name="nis" class="form-control" id="name" placeholder="NIS" value="<?php echo (isset($student_nis)) ? $student_nis : null ?>">
	</div>
</div>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">NISN</label>
	<div class="col-sm-10">
		<input type="text" name="nisn" class="form-control" id="name" placeholder="NISN" value="<?php echo (isset($student_nisn)) ? $student_nisn : null ?>">
	</div>
</div>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Name</label>
	<div class="col-sm-10">
		<input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?php echo (isset($student_name)) ? $student_name : null ?>">
	</div>
</div>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Place of Birth</label>

	<div class="col-sm-10">
		<input type="text" name="pob" class="form-control" placeholder="Place of Birth" value="<?php echo (isset($student_pob)) ? $student_pob : null ?>">
	</div>
</div>
<div class="form-group">
	<label for="email" class="col-sm-2 control-label">Date of Birth</label>

	<div class="col-sm-10">
		<input type="date" name="dob" class="form-control"  placeholder="DOB" value="<?php echo (isset($student_dob)) ? strtotime($student_dob) : null ?>">
	</div>
</div>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Phone</label>

	<div class="col-sm-10">
		<input type="text" name="phone" class="form-control" id="name" placeholder="Phone" value="<?php echo (isset($student_phone)) ? $student_phone : null ?>">
	</div>
</div>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Email</label>

	<div class="col-sm-10">
		<input type="email" name="email" class="form-control" id="name" placeholder="Email" value="<?php echo (isset($student_email)) ? $student_email : null ?>">
	</div>
</div>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Department</label>

	<div class="col-sm-10">
		<select name="department" id="" class="form-control">
			<option disabled>Select Department</option>
			<option selected value="1">High School</option>
		</select>
	</div>
</div>
<div class="form-group">
	<label for="address" class="col-sm-2 control-label">Address</label>

	<div class="col-sm-10">
		<textarea name="address" class="form-control" id="" cols="30" rows="4"><?php echo (isset($student_address)) ? $student_address : null ?></textarea>
	</div>
</div>
