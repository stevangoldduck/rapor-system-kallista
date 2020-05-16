<?php

$route['grading-submissions'] = 'grading/index';
$route['grading-submissions/(:num)/view'] = 'grading/show/$1';
$route['grading-submissions/json'] = 'grading/list_grading';
$route['grading/grading-approval'] = 'grading/approve_grading';
