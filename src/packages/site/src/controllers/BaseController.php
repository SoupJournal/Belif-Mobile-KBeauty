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
		const FORM_QUIZ_THANKS = 'page_quiz_thanks';
		


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
							"key" => "meal1",
							"type" => 0,
							"question" => "If you could only eat one meal out again would it be:",
							"text" => "Swipe Right for Yay!<br>or left for Nope.",
							"options" => "BREAKFAST/ BRUNCH",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background-q001.jpg",
							"step" => 1,
							"theme"	=> 0,
							"order" => 0
						],
						[
							"key" => "meal2",
							"type" => 0,
							"question" => "If you could only eat one meal out again would it be:",
							"options" => "LUNCH",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background-q002.jpg",
							"step" => 1,
							"theme"	=> 0,
							"order" => 0
						],
						[
							"key" => "meal3",
							"type" => 0,
							"question" => "If you could only eat one meal out again would it be:",
							"options" => "DINNER",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background-q003.jpg",
							"step" => 1,
							"theme"	=> 0,
							"order" => 0
						],
						[
							"key" => "wake1",
							"type" => 0,
							"question" => "When you wake up you need...",
							"options" => "A SPECIALTY LATTE OR CAPPUCCINO",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background-q004.jpg",
							"step" => 2,
							"theme"	=> 0,
							"order" => 0
						],
						[
							"key" => "wake2",
							"type" => 0,
							"question" => "When you wake up you need...",
							"options" => "REGULAR CUP OF JOE",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background-q005.jpg",
							"step" => 2,
							"theme"	=> 0,
							"order" => 0
						],
						[
							"key" => "wake3",
							"type" => 0,
							"question" => "When you wake up you need...",
							"options" => "TEA",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background-q006.jpg",
							"step" => 2,
							"theme"	=> 0,
							"order" => 0
						],
						[
							"key" => "drink1",
							"type" => 0,
							"question" => "You're in a new city with friends and down for drinks. You find...",
							"options" => "COCKTAIL BAR",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background-q007.jpg",
							"step" => 3,
							"theme"	=> 0,
							"order" => 0
						],
						[
							"key" => "drink2",
							"type" => 0,
							"question" => "You're in a new city with friends and down for drinks. You find...",
							"options" => "DIVE BAR",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background-q008.jpg",
							"step" => 3,
							"theme"	=> 0,
							"order" => 0
						],
						[
							"key" => "drink3",
							"type" => 0,
							"question" => "You're in a new city with friends and down for drinks. You find...",
							"options" => "DA CLUB",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background-q009.jpg",
							"step" => 3,
							"theme"	=> 0,
							"order" => 0
						],
						[
							"key" => "location1",
							"type" => 0,
							"question" => "When eating out you're always...",
							"options" => "DOWNTOWN",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background-q010.jpg",
							"step" => 4,
							"theme"	=> 0,
							"order" => 0
						],
						[
							"key" => "location2",
							"type" => 0,
							"question" => "When eating out you're always...",
							"options" => "NORTH BROOKLYN",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background-q011.jpg",
							"step" => 4,
							"theme"	=> 0,
							"order" => 0
						],
						[
							"key" => "location3",
							"type" => 0,
							"question" => "When eating out you're always...",
							"options" => "SOUTH BROOKLYN",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background-q012.jpg",
							"step" => 4,
							"theme"	=> 0,
							"order" => 0
						],
						[
							"key" => "location4",
							"type" => 0,
							"question" => "When eating out you're always...",
							"options" => "UPTOWN",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background-q013.jpg",
							"step" => 4,
							"theme"	=> 0,
							"order" => 0
						],
						[
							"key" => "restaurant1",
							"type" => 0,
							"question" => "What are the key things you look for in a restaurant?",
							"options" => "POSITIVE USER REVIEWS",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background-q013.jpg",
							"step" => 5,
							"theme"	=> 0,
							"order" => 0
						],
						[
							"key" => "restaurant2",
							"type" => 0,
							"question" => "What are the key things you look for in a restaurant?",
							"options" => "EXPERIMENTAL MENU",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background-q013.jpg",
							"step" => 5,
							"theme"	=> 0,
							"order" => 0
						],
						[
							"key" => "restaurant3",
							"type" => 0,
							"question" => "What are the key things you look for in a restaurant?",
							"options" => "VIBE",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background-q013.jpg",
							"step" => 5,
							"theme"	=> 0,
							"order" => 0
						],
						[
							"key" => "restaurant4",
							"type" => 0,
							"question" => "What are the key things you look for in a restaurant?",
							"options" => "LOCATION",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background-q013.jpg",
							"step" => 5,
							"theme"	=> 0,
							"order" => 0
						],
						[
							"key" => "restaurant5",
							"type" => 0,
							"question" => "What are the key things you look for in a restaurant?",
							"options" => "PRICE",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background-q013.jpg",
							"step" => 5,
							"theme"	=> 0,
							"order" => 0
						],
						[
							"key" => "food1",
							"type" => 1,
							"question" => "If you could only have 1 type of cuisine for the rest of your life it would be:",
							"options" => "[\"CHOICE1\",\"CHOICE2\",\"CHOICE3\",\"CHOICE4\",\"CHOICE5\",\"CHOICE6\",\"CHOICE7\"]",
							"button" => "NEXT",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background-q014.jpg",
							"step" => 6,
							"theme"	=> 0,
							"order" => 0
						],
						[
							"key" => "favRestaurant",
							"type" => 2,
							"question" => "What's your favourite restaurant or cafe in NYC right now?",
							"options" => "RESTAURANT NAME",
							"button" => "NEXT",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background-q015.jpg",
							"step" => 7,
							"theme"	=> 0,
							"order" => 0
						],
						[
							"key" => "question4",
							"type" => 3,
							"question" => "Last but not least.<br>Are you?",
							"options" => "[\"PESCATARIAN\",\"VEGETARIAN\",\"VEGAN\"]",
							"settings" => "{\"choices\":1}",
							"text" => "Any Allergies?",
							"button" => "SUBMIT",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background-q016.jpg",
							"step" => 8,
							"theme"	=> 0,
							"order" => 0
						]
					);
				}
				break;
			
				
				case self::FORM_QUIZ_THANKS:
				{
					$pageData = Array (
						"title" => "You made it.<br>Thanks for answering",
						"subtitle" => "As a special treat and welcome to the club have a coffee on us at",
						"text" => "We've sent you an email with more details.",
						"button" => "NEXT",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background-q016.jpg",
						"theme"	=> 0
					);
				}
				break;
				
				/*
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