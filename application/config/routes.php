<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'auth';

include('include_routes/auth.php');
include('include_routes/dashboard_routes.php');
include('include_routes/user_routes.php');
include('include_routes/student_routes.php');
include('include_routes/class_routes.php');
include('include_routes/subject_routes.php');
include('include_routes/grading_routes.php');
include('include_routes/subject_group_routes.php');
include('include_routes/department_routes.php');
include('include_routes/teacher_routes.php');
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
