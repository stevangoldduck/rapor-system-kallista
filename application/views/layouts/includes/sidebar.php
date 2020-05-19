<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?php echo $_SESSION['user_logged']->username ?></p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>

		<?php $data_permissions = json_decode($_SESSION['user_logged']->user_access, TRUE) ?>

		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">MAIN NAVIGATION</li>
			<li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-book"></i> <span>Dashboard</span></a></li>
			<li><a href="<?php echo site_url('grading-submissions') ?>"><i class="fa fa-book"></i> <span>Grade Submissions</span></a></li>
			<?php if (array_key_exists("view_student", $data_permissions) || array_key_exists("view_class", $data_permissions) || array_key_exists("view_subject", $data_permissions) || array_key_exists("view_subject_group", $data_permissions)) { ?>
			<li class="header">MASTER DATA</li>
			<?php if (array_key_exists("view_student", $data_permissions)) { ?>
			<li><a href="<?php echo site_url('students') ?>"><i class="fa fa-black-tie"></i> <span>Students</span></a></li>
			<?php } ?>
			<?php if (array_key_exists("view_class", $data_permissions)) { ?>
			<li><a href="<?php echo site_url('classes') ?>"><i class="fa fa-mortar-board"></i> <span>Classes</span></a></li>
			<?php } ?>
			<?php if (array_key_exists("view_subject", $data_permissions) || array_key_exists("view_subject_group", $data_permissions)) { ?>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-list-alt"></i>
					<span>Subjects</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<?php if (array_key_exists("view_subject", $data_permissions)) { ?>
					<li><a href="<?php echo site_url('subjects') ?>"><i class="fa fa-file"></i> <span>Subjects</span></a></li>
					<?php } ?>
					<?php if (array_key_exists("view_subject_group", $data_permissions)) { ?>
					<li><a href="<?php echo site_url('subjects-group') ?>"><i class="fa fa-file"></i> <span>Subject Group</span></a></li>
					<?php } ?>
				</ul>
			</li>
			<?php } ?>
			<?php } ?>
			<?php if (array_key_exists("view_teacher", $data_permissions)) { ?>
			<li><a href="<?php echo site_url('teachers') ?>"><i class="fa fa-user-md"></i> <span>Teacher</span></a></li>
			<?php } ?>
			<?php if (array_key_exists("view_student_report", $data_permissions) || array_key_exists("view_class_report", $data_permissions) || array_key_exists("view_subject_report", $data_permissions) || array_key_exists("view_teacher_report", $data_permissions)) { ?>
			<li class="header">REPORT</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-folder"></i>
					<span>Reports</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<?php if (array_key_exists("view_student_report", $data_permissions)) { ?>
					<li><a href=""><i class="fa fa-file"></i> <span>Generate Student Report</span></a></li>
					<?php } ?>
					<?php if (array_key_exists("view_class_report", $data_permissions)) { ?>
					<li><a href=""><i class="fa fa-file"></i> <span>Generate Class Report</span></a></li>
					<?php } ?>
					<?php if (array_key_exists("view_subject_report", $data_permissions)) { ?>
					<li><a href=""><i class="fa fa-file"></i> <span>Generate Subject Report</span></a></li>
					<?php } ?>
					<?php if (array_key_exists("view_teacher_report", $data_permissions)) { ?>
					<li><a href=""><i class="fa fa-file"></i> <span>Generate Teacher Report</span></a></li>
					<?php } ?>
				</ul>
			</li>
			<?php } ?>
			<?php if (array_key_exists("view_user", $data_permissions) || array_key_exists("view_department", $data_permissions)) { ?>
			<li class="header">SETTING</li>
			<?php } ?>
			<?php if (array_key_exists("view_user", $data_permissions)) { ?>
			<li><a href="<?php echo site_url('users') ?>"><i class="fa fa-calendar-minus-o"></i> <span>Users</span></a></li>
			<?php } ?>
			<?php if (array_key_exists("view_department", $data_permissions)) { ?>
			<li><a href="<?php echo site_url('departments') ?>"><i class="fa fa-calendar-minus-o"></i> <span>Deparment</span></a></li>
			<?php } ?>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>
