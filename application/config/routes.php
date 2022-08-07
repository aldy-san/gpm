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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

# ----------------------------------TES------------------------------------
$route['tes'] = 'Admin/tes';
$route['tes/(:num)'] = 'Admin/tes';
$route['tes/create'] = 'Admin/createTes';
$route['tes/edit/(:num)'] = 'Admin/editTes/$1';
$route['tes/detail/(:num)'] = 'Admin/detailTes/$1';
$route['tes/delete'] = 'Admin/deleteTes';
# ----------------------------------API------------------------------------
$route['api/getDataSurvei/(:any)'] = 'Api/getDataSurvei/$1';
$route['api/getChartDataByIdSurvei/(:num)'] = 'Api/getChartDataByIdSurvei/$1';

# ----------------------------------ALL------------------------------------

$route['login'] = 'Auth/login';
$route['register'] = 'Auth/register';
$route['logout'] = 'Home/logout';

# -------------------------------SUPERADMIN--------------------------------
$route['dashboard'] = 'Superadmin/index';
$route['survei/(:any)'] = 'Superadmin/survei/$1';
$route['survei/(:any)/(:num)'] = 'Superadmin/survei/$1';
$route['survei/(:any)/create'] = 'Superadmin/create_survei/$1';
$route['survei/(:any)/edit/(:num)'] = 'Superadmin/edit_survei/$1/$2';
$route['survei/(:any)/detail/(:num)'] = 'Superadmin/detail_survei/$1/$2';
$route['survei/(:any)/delete'] = 'Superadmin/delete_survei/$1';

# -----------------------------------DOSEN---------------------------------
$route['dosen/dashboard'] = 'Dosen/index';
$route['dosen/result/(:any)'] = 'Dosen/result/$1';