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

# ----------------------------------API------------------------------------
$route['api/getDataSurvei/(:any)'] = 'Api/getDataSurvei/$1';
$route['api/getChartDataByGroupBy/(:any)'] = 'Api/getChartDataByGroupBy/$1';

# ----------------------------------ALL------------------------------------
// Not Logged
$route['login'] = 'Auth/login';
//$route['register'] = 'Auth/register';
$route['logout'] = 'Home/logout';
$route['alumni'] = 'Home/alumni';
$route['mitra'] = 'Home/mitra';
$route['pengguna'] = 'Home/pengguna';
// Logged
$route['profile'] = 'Logged/profile';

# -------------------------------SUPERADMIN--------------------------------
$route['dashboard'] = 'Superadmin/index';
// Survei
$route['survei/(:any)'] = 'Superadmin/survei/$1';
$route['survei/(:any)/(:num)'] = 'Superadmin/survei/$1';
$route['survei/(:any)/(:num)'] = 'Superadmin/survei/$1';
$route['survei/(:any)/create'] = 'Superadmin/create_survei/$1';
$route['survei/(:any)/edit/(:num)'] = 'Superadmin/edit_survei/$1/$2';
$route['survei/(:any)/detail/(:num)'] = 'Superadmin/detail_survei/$1/$2';
$route['survei/(:any)/delete'] = 'Superadmin/delete_survei/$1';
// Period
$route['manage-period'] = 'Superadmin/period';
$route['manage-period/create'] = 'Superadmin/create_period';
$route['manage-period/detail/(:num)'] = 'Superadmin/detail_period/$1';
$route['manage-period/edit/(:num)'] = 'Superadmin/edit_period/$1';
$route['manage-period/delete'] = 'Superadmin/delete_period';
// Category Survey
$route['manage-category'] = 'Superadmin/category';
$route['manage-category/create'] = 'Superadmin/create_category';
$route['manage-category/detail/(:num)'] = 'Superadmin/detail_category/$1';
$route['manage-category/edit/(:num)'] = 'Superadmin/edit_category/$1';
$route['manage-category/delete'] = 'Superadmin/delete_category';
# -----------------------------------DOSEN---------------------------------
$route['dosen/dashboard'] = 'Dosen/index';
$route['dosen/result/(:any)'] = 'Dosen/result/$1';
$route['dosen/detail/(:any)'] = 'Dosen/detail/$1';
$route['dosen/detail/(:any)/(:num)'] = 'Dosen/detail/$1';

# -----------------------------------Mahasiswa---------------------------------
$route['mahasiswa/dashboard']['GET'] = 'Mahasiswa/index';
$route['mahasiswa/(:any)/survei'] = 'Mahasiswa/survei/$1';