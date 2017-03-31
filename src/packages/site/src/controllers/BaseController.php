<?php

	namespace Soup\Mobile\Controllers;


	use Soup\Mobile\Models\Page;
	use Soup\Mobile\Models\Question;
	
	use App\Http\Controllers\Controller;

	class BaseController extends Controller {
		

		//page constants
		const FORM_DESKTOP = 'page_desktop';
		
		const FORM_WELCOME = 'page_welcome';
		const FORM_HOME = 'page_home';
		const FORM_LOGIN = 'page_login';
		const FORM_SIGNUP = 'page_signup';
		const FORM_SIGNUP_DATA = 'page_signup_data';
		const FORM_SIGNUP_CODE = 'page_signup_code';
		const FORM_SIGNUP_REQUEST = 'page_signup_request';
		const FORM_SIGNUP_THANKS = 'page_signup_thanks';
		const FORM_FORGOT_PASSWORD = 'page_forgot_password';
		const FORM_FORGOT_PASSWORD_THANKS = 'page_forgot_password_confirm';
		const FORM_RESET_PASSWORD = 'page_reset_password';
		const FORM_RESET_PASSWORD_THANKS = 'page_reset_password_confirm';
		
		const FORM_QUIZ = 'page_quiz';
		const FORM_QUESTION = 'page_question';
		const FORM_QUIZ_THANKS = 'page_quiz_thanks';
		
		const FORM_GUIDE = 'page_guide';
		const FORM_GUIDE_TIPPING = 'page_guide_tipping';
		
		const FORM_USER_PROFILE = 'page_user_profile';

		const FORM_VENUE_PROFILE = 'page_venue_profile';

		const FORM_RESERVATION = 'page_reservation';
		const FORM_RESERVATION_CONFIRM = 'page_reservation_confirm';
		const FORM_RESERVATION_THANKS = 'page_reservation_thanks';
		const FORM_RESERVATION_REVIEW = 'page_reservation_review';

		//public function __construct() {
			

		//} //end constructor()
		
					
			
			
		
		//==========================================================//
		//====					DATA METHODS					====//
		//==========================================================//	
		
		
		protected function dataForPage($pageId) {
			
			$pageData = null;
			//echo "pageId: " . $pageId;
			//valid id
			if ($pageId && strlen($pageId)>0) {
				
				//find page and any children
				$pageData = Page::where('key', $pageId)->with('children')->first();
				if ($pageData) {
					$pageData = $pageData->toArray();
				}
				
			} //end if (valid id)
			
			return $pageData;
			
		} //end dataForPage()
		
		
		
		
		protected function questionsData() {
			
			//get questions data
			$questionsData = Question::where('status', 1)->orderBy('order')->get();
			if ($questionsData) {
				$questionsData = $questionsData->toArray();	
			}

			return $questionsData;
			
		} //end questionsData()
		
		
		
		protected function questionsCount() {
			
			return Question::where('status', 1)->count();
			
		} //end questionsCount()
		
		
		
		protected function questionGroupCount() {

			//select all groups (using count directly generates incorrect SQL)
			$groups = Question::where('status', 1)->groupBy('group')->get();
			
			return $groups ? count($groups) : 0;
			
		} //end questionGroupCount()
		
		
		
			
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
							"button" => "APPLY NOW",
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
						"signup" => Array (
							"button" => "APPLY NOW",
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background009.jpg",
						),
						"info" => Array (
							"title" => "QUALITY LOCAL PLACES WITH THE PERFECT VIBE.",
							"subtitle" => "We only work with local places that believe in quality and support their community.<br>\nThe Soup membership takes you to the places you have always wanted to try and brand new spots that might not be on your radar yet.",
							"button" => "APPLY NOW",
							"image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/misc/image005.jpg",
							"theme" => 1
						),
						"image" => Array (
							"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background010.jpg",
						),
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
						"button" => "NEXT",
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
						"button" => "FINISH APPLICATION",
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
						"button" => "SUBMIT",
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
				
				
				case self::FORM_FORGOT_PASSWORD:
				{
					$pageData = Array (
						//"title" => "Please enter your email address.",
						"subtitle" => "Enter your email.",
						"button" => "RESET PASSWORD",
					);
				}
				break;
				
				
				case self::FORM_FORGOT_PASSWORD_THANKS:
				{
					$pageData = Array (
						"subtitle" => "An email has been sent to your account.",
						"button" => "LOG IN",
					);
				}
				break;
				
				
				case self::FORM_RESET_PASSWORD:
				{
					$pageData = Array (
						"subtitle" => "Enter new password",
						"button" => "CONTINUE",
					);
				}
				break;
				
				
				case self::FORM_RESET_PASSWORD_THANKS:
				{
					$pageData = Array (
						"title" => "Password successfully changed.",
						"subtitle" => "The password for",
						"text" => "Has now been updated.",
						"button" => "LOG IN",
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
							"key" => "cuisine",
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
							"key" => "diet",
							"type" => 3,
							"question" => "Last but not least.<br>Are you?",
							"options" => "[\"PESCATARIAN\",\"VEGETARIAN\",\"VEGAN\"]",
							"settings" => "{\"choices\":-1}",
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
				
				case self::FORM_USER_PROFILE:
				{
					$pageData = Array (
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/backgrounds/background007.jpg"
					);
				}
				break;
				
				
				case self::FORM_VENUE_PROFILE:
				{
					$pageData = Array (
						"text" => "FEATURE",
						"button" => "MAKE A RESERVATION",
						"secondary_button" => "VISIT THEIR WEBSITE"
					);
				}
				break;
				
				
				case self::FORM_RESERVATION:
				{
					$pageData = Array (
						"title" => "MAKE A RESERVATION FOR",
						"button" => "CONFIRM"
					);
				}
				break;
				
				
				case self::FORM_RESERVATION_CONFIRM:
				{
					$pageData = Array (
						"title" => "CONFIRM YOUR REQUEST",
						'text' => "If you can't make your reservation please notify us via email 6 hours in advance to avoid a late cancellation penalty.",
						"button" => "CONFIRM",
						"secondary_button" => "CANCEL"
					);
				}
				break;
				
				
				case self::FORM_RESERVATION_THANKS:
				{
					$pageData = Array (
						"title" => "THANK YOU.",
						'subtitle' => "Your request has been sent and we will confirm within 24 hours.",
						'text' => "If you can't make your reservation please notify us via email 6 hours in advance to avoid a late cancellation penalty.",
						"button" => "HOME"
					);
				}
				break;
				
				
				case self::FORM_RESERVATION_REVIEW:
				{
					$pageData = Array (
						"title" => "PLEASE RATE YOUR EXPERIENCE",
						'subtitle' => "ANY COMMENTS OR SUGGESTIONS?",
						"button" => "SUBMIT"
					);
				}
				break;
				
				
			} //end switch()
			
			return $pageData;
			
		} //end dataForPageId()
			
					
	} //end class BaseController


?>