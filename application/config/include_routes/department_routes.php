<?php

$route['departments'] = 'department/index';
$route['departments/create'] = 'department/create';
$route['departments/json'] = 'department/list_dp';
$route['departments/(:num)/edit'] = 'department/edit/$1';
$route['departments/form-action'] = 'department/formAction';
