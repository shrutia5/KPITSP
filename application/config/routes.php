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
$route['default_controller'] = 'Home';

########### Website Routes ###########
$route['test'] = 'website/Website';
$route['news'] = 'website/News';
$route['single/(:any)'] = 'website/News/single/$1';
$route['blogs'] = 'website/Blogs/index';
$route['blog/(:any)'] = 'website/Blogs/single/$1';
$route['i-innovate'] = 'website/OurPlatforms/index';
$route['about-us'] = 'website/Website/aboutUs';
$route['helpful-resources'] = 'website/Helpful/index';
$route['contactUs'] = 'website/Website/contactUs';
$route['faq'] = 'website/Faq/index';

////contact us form saving
$route['contactUsForm'] = 'website/Website/contactUsForm';

// student portal links
$route['register'] = 'student/Register/register';
$route['checkDuplicate'] = 'student/Register/checkDuplicate';
$route['login'] = 'student/Register/login';
$route['logout'] = 'student/Register/logout';
$route['forgot-password'] = 'student/Register/forgotPassword';
$route['resetPasswordRequest'] = 'student/Register/resetPasswordRequest';
$route['updatePasswordForm/(:any)'] = 'student/Register/updatePasswordForm/$1';
$route['updatePassword'] = 'student/Register/updatePassword';
$route['verify'] = 'student/Register/Verify';
$route['student/resendOtp'] = 'student/Register/resendOTP';
$route['verifyuser'] = 'student/Register/checkOTP';
$route['reset-password'] = 'student/Register/resetPassword';
$route['getcontactno'] = 'student/Register/getcontactno';
$route['getCityList'] = 'student/Register/getCityList';
$route['getCollegelist'] = 'student/Register/getCollegelist';


$route['student/getCity'] = 'student/Myaccount/getCity';

$route['student/register'] = 'student/Register/registerUser';
$route['student/dashboard'] = 'student/Dashboard/index';
$route['student/final'] = 'student/Dashboard/finalIdea';
$route['student/submit-idea'] = 'student/Idea/index';
$route['student/verifyuser'] = 'student/Register/verifyuser';
$route['student/project'] = 'student/Idea/projectDetails';
$route['student/addMemberDetails'] = 'student/Idea/addMemberDetails';
$route['student/myaccount'] = 'student/Myaccount/index';
$route['student/getCollege'] = 'student/Myaccount/getCollege';
$route['student/getSubCate'] = 'student/Idea/getSubCategory';
$route['student/saveProject'] = 'student/Idea/saveProject';
$route['student/saveideaProject'] = 'student/Idea/saveUserIdea';
$route['student/saveideafiles'] = 'student/Idea/saveideafiles';
$route['student/removeTlFiles'] = 'student/Idea/removeIdeaFiles';
$route['student/removeicard'] = 'student/Register/removeicard';
$route['student/removeMember'] = 'student/Idea/removeMember';
$route['student/project-details/(:any)'] = 'student/Idea/memberProjectDetails/$1';
$route['student/savePrototypeDetails'] = 'student/Idea/savePrototypeDetails';
$route['student/removeAttFiles'] = 'student/Idea/removeIdeaAttFiles';
$route['student/getideafile'] = 'student/Idea/getIdeaFile';
$route['student/shareWithIncubation'] = 'student/Idea/shareWithIncubation';
$route['project/approveProject'] = 'admin/Project/approveProject';
$route['project/rejectProject'] = 'admin/Project/rejectProject';
$route['project/holdProject'] = 'admin/Project/holdProject';
$route['project/phase2approveProject'] = 'admin/Project/phase2approveProject';
$route['project/phase2rejectProject'] = 'admin/Project/phase2rejectProject';
$route['project/phase2holdProject'] = 'admin/Project/phase2holdProject';
$route['project/fiftyProject'] = 'admin/Project/fiftyProject';
$route['project/bottomfiftyProject'] = 'admin/Project/bottomfiftyProject';
$route['project/twohunProject'] = 'admin/Project/twohunProject';
$route['student/getSubcategory'] = 'student/Idea/getSubcategoryList';


