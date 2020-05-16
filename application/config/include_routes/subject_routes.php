<?php

$route['subjects'] = 'subjects';
$route['subjects/json'] = 'subjects/list_subject';
$route['subjects/student-json'] = 'subjects/list_subject_student';
$route['subjects/(:num)/edit'] = 'subjects/edit/$1';
$route['subjects/form-action'] = 'subjects/formAction';
$route['subjects/(:num)/grade/(:num)/grading'] = 'subjects/grading/$1/$2';

$route['subjects/grading-form'] = 'subjects/grading_submission';
