<?php

	namespace Soup\Mobile\Controllers;

	use Soup\Mobile\Lib\BaseController;
	
	use View;
	use Redirect;

	class SiteController extends BaseController {
		
/*
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
	*/	


		//public function __construct() {
			

		//} //end constructor()
		
		

		
		public function getIndex() {
			
			//get page data
			$pageData = $this->dataForFormId(self::FORM_WELCOME);
			
			//draw page
			return View::make('soup::pages.home')->with([
				'pageData' => $pageData,
				'nextURL' => route('soup.login'),
				'nextLabel' => safeArrayValue('secondary_button', $pageData, null),
				'alternateHeader' => true
			]);
			
		} //end getIndex()
	
	
	
	
		//==========================================================//
		//====						SIGN UP						====//
		//==========================================================//	
	
	
	
		public function getLogin() {
			
			//get page data
			$pageData = $this->dataForFormId(self::FORM_LOGIN);
			
			//draw page
			return View::make('soup::pages.signin.login')->with([
				'pageData'=> $pageData,
				'nextURL' => route('soup.question'),
				'backURL' => route('soup.welcome'),
				//'hideHeaderTitle' => true
			]);
			
		} //end getLogin()
	
	
	
		public function postLogin() {
			
			return Redirect::route('soup.quiz');
			
		} //end postLogin()
		
	
	
	
		public function getSignup() {
			
			//get page data
			$pageData = $this->dataForFormId(self::FORM_SIGNUP);
			
			//draw page
			return View::make('soup::pages.signin.signup')->with([
				'pageData'=> $pageData,
				//'nextURL' => route('soup.question'),
				'backURL' => route('soup.welcome')
			]);
			
		} //end getSignup()
			
	
		public function postSignup() {
			
			$valid = true;
			$errors = null;
			
			//get form values
			$email = safeArrayValue('email', $_POST);
			$password = safeArrayValue('password', $_POST);
			$confirmPassword = safeArrayValue('confirm_password', $_POST);
			
			
			//email exists
			if (!$email || strlen(trim($email))<=0) {
				$errors = 'Please specify an email address.';
				$valid = false;
			}
			
			//valid email
			else if (!validEmail($email)) {
				$errors = 'Please specify a valid email address.';
				$valid = false;
			}
			
			//password exists
			else if (!$password || strlen(trim($password))<=0) {
				$errors = 'Please specify a password.';
				$valid = false;
			}
			
			//invalid password length
			else if (strlen(trim($password))<5) {
				$errors = 'Passwords must be at least 5 characters.';
				$valid = false;
			}
			
			//confirm password exists
			else if (!$confirmPassword || strlen(trim($confirmPassword))<=0) {
				$errors = 'Please confirm your password.';
				$valid = false;
			}
			
			//passwords dont match
			else if (strcmp(trim($password), trim($confirmPassword))!=0) {
				$errors = 'Your passwords do not match.';
				$valid = false;
			}
			
			//check if email used already
//			$user = SoupUser::where('email', '=', $email)->where('email_verified', '=', true)->first();
//			if ($user) {
//				$errors = 'Sorry, looks like you\'ve already registered with that email';
//				$valid = false;
//			}
			
			
			
			//valid form
			if ($valid) {
				
				//direct to next page
				return Redirect::route('soup.signup.info');
				
			}
			//invalid form
			else {
				return Redirect::back()
							->withInput()
							->withErrors($errors);
			}
			
			
			
		} //end postSignup()
	
	
	
	
	
		public function getSignupData() {
			
			//get page data
			$pageData = $this->dataForFormId(self::FORM_SIGNUP_DATA);
			
			//draw page
			return View::make('soup::pages.signin.info')->with([
				'pageData'=> $pageData,
				//'nextURL' => route('soup.question'),
				'backURL' => route('soup.signup')
			]);
			
		} //end getSignupData()
	
	
		public function postSignupData() {
			
			$valid = true;
			$errors = null;
			
			//get form values
			$name = safeArrayValue('name', $_POST);
			$birthDate = safeArrayValue('birth_date', $_POST);
			$gender = safeArrayValue('gender', $_POST);
			
			
			//name exists
			if (!$name || strlen(trim($name))<=0) {
				$errors = 'Please specify your name.';
				$valid = false;
			}
			
			//valid birth date
			else if (!$birthDate || strlen($birthDate)<=0) {
				$errors = 'Please specify a valid birth date.';
				$valid = false;
			}
			
			//valid gender
			else if (!$gender || strlen($gender)<=0) {
				$errors = 'Please make a gender selection.';
				$valid = false;
			}
			
			
			//valid form
			if ($valid) {
			
				return Redirect::route('soup.signup.code');
			
			}
			//invalid form
			else {
				return Redirect::back()
							->withInput()
							->withErrors($errors);
			}
			
		} //end postSignupData()
	
	
	
	
	
		public function getSignupCode() {
			
			//get page data
			$pageData = $this->dataForFormId(self::FORM_SIGNUP_CODE);
			
			//draw page
			return View::make('soup::pages.signin.code')->with([
				'pageData'=> $pageData,
				//'nextURL' => route('soup.question'),
				'backURL' => route('soup.signup.info')
			]);
			
		} //end getSignupCode()
	
	
	
		public function postSignupCode() {
			
			return Redirect::route('soup.signup.thanks');
			
		} //end postSignupCode()
	
	
	
	
	
		public function getSignupThanks() {
			
			//get page data
			$pageData = $this->dataForFormId(self::FORM_SIGNUP_THANKS);
			
			//draw page
			return View::make('soup::pages.signin.thanks')->with([
				'pageData'=> $pageData,
				//'nextURL' => route('soup.question'),
				'backURL' => route('soup.signup.info')
			]);
			
		} //end getSignupThanks()
	

	
	
	
		//==========================================================//
		//====						QUIZ						====//
		//==========================================================//	
		
	
	
		public function getQuiz() {
			
			//get page data
			$pageData = $this->dataForFormId(self::FORM_QUIZ);
			
			//draw page
			return View::make('soup::pages.quiz.home')->with([
				'pageData'=> $pageData,
				'nextURL' => route('soup.question'),
				'backURL' => route('soup.welcome')
			]);
			
		} //end getQuiz()
		
		
	
	
		
		public function getQuestion() {
			
			$questionId = safeArrayValue('id', $_GET, 1);
			
			//get page data
			$pageData = $this->dataForFormId(self::FORM_QUESTION . $questionId);
			
			//get question type
			$questionType = safeArrayValue('type', $pageData, 0);
			$view = 'soup::pages.quiz.question';
			if ($questionType>0) {
				$view = 'soup::pages.quiz.multichoice';
			}
			
			//draw page
			return View::make($view)->with([
				'pageData'=> $pageData,
				'backURL' => route('soup.quiz')
			]);
			
		} //end getQuestion()
		
		
		
			
			
		//==========================================================//
		//====					SERVICE METHODS					====//
		//==========================================================//	
		
			/*
			
		public function getApplications() {
			
			
			//build query
			$query = CMSApp::select(['id', 'name'])->where('status', '=', 1);
			
			//get paginated results
			$results = $this->paginateRequestQuery($query, $_GET);
			
			//return paginated query
			return Response::json($results);
			
			
		} //end getApplications()
			
			
			
		public function postApplicationid($appID = null) {
			
			
		} //end postApplicationid()
		
		*/
		
			
			
			
		
		//==========================================================//
		//====					DATA METHODS					====//
		//==========================================================//	
		
		/*	
		private function dataForFormId($pageId) {
			
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
			*/
					
	} //end class SiteController


?>