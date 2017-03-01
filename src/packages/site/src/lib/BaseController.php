<?php

	namespace Soup\Mobile\Lib;

	
	use App\Http\Controllers\Controller;

	class BaseController extends Controller {
		

		//page constants
		const FORM_WELCOME = 'page_home';
		const FORM_HOME = 'page_home';
		const FORM_LOGIN = 'page_login';
		const FORM_SIGNUP = 'page_signup';
		const FORM_SIGNUP_DATA = 'page_signup_data';
		const FORM_SIGNUP_CODE = 'page_signup_code';
		const FORM_SIGNUP_THANKS = 'page_signup_thanks';
		const FORM_QUIZ = 'page_quiz';
		const FORM_QUESTION_1 = 'page_question_1';
		const FORM_QUESTION_2 = 'page_question_2';
		const FORM_QUESTION = 'page_question_';
		


		//public function __construct() {
			

		//} //end constructor()
		
					
			
			
		
		//==========================================================//
		//====					DATA METHODS					====//
		//==========================================================//	
		
			
		protected function dataForFormId($pageId) {
			
			//retrieve data from database
			//$pageData = dataForForm($pageId);
			
			$pageData = null;
			switch($pageId) {
				
				case self::FORM_WELCOME:
				{
					$pageData = Array (
						"title" => "YOUR MEMBERSHIP TO BREAKFAST, LUNCH, DINNER AND DRINKS FROM YOUR FAVOURITE CAFES AND RESTAURANTS EVERY MONTH.",
						//"title" => "DISCOVER BETTER BREAKFASTS, LUNCH, DINNER AND DRINKS FROM YOUR NEW FAVOURITE CAFES, RESTAURANTS AND NIGHTLIFE EVERY MONTH.",
						//"subtitle" => "MOISTURIZING BOMB OR AQUA BOMB?",
						//"text" => "Take our quiz and claim a free sample",
						"button" => "SIGN UP",
						"secondary_button" => "LOG IN",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background001.jpg"
					);
				}
				break;
				
				
				case self::FORM_LOGIN:
				{
					$pageData = Array (
						"title" => "SOUP",
						"subtitle" => "LOG INTO YOUR ACCOUNT",
						"text" => "Forgot your password?",
						"button" => "LOG IN",
						"secondary_button" => "Log in with Facebook",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background001.jpg"
					);
				}
				break;
				
				
				case self::FORM_SIGNUP:
				{
					$pageData = Array (
						"title" => "A membership that rewards you with delicious meals for supporting your community.",
						"text" => "by signing up you agree with our terms and conditions",
						"button" => "APPLY NOW",
						"secondary_button" => "Log In",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background002.jpg"
					);
				}
				break;
				
				
				case self::FORM_SIGNUP_DATA:
				{
					$pageData = Array (
						"title" => "One more thing:",
						"text" => "by signing up you agree with our terms and conditions",
						"button" => "FINISH APPLICATION",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background003.jpg"
					);
				}
				break;
				
				
				case self::FORM_SIGNUP_CODE:
				{
					$pageData = Array (
						"title" => "WELCOME.",
						"subtitle" => "Soup membership is currently by invitation only.<br>\nEnter your code below to complete your membership now.",
						"text" => "or apply for membership below.",
						"subtext" => "by signing up you agree with our terms and conditions",
						"button" => "APPLY FOR MEMBERSHIP",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background004.jpg"
					);
				}
				break;
				
				
				case self::FORM_SIGNUP_THANKS:
				{
					$pageData = Array (
						"title" => "Thanks for your application",
						"subtitle" => "The soup team will review your request and get back to you shortly with an approximate wait time.",
						"text" => "We look forward to seeing you soon!",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background006.jpg"
					);
				}
				break;
				
				
				case self::FORM_QUIZ:
				{
					$pageData = Array (
						"title" => "A few questions to get to know you and match you with your new favourite cafes and restaurants.",
						"button" => "GET STARTED",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background008.jpg"
					);
				}
				break;
				
				
				case self::FORM_QUESTION_1:
				{
					$pageData = Array (
						"question" => "WHERE IS YOUR FAVOURITE PART OF TOWN TO GET #EEEATS?",
						"text" => "(Swipe Right or Left to answer)",
						"answer" => "SOUTH BROOKLYN",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background007.jpg",
						"theme"	=> 0
					);
				}
				break;
				
				
				case self::FORM_QUESTION_2:
				{
					$pageData = Array (
						"question" => "WHAT ARE YOUR TOP 3 VIBES FOR EATING OUT?",
						"answers" => Array (
							"CHILL",
							"HEALTH&WELLNESS",
							"PARTY",
							"CASUAL",
							"POPULAR",
							"CLASSY",
							"VEGETARIAN"
						),
						"choices" => 3,
						"type" => 1,
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background007.jpg"
					);
				}
				break;
				
				
			} //end switch()
			
			return $pageData;
			
		} //end dataForPageId()
			
					
	} //end class BaseController


?>