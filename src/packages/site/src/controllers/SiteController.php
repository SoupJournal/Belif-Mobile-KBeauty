<?php

	namespace Soup\Mobile\Controllers;

	use Soup\Mobile\Controllers\BaseController;
	use Soup\Mobile\Models\SoupUser;
	use Soup\Mobile\Models\UserProfile;
	use Soup\Mobile\Lib\AppGlobals;
	
	use View;
	use Redirect;
	use Illuminate\Support\Facades\Auth;
	
	use Carbon\Carbon;

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
			return View::make('soup::pages.signup.login')->with([
				'pageData'=> $pageData,
				//'nextURL' => route('soup.question'),
				'backURL' => route('soup.welcome'),
				'hideHeaderTitle' => true
			]);
			
		} //end getLogin()
	
	
	
		public function postLogin() {
			
			$valid = true;
			$errors = null;
			
			//get form values
			$email = safeArrayValue('email', $_POST);
			$password = safeArrayValue('password', $_POST);
			
	
			//valid email
			if (!validEmail($email)) {
				$errors = 'Please specify a valid email address.';
				$valid = false;
			}
			
			//password exists
			else if (!$password || strlen(trim($password))<=0) {
				$errors = 'Please specify a password.';
				$valid = false;
			}
	
	
			//valid form
			if ($valid) {
			
				//authorise user
				if (Auth::guard(AppGlobals::$AUTH_GUARD)->attempt(['email' => $email, 'password' => $password])) {
					
					//get user
					$user = Auth::guard(AppGlobals::$AUTH_GUARD)->user();
					
					//new sign up
					if (!$user || $user->status==AppGlobals::USER_STATUS_INQUIRY) {
						
						//direct to next page
						return Redirect::route('soup.signup.info');
							
					}
					//user has registered (but not yet a member)
					else if ($user->status==AppGlobals::USER_STATUS_REGISTERED || $user->status==AppGlobals::USER_STATUS_REQUESTED) {
						
						//direct to next page
						return Redirect::route('soup.signup.code');
							
					}
					//valid user
					else if ($user->status==AppGlobals::USER_STATUS_MEMBER) {
					
						//direct to next page
						return Redirect::route('soup.quiz');
					
					}
					//other user types
					else {
						$errors = 'Sorry, you do not have member status.';
						$valid = false;
					}
				
				}
				//unauthorised
				else {
					$errors = 'Your credentials appear invalid.';
					$valid = false;
				}
				
			}
			
			
			//invalid form
			if (!$valid) {
				return Redirect::back()
							->withInput()
							->withErrors($errors);
			}
			
			return Redirect::route('soup.quiz');
			
		} //end postLogin()
		
	
	
	
	
	
		public function getSignup() {
			
			//get page data
			$pageData = $this->dataForFormId(self::FORM_SIGNUP);
			
			//draw page
			return View::make('soup::pages.signup.signup')->with([
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
			$user = SoupUser::where('email', '=', $email)->first();
			if ($user) { // && $user->status!=AppGlobals::USER_STATUS_INQUIRY) {
				$errors = 'Sorry, looks like you\'ve already registered with that email';
				$valid = false;
			}
			
			
			
			//valid form
			if ($valid) {
				
				//encrypt password
				$cryptedPassword = bcrypt($password);
				
				//create user
				$user = new SoupUser();
				$user->email = $email;
				$user->password = $cryptedPassword;
				$user->status = AppGlobals::USER_STATUS_INQUIRY;
				$user->save();
				
				//authorise user
				if (Auth::guard(AppGlobals::$AUTH_GUARD)->attempt(['email' => $email, 'password' => $password])) {
					
					//direct to next page
					return Redirect::route('soup.signup.info');
				
				}
				//unable to authenticate
				else {
					$errors = 'Sorry, looks like we had a problem processing your user details';
					$valid = false;
				}
				
			}
			
			
			//invalid form
			if (!$valid) {
				return Redirect::back()
							->withInput()
							->withErrors($errors);
			}
			
			
			
		} //end postSignup()
	
	
	
	
	
		public function getSignupData() {
			
			//get page data
			$pageData = $this->dataForFormId(self::FORM_SIGNUP_DATA);
			
			//find user
			$user = Auth::guard(AppGlobals::$AUTH_GUARD)->user();
			
			//draw page
			return View::make('soup::pages.signup.info')->with([
				'user' => $user,
				'pageData'=> $pageData,
				//'nextURL' => route('soup.question'),
				//'backURL' => route('soup.signup')
			]);
			
		} //end getSignupData()
	
	
		public function postSignupData() {
			
			$valid = true;
			$errors = null;
			
			//get form values
			$name = safeArrayValue('first_name', $_POST);
			$birthDate = safeArrayValue('birth_date', $_POST);
			$gender = safeArrayValue('gender', $_POST);
			
			//find birth year
			$birthYear = $birthDate ? substr($birthDate, strrpos($birthDate, '/') + 1) : null;
			
			//convert date
			$date = null;
			try {
				$date = Carbon::createFromFormat('m/d/Y', $birthDate);
			}
			catch (\Exception $ex) {
				try {
					$date = Carbon::createFromFormat('m\\d\\Y', $birthDate);
				}
				catch (\Exception $ex) {
					try {
						$date = Carbon::createFromFormat('m-d-Y', $birthDate);
					}
					catch (\Exception $ex) {
						try {
								$date = Carbon::createFromFormat('Y-m-d', $birthDate);
						}
						catch (\Exception $ex) {
							try {
								$date = Carbon::createFromFormat('Y-d-m', $birthDate);
							}
							catch (\Exception $ex) {
								//echo "Exception: " . $ex;
								//exit(0);
							}
						}
					}
				}	
			}
			//echo "birthDate: " . $birthDate;
			//exit(0);
			
			//find user
			$user = Auth::guard(AppGlobals::$AUTH_GUARD)->user();
			
			//valid user
			if (!$user || !($user->status==AppGlobals::USER_STATUS_INQUIRY || $user->status==AppGlobals::USER_STATUS_REGISTERED)) {
				$errors = 'Sorry, missing or invalid user credentials. Please login or restart the signup proccess';
				$valid = false;
			}
			
			//name exists
			else if (!$name || strlen(trim($name))<=0) {
				$errors = 'Please specify your name.';
				$valid = false;
			}
			
			//birth date exists
			else if (!$birthDate || strlen($birthDate)<=0) {
				$errors = 'Please specify a valid birth date.';
				$valid = false;
			}
			//birth date exists
			else if (!$birthDate || strlen($birthDate)<=0) {
				$errors = 'Please specify a valid birth date.';
				$valid = false;
			}
			//valid year
			else if (!$birthYear || strlen(trim($birthYear))<4) {
				$errors = 'Please specify your birth year in full (4 digits).';
				$valid = false;
			}
			//valid birth date
			else if (!$date) {
				$errors = 'Please specify a valid birth date.';
				$valid = false;
			}
			//TODO: check date range (1900+)?

			
			//valid gender
			else if (!$gender || strlen($gender)<=0) {
				$errors = 'Please make a gender selection.';
				$valid = false;
			}
			
			
			//valid form
			if ($valid) {
				
				//update user details
				$user->first_name = trim($name);
				$user->birth_date = trim($date);
				$user->gender = trim($gender);
				$user->status = AppGlobals::USER_STATUS_REGISTERED;
				$user->save();
				
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
			return View::make('soup::pages.signup.code')->with([
				'pageData'=> $pageData,
				//'nextURL' => route('soup.question'),
				//'backURL' => route('soup.signup.info')
			]);
			
		} //end getSignupCode()
	
	
	
		public function postSignupCode() {
			
			$valid = true;
			$errors = null;
			
			//get form values
			$code = safeArrayValue('code', $_POST);
			
			//find user
			$user = Auth::guard(AppGlobals::$AUTH_GUARD)->user();
			
			//valid user
			if (!$user) {
				$errors = 'Sorry, missing or invalid user credentials. Please login or restart the signup proccess';
				$valid = false;
			}
			
			//code exist
			if (!$code || strlen(trim($code))<=0) {
				$errors = 'Please specify the registration code you received.';
				$valid = false;
			}
			//valid code
			else if (strcasecmp($code, 'AMS478')!=0) {
				$errors = 'Sorry, your registration code appears invalid.';
				$valid = false;
			}
			
			if ($valid) {
			
				//update user status
				$user->status = AppGlobals::USER_STATUS_MEMBER;
				$user->save();
			
				//redirect to main site
				return Redirect::route('soup.quiz');
				
			}
			
			//invalid form
			else {
				return Redirect::back()
							->withInput()
							->withErrors($errors);
			}
			
		} //end postSignupCode()
	
	
	
	
		public function getSignupRequest() {
			
			//get page data
			$pageData = $this->dataForFormId(self::FORM_SIGNUP_REQUEST);
			
			//draw page
			return View::make('soup::pages.signup.request')->with([
				'pageData'=> $pageData,
				//'nextURL' => route('soup.question'),
				'backURL' => route('soup.signup.code')
			]);
			
		} //end getSignupRequest()
	
	
	
		public function postSignupRequest() {
			
			$valid = true;
			$errors = null;
			
			//get form values
			$instagram = safeArrayValue('instagram', $_POST);
			$snapchat = safeArrayValue('snapchat', $_POST);
			$zipCode = safeArrayValue('zip_code', $_POST);
			
			//find user
			$user = Auth::guard(AppGlobals::$AUTH_GUARD)->user();
			
			//valid user
			if (!$user || !($user->status==AppGlobals::USER_STATUS_INQUIRY || $user->status==AppGlobals::USER_STATUS_REGISTERED || $user->status==AppGlobals::USER_STATUS_REQUESTED)) {
				$errors = 'Sorry, missing or invalid user credentials. Please login or restart the signup proccess';
				$valid = false;
			}
			//already requested
			else if ($user->status==AppGlobals::USER_STATUS_REQUESTED) {
				$errors = 'Your request has already been sent, please allow some time for us to process your request.';
				$valid = false;
			}
			//valid zip code
			else if (!$zipCode || strlen(trim($zipCode))<=0) {
				$errors = 'Please specify your zip code.';
				$valid = false;
			}
			else if (strlen(trim($zipCode))!=5 || intval($zipCode)<=0) {
				$errors = 'Please specify a vaild zip code.';
				$valid = false;
			}
			
			
			//valid form
			if ($valid) {
			
				//store user details
				$user->instagram = $instagram;
				$user->snapchat = $snapchat;
				$user->zip_code = $zipCode;
				$user->status = AppGlobals::USER_STATUS_REQUESTED;
				$user->save();
			
				//show thanks page
				return Redirect::route('soup.signup.thanks');
				
			}
			
			//invalid form
			else {
				return Redirect::back()
							->withInput()
							->withErrors($errors);
			}
			
		} //end postSignupRequest()
		
	
	
	
		public function getSignupThanks() {
			
			//get page data
			$pageData = $this->dataForFormId(self::FORM_SIGNUP_THANKS);
			
			//draw page
			return View::make('soup::pages.signup.thanks')->with([
				'pageData'=> $pageData,
				//'nextURL' => route('soup.question'),
				'backURL' => route('soup.signup.code')
			]);
			
		} //end getSignupThanks()
	

	

	
								
	} //end class SiteController


?>