<?php

	namespace Soup\Mobile\Controllers;

	use Soup\Mobile\Lib\BaseController;
	
	use View;
	use Redirect;

	class SiteController extends BaseController {
		

		//public function __construct() {
			

		//} //end constructor()
		
		

		
		public function getIndex() {
			
			//get page data
			$pageData = $this->dataForFormId(self::FORM_WELCOME);
			
			//draw page
			return View::make('soup::pages.home')->with([
				'pageData' => $pageData,
				'nextURL' => route('soup.login'),
				'nextLabel' => 'LOG IN',
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
			
		//==========================================================//
		//====					DATA METHODS					====//
		//==========================================================//	
							
	} //end class SiteController


?>