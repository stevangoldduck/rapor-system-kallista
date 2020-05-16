<?php

$route['classes'] = 'classes';
$route['classes/json'] = 'classes/list_class';
$route['classes/(:num)/edit'] = 'classes/edit/$1';
$route['classes/form-action'] = 'classes/formAction';
$route['classes/class-by-grade'] = 'classes/classByGrade';
$route['classes/student-list'] = 'classes/student_list';
$route['classes/subject-list'] = 'classes/subject_list';
$route['classes/add-subject-and-student'] = 'classes/add_subject_student';
