<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

/*
$route['default_controller'] = "pages/view";
$route['(:any)'] = 'pages/view/$1';
*/
$route['default_controller'] = "home";
$route['404_override'] = '';
$route['main'] = "home/dashboard";
$route['browse'] = "home/browse";
$route['important_dates'] = "home/important_dates";
$route['resources'] = "home/resources";
$route['help'] = "home/main_help";
$route['general_help'] = "home/general_help";
$route['invites'] = "invites";
$route['profile/edit'] = 'profile/edit';
$route['profile/view/(:any)'] = 'profile/view/$1';
$route['profile/interests/edit'] = 'tag_rels/edit_user';
$route['group'] = 'group/landing';
$route['group/view/(:any)'] = 'group/view/$1';
$route['group/edit/(:any)'] = 'group/edit/$1';
$route['group/new'] = 'group/create/';
$route['group/interests/edit/(:any)'] = 'tag_rels/edit_group/$1';
$route['login'] = "login/loginHandler";
$route['logout'] = "login/logoutHandler";



/* End of file routes.php */
/* Location: ./application/config/routes.php */