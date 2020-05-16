<div class="form-group">
	<label for="name" class="col-sm-2 control-label">NIP</label>
	<div class="col-sm-10">
		<input type="text" name="nip" class="form-control" id="name" placeholder="NIP" value="<?php echo (isset($teacher_nip)) ? $teacher_nip : null ?>">
	</div>
</div>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Name</label>
	<div class="col-sm-10">
		<input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?php echo (isset($teacher_name)) ? $teacher_name : null ?>">
	</div>
</div>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Phone</label>

	<div class="col-sm-10">
		<input type="text" name="phone" class="form-control" id="name" placeholder="Phone" value="<?php echo (isset($teacher_phone)) ? $teacher_phone : null ?>">
	</div>
</div>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Email</label>

	<div class="col-sm-10">
		<input type="email" name="email" class="form-control" id="name" placeholder="Email" value="<?php echo (isset($teacher_email)) ? $teacher_email : null ?>">
	</div>
</div>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Department</label>

	<div class="col-sm-10">
		<select name="department" id="" class="form-control">
			<option disabled>Select Department</option>
			<?php foreach($departments as $item){ ?>
			<option <?php if(isset($teacher_department_id)){ if($teacher_department_id == $item->department_id){ echo "selected" ;} } ?> value="<?php echo $item->department_id ?>"><?php echo $item->department_name ?></option>
			<?php } ?>
		</select>
	</div>
</div>
<div class="form-group">
	<label for="address" class="col-sm-2 control-label">Address</label>

	<div class="col-sm-10">
		<textarea name="address" class="form-control" id="" cols="30" rows="4"><?php echo (isset($teacher_address)) ? $teacher_address : null ?></textarea>
	</div>
</div>
