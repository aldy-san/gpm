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
$route['api/getChartDataByGroupBy/(:any)/(:num)'] = 'Api/getChartDataByGroupBy/$1/$2';
$route['api/getTotalData/(:num)'] = 'Api/getTotalData/$1';
$route['api/getTable/(:any)'] = 'Api/getTable/$1';

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
$route['change-password'] = 'Logged/change_password';
// Result
$route['survei_result'] = 'Home/survei_result';
$route['result/(:any)'] = 'Home/result/$1';
$route['result/(:any)/(:num)'] = 'Home/result/$1/$2';
$route['result/(:any)/(:num)/responden'] = 'Home/responden/$1/$2';
$route['result/(:any)/(:num)/responden/(:num)'] = 'Home/responden/$1/$2';
$route['detail/(:any)'] = 'Home/detail/$1';
$route['detail/(:any)/(:num)'] = 'Home/detail/$1';
$route['survei_dosen_result'] = 'Home/survei_dosen_result';

$route['constitution'] = 'Home/constitution';


# -------------------------------SUPERADMIN--------------------------------
$route['dashboard'] = 'Superadmin/index';
$route['settings'] = 'Superadmin/settings';

// Survei
$route['survei/(:any)'] = 'Superadmin/survei/$1';
$route['survei/(:any)/(:num)'] = 'Superadmin/survei/$1';
$route['survei/(:any)/create'] = 'Superadmin/create_survei/$1';
$route['survei/(:any)/edit/(:num)'] = 'Superadmin/edit_survei/$1/$2';
$route['survei/(:any)/detail/(:num)'] = 'Superadmin/detail_survei/$1/$2';
$route['survei/(:any)/delete'] = 'Superadmin/delete_survei/$1';

// constitution
$route['manage-constitution'] = 'Superadmin/constitution';
$route['manage-constitution/(:num)'] = 'Superadmin/constitution';
$route['manage-constitution/create'] = 'Superadmin/create_constitution';
$route['manage-constitution/detail/(:num)'] = 'Superadmin/detail_constitution/$1';
$route['manage-constitution/edit/(:num)'] = 'Superadmin/edit_constitution/$1';
$route['manage-constitution/delete'] = 'Superadmin/delete_constitution';
// Period
$route['manage-period'] = 'Superadmin/period';
$route['manage-period/(:num)'] = 'Superadmin/period';
$route['manage-period/create'] = 'Superadmin/create_period';
$route['manage-period/detail/(:num)'] = 'Superadmin/detail_period/$1';
$route['manage-period/edit/(:num)'] = 'Superadmin/edit_period/$1';
$route['manage-period/delete'] = 'Superadmin/delete_period';
// Analisis
$route['manage-period/analisis/(:num)'] = 'Superadmin/analisis/$1'; // just for redirect
$route['manage-period/analisis/(:num)/(:any)'] = 'Superadmin/analisis/$1/$2';
$route['manage-period/analisis/edit/(:num)/(:any)'] = 'Superadmin/edit_analisis/$1/$2';
$route['manage-period/analisis/delete/(:num)'] = 'Superadmin/delete_analisis/$1';

// Category Survey
$route['manage-category'] = 'Superadmin/category';
$route['manage-category/(:num)'] = 'Superadmin/category';
$route['manage-category/create'] = 'Superadmin/create_category';
$route['manage-category/detail/(:num)'] = 'Superadmin/detail_category/$1';
$route['manage-category/detail/dosen-terbaik'] = 'Superadmin/detail_category/dosen_terbaik';
$route['manage-category/edit/(:num)'] = 'Superadmin/edit_category/$1';
$route['manage-category/delete'] = 'Superadmin/delete_category';

# -----------------------------------DOSEN---------------------------------
$route['dosen/dashboard'] = 'Dosen/index';

// Repository
$route['repository'] = 'Logged/repository';
$route['repository/(:num)'] = 'Logged/repository';
$route['repository/all'] = 'Logged/all_repository';
$route['repository/all/(:num)'] = 'Logged/all_repository';
$route['repository/create'] = 'Logged/create_repository';
$route['repository/detail/(:num)'] = 'Logged/detail_repository/$1';
$route['repository/edit/(:num)'] = 'Logged/edit_repository/$1';
$route['repository/delete'] = 'Logged/delete_repository';

$route['analisis-periode'] = 'Dosen/analisis_periode';
// Analisis
$route['analisis-periode/analisis/(:num)'] = 'Dosen/analisis/$1'; // just for redirect
$route['analisis-periode/analisis/(:num)/(:any)'] = 'Dosen/analisis/$1/$2';
$route['analisis-periode/analisis/edit/(:num)/(:any)'] = 'Dosen/edit_analisis/$1/$2';

# -----------------------------------Mahasiswa---------------------------------
$route['mahasiswa/dashboard'] = 'Mahasiswa/index';
$route['mahasiswa/survei_dosen'] = 'Logged/survei_dosen';

# -----------------------------------Tendik---------------------------------
$route['tendik/dashboard'] = 'Tendik/index';

# -----------------------------------SURVEI---------------------------------

$route['dosen/survei/(:num)'] = 'Logged/survei/$1';
$route['mahasiswa/survei/(:num)'] = 'Logged/survei/$1';
$route['tendik/survei/(:num)'] = 'Logged/survei/$1';
$route['(:any)/survei'] = 'Home/survei/$1';