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
$route['default_controller'] = 'welcome';

$route['login'] = 'Login/verifyUser';
$route['salt'] = 'Login/getsalt';
$route['logout'] = 'Login/logout';
$route['forgotPassword'] = 'Login/resetPassword';

$route['mSalt'] = 'Login/getsaltMobile';
$route['mLogin'] = 'Login/verifyUserMobile';


$route['dashboardDetails'] = 'Dashboard/getDashboardCount';
$route['alerts'] = 'Dashboard/alerts';


$route['menuMasterList'] = 'MenuMaster/getMenuDetails';
$route['menuMaster'] = 'MenuMaster/menuMaster';
$route['menuMaster/(:num)'] = 'MenuMaster/menuMaster/$1';
$route['menuMaster/status'] = 'MenuMaster/menuChangeStatus';
$route['getMenuList'] = 'MenuMaster/getMenuList';
$route['accessMenuList/(:num)'] = 'MenuMaster/accessMenuList/$1';
$route['getUserPermission'] = 'MenuMaster/getUserPermission';
$route['userAccess'] = 'MenuMaster/userAccess';
$route['accessCompanyList/(:num)'] = 'MenuMaster/accessCompanyList/$1';



$route['admins'] = 'SearchAdmin/index';
$route['admins/status'] = 'SearchAdmin/changeStatus';
$route['addadmin/(:num)'] = 'SearchAdmin/getAdminDetails/$1';
$route['addadmin'] = 'SearchAdmin/getAdminDetails';
$route['adduser'] = 'SearchAdmin/adduser';
$route['resetPasswordRequest'] = 'SearchAdmin/resetPasswordRequest';
$route['validateOtp/(:num)'] = 'SearchAdmin/validateOtp/$1';
$route['updatePassword/(:num)'] = 'SearchAdmin/updatePassword/$1';



$route['userRoleMasterList'] = 'Masters/getUserRoleDetails';
$route['userRoleMaster'] = 'Masters/userRoleMaster';
$route['userRoleMaster/(:num)'] = 'Masters/userRoleMaster/$1';
$route['userRoleMaster/status'] = 'Masters/userRoleChangeStatus';

//register user list
$route['registerUserMasterList'] = 'RegisterUser/getuserList';
$route['registerUserMaster'] = 'RegisterUser/user';
$route['registerUserMaster/(:num)'] = 'RegisterUser/user/$1';
$route['registerUserMaster/status'] = 'RegisterUser/userChangeStatus';
##### Account Master Start #####

$route['accGroupMasterList'] = 'AccountMasters/getAccGroupDetails';
$route['accGroupMaster'] = 'AccountMasters/accGroup';
$route['accGroupMaster/(:num)'] = 'AccountMasters/accGroup/$1';
$route['accGroupMaster/status'] = 'AccountMasters/accGroupChangeStatus';



$route['assessMasterList'] = 'ScheduleMaster/getAssessmentDetails';
$route['assessMaster'] = 'ScheduleMaster/assessment';
$route['assessMaster/(:num)'] = 'ScheduleMaster/assessment/$1';
$route['assessMaster/status'] = 'ScheduleMaster/assessmentStatus';
$route['trainingAssessFiles/(:num)'] = 'ScheduleMaster/trainingAssessFiles/$1';
$route['trainingAssessFileUpload/(:num)/(:num)'] = 'ScheduleMaster/trainingAssessUpload/$1/$2';
$route['training/assess/(:num)'] = 'ScheduleMaster/assessmentChangeStatus/$1';

##### Schedule Master ends #####



$route['infoSettingsList'] = 'InfoSetting/index';
$route['infoSettingsList/(:num)'] = 'InfoSetting/index/$1';

##### Import Exployee Details End #####

$route['infoSettingsList'] = 'InfoSetting/index';
$route['infoSettingsList/(:num)'] = 'InfoSetting/index/$1';


///email Master
$route['emailMasterList'] = 'EmailMaster/getEmailDetailsList';
$route['emailMaster'] = 'EmailMaster/emailMasterData';
$route['emailMaster/(:num)'] = 'EmailMaster/emailMasterData/$1';
$route['emailMaster/status'] = 'EmailMaster/emailMasterDataChangeStatus';


