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
if(isset($_SERVER['WINDIR']))
{
	require BASEPATH.'../data/page_routes.php';
}else{
	if(file_exists(BASEPATH.'../data/page_routes.php'))
	{
		$check = exec('php -l '.BASEPATH.'../data/page_routes.php');
		$stat = 'No syntax errors detected in '.BASEPATH.'../data/page_routes.php';
		if($check === $stat)
		{
			require BASEPATH.'../data/page_routes.php';
		}
	}
}
$route['admin'] = 'admin/index';
$route['cms'] = 'cms/index';
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'user/login';
$route['forgot-password'] = 'user/forgotPassword';
$route['logout'] = 'user/logout';
$route['register'] = 'user/registration';
$route['otp-registration'] = 'user/otpRegistration';
$route['resend-otp'] = 'user/resendOtp';
$route['my-account'] = 'user/my_account';

$route['schedule'] = 'user/comingSoon';

// $route['player-application'] = 'user/playerApplication';
$route['teams'] = 'user/teams';
$route['leaderboard'] = 'user/leaderboard';
$route['leaderboard/live'] = 'user/liveLeaderboard';
$route['leaderboard/online'] = 'user/onlineLeaderboard';
$route['blog'] = 'user/blog';
$route['pro-player-registration'] = 'user/proPlayerRegistartion';
$route['user-activation'] = 'user/userActivation';
$route['teams/(:any)'] = 'user/teamPage';
$route['change-password'] = 'user/changePassword';
$route['fantasy-poker'] = 'fantasy/index';
$route['fantasy-poker/create-your-team'] = 'fantasy/createFantasyTeam';
$route['fantasy-poker/preview-team'] = 'fantasy/previewFantasyTeam';
$route['fantasy-poker/day-wise-leaderboard'] = 'fantasy/dayWiseLeaderboard';
$route['fantasy-poker/cumulative-leaderboard'] = 'fantasy/cumulativeLeaderboard';

