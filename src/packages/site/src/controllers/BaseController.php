<?php

	namespace Soup\Mobile\Controllers;

	
	use App\Http\Controllers\Controller;

	class BaseController extends Controller {
		

		//page constants
		const FORM_WELCOME = 'page_home';
		const FORM_HOME = 'page_home';
		const FORM_LOGIN = 'page_login';
		const FORM_SIGNUP = 'page_signup';
		const FORM_SIGNUP_DATA = 'page_signup_data';
		const FORM_SIGNUP_CODE = 'page_signup_code';
		const FORM_SIGNUP_REQUEST = 'page_signup_request';
		const FORM_SIGNUP_THANKS = 'page_signup_thanks';
		const FORM_QUIZ = 'page_quiz';
		//const FORM_QUESTION_1 = 'page_question_1';
		//const FORM_QUESTION_2 = 'page_question_2';
		const FORM_QUESTION = 'page_question';
		


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
						"welcome" => Array (
							"title" => "YOUR MEMBERSHIP TO BREAKFAST, LUNCH, DINNER AND DRINKS FROM YOUR FAVOURITE CAFES AND RESTAURANTS EVERY MONTH.",
							//"title" => "DISCOVER BETTER BREAKFASTS, LUNCH, DINNER AND DRINKS FROM YOUR NEW FAVOURITE CAFES, RESTAURANTS AND NIGHTLIFE EVERY MONTH.",
							//"subtitle" => "MOISTURIZING BOMB OR AQUA BOMB?",
							"button" => "SIGN UP",
							"secondary_button" => "LOG IN",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background001.jpg",
						),
						"guide" => Array (
							"title" => "HOW IT WORKS",
							"text" => "ACCESS TO MEALS + DRINKS FROM NYC'S BEST PLACES",
							"steps" => [
								[
								"text" => "Soup aims to band together lovers of food and eating out with friends.",
								"image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/misc/image001.jpg"	
								],
								[
								"text" => "We invite those who support their local community & thrive on quality experiences.",
								"image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/misc/image002.jpg"	
								],
								[
								"text" => "Members are matched with local venues for unique experiences each month.",
								"image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/misc/image003.jpg"	
								],
								[
								"text" => "Members share their experiences privately with Soup and with their friends.",
								"image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/misc/image004.jpg"	
								]
							]
						),
						"info" => Array (
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background009.jpg",
						),
						"info2" => Array (
							"title" => "QUALITY LOCAL PLACES WITH THE PERFECT VIBE.",
							"subtitle" => "We only work with local places that believe in quality and support their community.<br>\nThe Soup membership takes you to the places you have always wanted to try and brand new spots that might not be on your radar yet.",
							"button" => "APPLY NOW",
							"image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/misc/image005.jpg",
							"theme" => 1
						)
					);
				}
				break;
				
				
				case self::FORM_LOGIN:
				{
					$pageData = Array (
						"title" => "SOUP",
						"subtitle" => "Log into your Soup account:",
						"text" => "Forgot your password?",
						"button" => "LOG IN",
						"secondary_button" => "Log in with Facebook",
						//"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background001.jpg"
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
				
				
				case self::FORM_SIGNUP_REQUEST:
				{
					$pageData = Array (
						"title" => "Interested in becoming a member?",
						"subtitle" => "Submit your details and we'll be in touch.",
						"text" => "We look forward to seeing you soon!",
						"button" => "APPLY FOR MEMBERSHIP",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background005.jpg"
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
				
			
				case self::FORM_QUESTION:
				{
					$pageData = Array (
						[
							"key" => "question1",
							"type" => 0,
							"question" => "When eating out you're always...",
							//"text" => "(Swipe Right or Left to answer)",
							"options" => "DOWNTOWN",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background007.jpg",
							"theme"	=> 0,
							"order" => 0
						],
						[
							"key" => "question2",
							"type" => 0,
							"question" => "When eating out you're always...",
							"options" => "NORTH BROOKLYN",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background008.jpg",
							"theme"	=> 0,
							"order" => 0
						],
						[
							"key" => "question3",
							"type" => 0,
							"question" => "When eating out you're always...",
							"options" => "SOUTH BROOKLYN",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background007.jpg",
							"theme"	=> 0,
							"order" => 0
						],
						[
							"key" => "question4",
							"type" => 1,
							"question" => "WHAT ARE YOUR TOP 3 VIBES FOR EATING OUT?",
							"options" => "[\"CHILL\",\"HEALTH&WELLNESS\",\"PARTY\",\"CASUAL\",\"POPULAR\",\"CLASSY\",\"VEGETARIAN\"]",
							"settings" => "\"choices\":3",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background007.jpg",
							"theme"	=> 0,
							"order" => 0
						]
					);
				}
				break;
			
				/*
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
				*/
				
			} //end switch()
			
			return $pageData;
			
		} //end dataForPageId()
			
					
	} //end class BaseController


?>