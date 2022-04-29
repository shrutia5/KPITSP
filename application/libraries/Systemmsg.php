<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Systemmsg extends CI_Log
	{
		public function __construct(){
		
			parent::__construct();
			$this->CI = &get_instance();
		}

		public function getErrorCode($codeID){

			return $this->errorList($codeID);
		}
		public function getSucessCode($codeID){

			return $this->sucessList($codeID);
		}
		private function errorList($codeID)
		{
			$errorList  = array();
			//$errorList[200] = "Sucess";
			$errorList[210] = "Invalid User name or Password.";
			$errorList[211] = "Your account is inactive. Please contact to administrator.";
			$errorList[212] = "Your account not verify yet. Please check your email for verification link.";
			$errorList[218] = "{fieldName} required.";
			$errorList[219] = "{fieldName} : Please enter at least {minchar} characters.";
			$errorList[220] = "{fieldName} : You can enter Max {maxchar} characters.";
			$errorList[227] = "No records found.";
			$errorList[232] = "Oh no. you have reached the end of the search result.";
			$errorList[233] = "Admin apply on charges required.";
			$errorList[234] = "Error while processing company data. Please try again or contact development team";
			$errorList[235] = "Email cannot be sent.";
			$errorList[236] = "Email Not Send.";
			$errorList[237] = "Reset password fail, User not found.";
			$errorList[238] = "Please Enter Valid Email Address.";
			$errorList[239] = "Somthing Went Wrong. Try Again.";
			
			
			$errorList[993] = "Error while deleting records. Please contact to administrator.";
			$errorList[994] ="Token expired.Please login again.";
			$errorList[996] = "Error while deleting record(s).Please contact to administrator.";
			$errorList[997] = "Login required.Please login to access video.";
			$errorList[998] = "Error while saving details. Please contact to administrator.";
			$errorList[999] = "Unknown Error. Please contact to administrator.";

			
			return $errorList[$codeID]; 
		}

		private function sucessList($codeID)
		{
			$sucessList = array();
			$sucessList[400] = "Success";
			$sucessList[410] = "Valid User";
			$sucessList[411] = "Logout success";
			$sucessList[412] = "Valid Email";
			$sucessList[413] = "Valid user name";
			$sucessList[419] ="Thank you for connecting with us.Our support team will contact you.";
			$sucessList[420] ="Thank you for subscription .We will send news and updates to you.";
			$sucessList[421] ="Email has been sent successfully.";
			$sucessList[422] ="Registration completed successfully.";

		
			
			return $sucessList[$codeID]; 
		}
		public function SEODetails($page)
		{	
			
			$SEOList  = array();
			$SEOList["home"]['pageTitle']="KPIT Sparkle - Innovation Idea Submission & Incubation";
        	$SEOList["home"]['metaDescription']="Platform where you can share your idea for innovation and test your hypothesis. We connect budding technology entrepreneurs with the incubation ecosystem.";
        	$SEOList["home"]['metakeywords']="KPIT sparkle Student Dashboard";

			$SEOList["home"]['pageTitle']="KPIT Sparkle - Innovation Idea Submission & Incubation";
        	$SEOList["home"]['metaDescription']="Platform where you can share your idea for innovation and test your hypothesis. We connect budding technology entrepreneurs with the incubation ecosystem.";
        	$SEOList["home"]['metakeywords']="KPIT sparkle Student Dashboard";

			if(isset($page) || !empty($page)){
				return $SEOList["home"];
			}else{
				if(isset($SEOList[$page]) && !empty($SEOList[$page])){
					return $SEOList[$page];
				}else{
					return $SEOList["home"];
				}
			}
		}

		
	}
	