$route['updateEducationalProfile'] = 'student/Myaccount/updateEducationalProfile';
$route['updateReferenceProfile'] = 'student/Myaccount/updateReferenceProfile';
$route['updateResourcesProfile'] = 'student/Myaccount/updateResourcesProfile';
$route['SetprofilePic'] = 'student/Myaccount/SetprofilePic';

$route['dashboard/(:num)'] = 'Dashboard';
//$route['student/myaccount'] = 'student/Myaccount/updateProfile';

$route['admin/dashboard'] = 'admin/Dashboard/index';
$route['admin/project-detail/(:any)'] = 'admin/Project/projectDetails/$1';
//$route['admin/project-detail'] = 'admin/Project/index';

//Evaluator 
$route['evaluator/dashboard'] = 'evaluator/Dashboard/index';
$route['evaluator/help'] = 'evaluator/Dashboard/help';
$route['evaluator/summary'] = 'evaluator/Dashboard/summary';
$route['evaluator/login'] = 'evaluator/Dashboard/login';
$route['evaluator/inbox'] = 'evaluator/Dashboard/inbox';
$route['evaluator/resetpassword'] = 'evaluator/Dashboard/resetpassword';
$route['evaluator/updatePassword']='evaluator/Dashboard/updatePassword';
$route['evaluator/project-details/(:any)'] = 'evaluator/Dashboard/projectdetails/$1';
$route['evaluator/select-project'] = 'evaluator/Dashboard/selectproject/';
$route['evaluator/save-project'] = 'evaluator/Dashboard/saveprojectevaluation';

//incubator
$route['incubator/dashboard'] = 'incubator/Dashboard/index';
$route['incubator/sparkle2020'] = 'incubator/Dashboard/sparkle2020';
$route['incubator/sparkle2019'] = 'incubator/Dashboard/sparkle2019';
$route['incubator/login'] = 'incubator/Dashboard/login';
$route['incubator/project-details/(:any)'] = 'incubator/Dashboard/projectdetails/$1';
$route['incubateAction'] = 'incubator/Dashboard/incubateAction';
$route['incubateStatus'] = 'incubator/Dashboard/incubateStatus';
$route['incubator/resetpassword'] = 'incubator/Dashboard/resetpassword';
$route['incubate/UpdatePassword'] = 'incubator/Dashboard/updatePassword';

//mentor
$route['mentor/dashboard'] = 'mentor/Dashboard/index';
$route['mentor/projectDetails/(:any)'] = 'mentor/Dashboard/projectdetails/$1';
$route['mentor/resetpassword'] = 'mentor/Dashboard/resetpassword';
$route['mentor/updatepassword'] = 'mentor/Dashboard/updatePassword';
//jury
$route['jury/dashboard'] = 'jury/Dashboard/index';
$route['jury/resetpassword'] = 'jury/Dashboard/resetpassword';
$route['jury/updatePassword'] = 'jury/Dashboard/updatePassword';
$route['jury/projectDetail/(:any)'] = 'jury/Dashboard/projectDetails/$1';
$route['jury/allList'] = 'jury/Dashboard/juryAllList';
$route['jury/top10List'] = 'jury/Dashboard/jurytop10List';
$route['jury/selectTop10'] = 'jury/Dashboard/selectInTop10';
//jury
$route['jury/dashboard2'] = 'jury/dashboard2/index';

// message route
$route['messageSend'] = 'Messages/send';
$route['messages/(:any)/(:any)'] = 'Messages/index/$1/$2';
$route['messages/(:any)'] = 'Messages/index/$1';
$route['readmessages/(:any)/(:any)'] = 'Messages/read/$1/$2';
$route['readmessages/(:any)'] = 'Messages/read/$1';
$route['student/message'] = 'student/Dashboard/messagedata';

########### student Routes ########### 


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
