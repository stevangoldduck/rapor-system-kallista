<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Username</label>

	<div class="col-sm-10">
		<input type="text" name="username" class="form-control" id="name" placeholder="Name" value="<?php echo $username ?>">
	</div>
</div>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Name</label>

	<div class="col-sm-10">
		<input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?php echo $name ?>">
	</div>
</div>
<div class="form-group">
	<label for="email" class="col-sm-2 control-label">Email</label>

	<div class="col-sm-10">
		<input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?php echo $email ?>">
	</div>
</div>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Phone</label>

	<div class="col-sm-10">
		<input type="text" name="phone" class="form-control" id="name" placeholder="Phone" value="<?php echo $phone ?>">
	</div>
</div>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Role</label>

	<div class="col-sm-10">
		<select name="role" id="" class="form-control">
			<option value="" selected disabled>Select Role</option>
			<option value="1">Principal</option>
		</select>
	</div>
</div>
<div class="form-group">
	<label for="address" class="col-sm-2 control-label">Address</label>

	<div class="col-sm-10">
		<textarea name="address" class="form-control" id="" cols="30" rows="4"><?php echo $address ?></textarea>
	</div>
</div>
<div class="form-group">
	<label for="inputPassword3" class="col-sm-2 control-label">Password</label>

	<div class="col-sm-10">
		<input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
	</div>
</div>
