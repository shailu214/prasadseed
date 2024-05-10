<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['batch/page/(:num)'] = 'batch/index/$1';
$route['batch/page'] = 'batch/index';

$route['student/page/(:num)'] = 'student/index/$1';
$route['student/page'] = 'student/index';

$route['exam/page/(:num)'] = 'exam/index/$1';
$route['exam/page'] = 'exam/index';

$route['leave/(:num)'] = 'leave/index/$1';
$route['leave/(:num)/(:num)'] = 'leave/index/$1/$2';
$route['leave/(:num)/(:num)/(:num)'] = 'leave/index/$1/$2/$3';
// $route['staff/page'] = 'staff/index';

$route['holiday/(:num)'] = 'holiday/index/$1';
$route['holiday/(:num)/(:num)'] = 'holiday/index/$1/$2';
$route['holiday/(:num)/(:num)/(:num)'] = 'holiday/index/$1/$2/$3';

$route['staff/page/(:num)'] = 'staff/index/$1';
$route['staff/page'] = 'staff/index';

$route['logout'] = 'login/logout';

$route['checkstd/(:num)'] = 'checkstd/index/$1';

$route['due'] = 'notiview/dues';
$route['dues/print'] = 'notiview/dprint';
$route['due/(:any)/(:any)'] = 'notiview/dues/$1/$1';

$route['absent'] = 'notiview/absent';
$route['absent/(:num)'] = 'notiview/absent/$1';

$route['fee/batch/page/(:num)/(:num)'] = 'fee/batch/$1/$2';
$route['fee/batch/page/(:num)'] = 'fee/batch/$1';
$route['fee/batch/(:num)'] = 'fee/batch/$1';
$route['fee/batch/(:num)/(:num)'] = 'fee/batch/$1/$2';

$route['fee/due/page/(:num)/(:num)'] = 'fee/due/$1/$2';
$route['fee/due/page/(:num)'] = 'fee/due/$1';
$route['fee/due/(:num)'] = 'fee/due/$1';

$route['log'] = 'notiview/log';
$route['log/(:num)'] = 'notiview/log/$1';

$route['subcategory'] = 'category/sbcat';
$route['subcategory/add'] = 'category/sbcat_add';
$route['subcategory/edit/(:any)'] = 'category/sbcat_edit/$1';
$route['subcategory/page'] = 'category/sbcat';
$route['subcategory/page/(:any)'] = 'category/sbcat/$1';

$route['download-certificate'] = 'certificate/index';
$route['view-certificate'] = 'certificate/view';