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
$route['default_controller'] = 'index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/**
 * Api Routes
 */

/**
 * App Modules
 */
$route['api/app/modules']['get'] = 'api/app/modules/listrows';
$route['api/app/modules/(:num)']['get'] = 'api/app/modules/record/$1';
$route['api/app/modules']['post'] = 'api/app/modules/save';
$route['api/app/modules']['put'] = 'api/app/modules/save';
$route['api/app/modules/(:num)']['put'] = 'api/app/modules/save';
$route['api/app/modules']['delete'] = 'api/app/modules/delete';
$route['api/app/modules/(:num)']['delete'] = 'api/app/modules/delete';

/**
 * App Controllers
 */
$route['api/app/controllers']['get'] = 'api/app/controllers/listrows';
$route['api/app/controllers/(:num)']['get'] = 'api/app/controllers/record/$1';
$route['api/app/controllers']['post'] = 'api/app/controllers/save';
$route['api/app/controllers']['put'] = 'api/app/controllers/save';
$route['api/app/controllers/(:num)']['put'] = 'api/app/controllers/save';
$route['api/app/controllers']['delete'] = 'api/app/controllers/delete';
$route['api/app/controllers/(:num)']['delete'] = 'api/app/controllers/delete';

/**
 * App Actions
 */
$route['api/app/actions']['get'] = 'api/app/actions/listrows';
$route['api/app/actions/(:num)']['get'] = 'api/app/actions/record/$1';
$route['api/app/actions']['post'] = 'api/app/actions/save';
$route['api/app/actions']['put'] = 'api/app/actions/save';
$route['api/app/actions/(:num)']['put'] = 'api/app/actions/save';
$route['api/app/actions']['delete'] = 'api/app/actions/delete';
$route['api/app/actions/(:num)']['delete'] = 'api/app/actions/delete';

/**
 * User users
 */
$route['api/user/users']['get'] = 'api/user/users/listrows';
$route['api/user/users/(:num)']['get'] = 'api/user/users/record/$1';
$route['api/user/users']['post'] = 'api/user/users/save';
$route['api/user/users']['put'] = 'api/user/users/save';
$route['api/user/users/(:num)']['put'] = 'api/user/users/save';
$route['api/user/users']['delete'] = 'api/user/users/delete';
$route['api/user/users/(:num)']['delete'] = 'api/user/users/delete';

