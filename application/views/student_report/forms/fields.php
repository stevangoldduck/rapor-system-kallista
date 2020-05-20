<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Code</label>

	<div class="col-sm-10">
		<input type="text" name="subject_code"  class="form-control"  placeholder="ENG1" value="<?php echo (isset($subject_code)) ? $subject_code : null ?>">
	</div>
</div>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Subject Name</label>

	<div class="col-sm-10">
		<input type="text" name="subject_name" class="form-control"  placeholder="Subject Name" value="<?php echo (isset($subject_name)) ? $subject_name : null ?>" >
	</div>
</div>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">SCC</label>

	<div class="col-sm-10">
		<input type="text" name="subject_scc" class="form-control"  placeholder="Subject Name" value="<?php echo (isset($subject_scc)) ? $subject_scc : null ?>" >
	</div>
</div>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Grade</label>
	<div class="col-sm-10">
		<select name="grade" id="" class="form-control">
			<option value="" selected disabled>Select Grade</option>
			<?php $grades = 1; ?>
			<?php while($grades<13){ ?>
				<option <?php if(isset($subject_grade)){ if($subject_grade == $grades){ echo "selected";} } ?>  value="<?php echo $grades ?>"><?php echo $grades ?></option>
			<?php $grades++;}?> 
		</select>
	</div>
</div>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Teacher</label>
	<div class="col-sm-10">
		<select name="teacher" class="form-control">
			<option selected disabled>Select Teacher</option>
			<?php foreach($teachers as $item){ ?>
			<option <?php if(isset($subject_teacher_id)){ if($item->id == $subject_teacher_id){ echo "selected";} } ?> value="<?php echo $item->id ?>"><?php echo $item->name?></option>
			<?php } ?>
		</select>
	</div>
</div>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Category</label>

	<div class="col-sm-10">
		<select name="category" id="" class="form-control">
			<option selected disabled>Select Category</option>
			<option <?php if(isset($subject_category)){ if("moral"== $subject_category){ echo "selected";} } ?>  value="moral">Moral</option>
			<option <?php if(isset($subject_category)){ if("subject"== $subject_category){ echo "selected";} } ?> value="subject">Subject</option>
			<option <?php if(isset($subject_category)){ if("social"== $subject_category){ echo "selected";} } ?> value="social">Social</option>
			<option <?php if(isset($subject_category)){ if("curricular"== $subject_category){ echo "selected";} } ?> value="curricular">Curricular</option>
		</select>
	</div>
</div>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Group</label>

	<div class="col-sm-10">
		<select name="group" id="" class="form-control">
			<option selected disabled>Select Group</option>
			<?php foreach($subject_groups as $item){ ?>
			<option <?php if(isset($subject_group_id)){ if($item->sg_id == $subject_group_id){ echo "selected";} } ?> value="<?php echo $item->sg_id ?>"><?php echo $item->sg_name ?></option>
			<?php } ?>
		</select>
	</div>
</div>