///emailmaster end


$route['categoryMasterList'] = 'CategoryMaster/getcategoryList';
$route['categoryMaster'] = 'CategoryMaster/category';
$route['categoryMaster/(:num)'] = 'CategoryMaster/category/$1';
$route['categoryMaster/status'] = 'CategoryMaster/categoryChangeStatus';

//state master
$route['stateMasterList'] = 'StateMaster/getstateList';
$route['stateMaster'] = 'StateMaster/state';
$route['stateMaster/(:num)'] = 'StateMaster/state/$1';
$route['stateMaster/status'] = 'StateMaster/stateChangeStatus';

//city master
$route['cityMasterList'] = 'CityMaster/getcityList';
$route['cityMaster'] = 'CityMaster/city';
$route['cityMaster/(:num)'] = 'CityMasterMaster/city/$1';
$route['cityMaster/status'] = 'CityMaster/cityChangeStatus';

//college master
$route['collegeMasterList'] = 'CollegeMaster/getcollegeList';
$route['collegeMaster'] = 'CollegeMaster/college';
$route['collegeMaster/(:num)'] = 'CollegeMasterMaster/college/$1';
$route['collegeMaster/status'] = 'CollegeMaster/collegeChangeStatus';

///
///// Blogs Route
$route['blogsList'] = 'Blogs/getBlogsList';
$route['blogs'] = 'Blogs/blogs';
$route['blogs/(:num)'] = 'Blogs/blogs/$1';
$route['blogs/status'] = 'Blogs/blogsChangeStatus';
///blogs Routes

///FAQ Route

$route['faqMasterList'] = 'FaqMaster/getFaqDetailsList';
$route['faqMaster'] = 'FaqMaster/faqMasterData';
$route['faqMaster/(:num)'] = 'FaqMaster/faqMasterData/$1';
$route['faqMaster/status'] = 'FaqMaster/faqMasterDataChangeStatus';

$route['contactUsList'] = 'ContactUs/contactUsList';
$route['contactUs'] = 'ContactUs/contactUs';
$route['contactUs/(:num)'] = 'ContactUs/contactUs/$1';
$route['contactUs/status'] = 'ContactUs/contactUsChangeStatus';

$route['readSeverFiles'] = 'ReadFoldersAndFiles/readFoldersAndFiles';
$route['addFilesInFolder'] = 'ReadFoldersAndFiles/addFilesInFolder';
$route['addFilesInFolder2/(:any)'] = 'ReadFoldersAndFiles/addFilesInFolder2/$1';
$route['addDIR'] = 'ReadFoldersAndFiles/addDIR';

$route['ourclientsList'] = 'Ourclients/index';
$route['ourclientssave'] = 'Ourclients/save';
$route['ourclientssave/(:num)'] = 'Ourclients/save/$1';
$route['ourclientssave/status'] = 'Ourclients/save';


///////////Student Portal 
$route['trlLevelMasterList'] = 'TrlMaster/trlLevelMasterList';
$route['trlLevelMaster'] = 'TrlMaster/trlLevelMaster';
$route['trlLevelMaster/(:num)'] = 'TrlMaster/trlLevelMaster/$1';
$route['trlLevelMaster/status'] = 'TrlMaster/trlLevelMasterChangeStatus';


$route['trlQuestions'] = 'TrlMaster/addTrlQuestions';
$route['trlQuestions/(:num)'] = 'TrlMaster/addTrlQuestions/$1';
$route['trlQuestionsList'] = 'TrlMaster/trlQuestionsList';
$route['deleteTRLQuestion'] = 'TrlMaster/deleteTRLQuestion';

$route['helpfulResourcesList'] = 'HelpfulResources/getResourceDetailsList';
$route['helpfulResources'] = 'HelpfulResources/helpfulResourcesData';
$route['helpfulResources/(:num)'] = 'HelpfulResources/helpfulResourcesData/$1';
$route['helpfulResources/status'] = 'HelpfulResources/helpfulResourcesDataChangeStatus';
$route['helpfulImages'] = 'HelpfulResources/uploadImage';


$route['translate_uri_dashes'] = FALSE;
$route['404_override'] = '';

