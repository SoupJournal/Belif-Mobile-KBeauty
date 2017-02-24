<?php

	namespace Soup\Mobile\Controllers;

	//use Soup\CMS\Lib\BaseCMSController;
	
	use View;
	use Redirect;
	use App\Http\Controllers\Controller;

	class SiteController extends Controller {
		

		//page constants
		const FORM_WELCOME = 'page_home';
		const FORM_HOME = 'page_home';
		const FORM_LOGIN = 'page_login';
		const FORM_SIGNUP = 'page_signup';
		const FORM_SIGNUP_DATA = 'page_signup_data';
		const FORM_SIGNUP_CODE = 'page_signup_code';
		const FORM_QUIZ = 'page_quiz';
		const FORM_QUESTION_1 = 'page_question_1';
		const FORM_QUESTION_2 = 'page_question_2';
		const FORM_QUESTION = 'page_question_';
		


		//public function __construct() {
			

		//} //end constructor()
		
		

		
		public function getIndex() {
			
			//get page data
			$pageData = $this->dataForFormId(self::FORM_WELCOME);
			
			//draw page
			return View::make('soup::pages.home')->with([
				'pageData' => $pageData,
				'nextURL' => route('soup.login'),
				'nextLabel' => 'login',
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
				'hideHeaderTitle' => true
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
			
			return Redirect::route('soup.signup.info');
			
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
			
			return Redirect::route('soup.signup.code');
			
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
			
			return Redirect::route('soup.quiz');
			
		} //end postSignupCode()
	
	
	
	
	
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
		
			
		private function dataForFormId($pageId) {
			
			//retrieve data from database
			//$pageData = dataForForm($pageId);
			
			$pageData = null;
			switch($pageId) {
				
				case self::FORM_WELCOME:
				{
					$pageData = Array (
						"title" => "DISCOVER BETTER BREAKFASTS, LUNCH, DINNER AND DRINKS FROM YOUR NEW FAVOURITE CAFES, RESTAURANTS AND NIGHTLIFE EVERY MONTH.",
						//"subtitle" => "MOISTURIZING BOMB OR AQUA BOMB?",
						//"text" => "Take our quiz and claim a free sample",
						"button" => "SIGN UP",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-001.jpg"
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
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-001.jpg"
					);
				}
				break;
				
				
				case self::FORM_SIGNUP:
				{
					$pageData = Array (
						"text" => "by signing up you agree with our terms and conditions",
						"button" => "Sign in with Facebook",
						"secondary_button" => "Sign Up",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-001.jpg"
					);
				}
				break;
				
				
				case self::FORM_SIGNUP_DATA:
				{
					$pageData = Array (
						"title" => "ONE MORE THING:",
						"text" => "by signing up you agree with our terms and conditions",
						"button" => "JOIN THE CLUB",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-001.jpg"
					);
				}
				break;
				
				
				case self::FORM_SIGNUP_CODE:
				{
					$pageData = Array (
						"title" => "WELCOME!",
						"subtitle" => "Soup membership is currently by invitation only.<br>\nEnter your code below to complete your membership now.",
						"text" => "or apply for membership below.",
						"subtext" => "by signing up you agree with our terms and conditions",
						"button" => "APPLY FOR MEMBERSHIP",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-001.jpg"
					);
				}
				break;
				
				
				case self::FORM_QUIZ:
				{
					$pageData = Array (
						"title" => "A FEW QUESTIONS TO GET TO KNOW YOU AND MATCH YOU WITH YOUR NEW FAVOURITE CAFES AND RESTAURANTS",
						"button" => "GET STARTED",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-001.jpg"
					);
				}
				break;
				
				
				case self::FORM_QUESTION_1:
				{
					$pageData = Array (
						"question" => "WHERE IS YOUR FAVOURITE PART OF TOWN TO GET #EEEATS?",
						"text" => "(Swipe Right or Left to answer)",
						"answer" => "SOUTH BROOKLYN",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-003.jpg",
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
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-003.jpg"
					);
				}
				break;
				
				
			} //end switch()
			
			return $pageData;
			
		} //end dataForPageId()
			
					
	} //end class SiteController


?>