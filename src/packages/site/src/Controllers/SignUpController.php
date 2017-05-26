<?php

	namespace Soup\Mobile\Controllers;

	use Soup\Mobile\Controllers\BaseController;
	use Soup\Mobile\Models\SoupUser;
	use Soup\Mobile\Models\UserProfile;
	use Soup\Mobile\Models\PasswordReset;
	use Soup\Mobile\Lib\AppGlobals;
	use Soup\Mobile\Jobs\SendEmailJob;
	
	use View;
	use Redirect;
	use Illuminate\Support\Facades\Auth;
	
	use Carbon\Carbon;

	class SignUpController extends BaseController {
		

		//public function __construct() {
			

		//} //end constructor()
		
		

		
		public function getIndex() {
			
			//get page data
			//$pageData = $this->dataForFormId(self::FORM_WELCOME);
			$pageData = $this->dataForPage(self::FORM_WELCOME);
			
			//draw page
			return View::make('soup::pages.home')->with([
				'pageName' => 'welcome',
				'pageData' => $pageData,
				'nextURL' => route('soup.login'),
				'nextLabel' => 'LOG IN',
				'headerStyle' => AppGlobals::HEADER_STYLE_WHITE,
				'fillHeight' => false
			]);
			
		} //end getIndex()
	
	
	
	
		//==========================================================//
		//====						LOG IN						====//
		//==========================================================//	
	
	
	
		public function getLogin() {
			
			//get page data
			$pageData = $this->dataForPage(self::FORM_LOGIN);
			
			//draw page
			return View::make('soup::pages.signup.login')->with([
				'pageName' => 'login',
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
					
						//check if quiz answered
						if (!$user->quiz_complete) {
					
							//get quiz data
							$quizData = $this->dataForFormId(self::FORM_QUESTION);
							
							//determine total questions
							$totalQuestions = ($quizData ? count($quizData) : 0);
							
							//get current question id
							$questionId = activeQuestionNumber($user, $quizData);
						
							//no questions answered
							if ($questionId<=0) {
						
								//direct to next page
								return Redirect::route('soup.quiz');
							
							}
							//more questions to answer
							else if ($questionId<$totalQuestions)  {
								
								//direct to next page
								return Redirect::route('soup.question.id', ['questionId' => $questionId]);
								
							}
							//all questions answered
							else {

								//get id of last question
								$lastQuestion = $totalQuestions - 1;
								if ($lastQuestion<0) $lastQuestion = 0;
							
								//direct to last question
								return Redirect::route('soup.question.id', ['questionId' => $lastQuestion]);
								
							}
						
						}
						//all questions answered
						else {
							
							//direct to next page
							return Redirect::route('soup.venue.recommendation');
							
						}
					
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
			
			
		} //end postLogin()
		
		
		
		public function getLogout() {
			
			//logout user
			Auth::guard(AppGlobals::$AUTH_GUARD)->logout();
			
			//draw page
			return Redirect::route('soup.welcome');
			
		} //end getLogout()
	
	
	
	
		//==========================================================//
		//====					UPDATE PASSWORD					====//
		//==========================================================//	
	
	
		public function getForgot() {
			
			//get page data
			$pageData = $this->dataForPage(self::FORM_FORGOT_PASSWORD);
			//$pageData = $this->dataForFormId(self::FORM_FORGOT_PASSWORD);
			
			//draw page
			return View::make('soup::pages.signup.forgot')->with([
				'pageName' => 'forgotten password',
				'pageData'=> $pageData,
				//'nextURL' => route('soup.question'),
				'backURL' => route('soup.login'),
				'hideHeaderTitle' => true
			]);
			
		} //end getForgot()
	
	
	
	
		public function postForgot() {
			
			$valid = true;
			$errors = null;
			
			//get form values
			$email = safeArrayValue('email', $_POST);
			
	
			//valid email
			if (!validEmail($email)) {
				$errors = 'Please specify a valid email address.';
				$valid = false;
			}
		
		
			//find matching user
			$user = SoupUser::where('email', '=', $email)->first();
	
			//valid user
			if ($valid && !$user) {
				$errors = 'Sorry, we can not find a user registered with that email address.';
				$valid = false;
			}
	
	
	
			//valid form
			if ($valid) {
				
				//create reset request
				$resetRequest = new PasswordReset();
				$resetRequest->user = $user->id;
				$resetRequest->code = generateUniqueCode("pr" . $user->id);
				$resetRequest->save();
				
				//create reset password link
				$link = route('soup.password.reset.id', ['code' => $resetRequest->code]);
				
				//send password reset email (sent via queue to avoid delay loading next page)
				$emailJob = new SendEmailJob([
					"recipient" => $user->email, 
					"sender" => AppGlobals::EMAIL_PASSWORD_RESET_SENDER,
					"subject" => AppGlobals::EMAIL_PASSWORD_RESET_SUBJECT,
					"view" => "soup::email.password_reset",
					"view_properties" => [
							"user" => $user,
							"link" => $link
					]
				]);
				$this->dispatch($emailJob);


				//direct to next page
				return Redirect::route('soup.forgot.sent');
				
			}
			
			
			//invalid form
			if (!$valid) {
				return Redirect::back()
							->withInput()
							->withErrors($errors);
			}

			
		} //end postForgot()
	
	
	
		public function getResetSent() {
			
			//get page data
			$pageData = $this->dataForPage(self::FORM_FORGOT_PASSWORD_THANKS);
			//$pageData = $this->dataForFormId(self::FORM_FORGOT_PASSWORD_THANKS);
			
			//draw page
			return View::make('soup::pages.signup.forgot_sent')->with([
				'pageName' => 'requested new password',
				'pageData'=> $pageData,
				//'nextURL' => route('soup.question'),
				//'backURL' => route('soup.login'),
				//'backURL' => route('soup.password.reset', ['code'=>'']),
				'hideHeaderTitle' => true
			]);
			
		} //end getResetSent()
	
	
	
		public function getChangePassword($code) {
			
			//find matching request
			$resetRequest = PasswordReset::where('code', $code)->first();
			if ($resetRequest && isset($resetRequest->user)) {
			
				//get request user
				$user = $resetRequest->user()->first();
				if ($user) {

					//get page data
					$pageData = $this->dataForPage(self::FORM_RESET_PASSWORD);
					
					//draw page
					return View::make('soup::pages.signup.reset')->with([
						'pageName' => 'new password',
						'pageData'=> $pageData,
						'request' => $resetRequest,
						//'user' => $user,
						'formURL' => route('soup.password.reset'),
						//'backURL' => route('soup.login'),
						'hideHeaderTitle' => true
					]);
				
				} //end if (found user)
			
			} //end if (valid request)
			
			
			//invalid request
			return Redirect::route('soup.welcome');
			
		} //end getChangePassword()
	
	
	
	
		public function postChangePassword() {
			
			$valid = true;
			$errors = null;
			
			//get form values
			$code = safeArrayValue('code', $_POST);
			$password = safeArrayValue('password', $_POST);
			$confirmPassword = safeArrayValue('confirm_password', $_POST);
			
			//find matching request
			$resetRequest = PasswordReset::where('code', $code)->first();
	
			//find matching user
			$user = $resetRequest->user()->first();
	
			//invalid request
			if (!$resetRequest || $resetRequest->status!=AppGlobals::RESET_PASSWORD_STATUS_ISSUED) {
				$errors = 'Sorry, it looks like your request is no longer valid. Please issue a new password reset request.';
				$valid = false;
			}
			
			//invalid user
			if (!$user) {
				$errors = 'Sorry, there seems to be an error with your user account.';
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
		
		
			//valid form
			if ($valid) {
				
				//encrypt password
				$cryptedPassword = bcrypt($password);
				
				//update user details
				$user->password = $cryptedPassword;
				$user->save();
				
				//update request details
				$resetRequest->status = AppGlobals::RESET_PASSWORD_STATUS_CONSUMED;
				$resetRequest->save();
				
				//redirect to confirmation page
				return Redirect::route('soup.password.reset.thanks', ['code' => $code]);
				
			}
			
			//invalid form
			else {
				return Redirect::back()
							->withInput()
							->withErrors($errors);	
			}
			
		} //end postChangePassword()
	
	
	
	
	
		public function getPasswordChanged($code) {
			
			//valid code
			if ($code && strlen($code)>0) {
			
				//find matching request
				$resetRequest = PasswordReset::where('code', $code)->first();
				if ($resetRequest) {
				
					//find matching user
					$user = $resetRequest->user()->first();
					if ($user) {

						//get page data
						$pageData = $this->dataForPage(self::FORM_RESET_PASSWORD_THANKS);
						
						//draw page
						return View::make('soup::pages.signup.reset_confirm')->with([
							'pageName' => 'password changed',
							'pageData'=> $pageData,
							'user' => $user,
							//'nextURL' => route('soup.question'),
							//'backURL' => route('soup.login'),
							'hideHeaderTitle' => true
						]);
					
					} //end if (valid user)
				
				} //end if (valid request)
				
			} //end if (has code)
			
			//invalid request
			return Redirect::route('soup.welcome');
			
		} //end getPasswordChanged()
		
		
	
	
		//==========================================================//
		//====						SIGN UP						====//
		//==========================================================//	
		
	
	
		public function getSignup() {
			
			//get page data
			$pageData = $this->dataForPage(self::FORM_SIGNUP);
			//$pageData = $this->dataForFormId(self::FORM_SIGNUP);
			
			//draw page
			return View::make('soup::pages.signup.signup')->with([
				'pageName' => 'new signup',
				'pageData'=> $pageData,
				//'nextURL' => route('soup.question'),
				'backURL' => route('soup.welcome'),
				'fillHeight' => false
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
				$user->verify_code = generateUniqueCode(null, 8);
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
			$pageData = $this->dataForPage(self::FORM_SIGNUP_DATA);
			//$pageData = $this->dataForFormId(self::FORM_SIGNUP_DATA);
			
			//find user
			$user = Auth::guard(AppGlobals::$AUTH_GUARD)->user();
			
			//user not yet signed up
			if ($user->status==AppGlobals::USER_STATUS_INQUIRY) {
			
				//draw page
				return View::make('soup::pages.signup.info')->with([
					'pageName' => 'signup details',
					'user' => $user,
					'pageData'=> $pageData,
					//'nextURL' => route('soup.question'),
					//'backURL' => route('soup.signup')
					'fillHeight' => false
				]);
			
			}
			//user already signed up
			else {
				return Redirect::route('soup.signup.code');
			}
			
		} //end getSignupData()
	
	
	
	
		public function postSignupData() {
			
			$valid = true;
			$errors = null;
			
			//get form values
			$firstName = safeArrayValue('first_name', $_POST);
			$lastName = safeArrayValue('last_name', $_POST);
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
			
			//first name exists
			else if (!$firstName || strlen(trim($firstName))<=0) {
				$errors = 'Please specify your first name.';
				$valid = false;
			}
			
			//last name exists
			else if (!$lastName || strlen(trim($lastName))<=0) {
				$errors = 'Please specify your last name.';
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
				$user->first_name = trim($firstName);
				$user->last_name = trim($lastName);
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
			$pageData = $this->dataForPage(self::FORM_SIGNUP_CODE);
			//$pageData = $this->dataForFormId(self::FORM_SIGNUP_CODE);
			
			//find user
			$user = Auth::guard(AppGlobals::$AUTH_GUARD)->user();
			
			//draw page
			return View::make('soup::pages.signup.code')->with([
				'pageName' => 'signup code',
				'pageData'=> $pageData,
				'user' => $user,
				//'nextURL' => route('soup.question'),
				'backURL' => route('soup.welcome'),
				'fillHeight' => false
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
			//else if (strcasecmp($code, 'AMS478')!=0) {
			else if (strcasecmp($code, $user->verify_code)!=0) {
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
			$pageData = $this->dataForPage(self::FORM_SIGNUP_REQUEST);
			//$pageData = $this->dataForFormId(self::FORM_SIGNUP_REQUEST);
			
			//draw page
			return View::make('soup::pages.signup.request')->with([
				'pageName' => 'request membership',
				'pageData'=> $pageData,
				//'nextURL' => route('soup.question'),
				'backURL' => route('soup.signup.code'),
				'fillHeight' => false
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
			
			//valid instagram
			else if (!$instagram || strlen($instagram)<1 || !preg_match('/^@?[a-zA-Z0-9._]+$/', $instagram)) {
				$errors = 'Please specify a vaild Instagram handle.';
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
				$user->instagram = strcmp($instagram[0], '@')==0 ? substr($instagram, 1) : $instagram;
				$user->snapchat = $snapchat;
				$user->zip_code = $zipCode;
				$user->status = AppGlobals::USER_STATUS_REQUESTED;
				$user->save();
			
				//send membership request email (sent via queue to avoid delay loading next page)
				$emailJob = new SendEmailJob([
					"recipient" => env('SYSTEM_EMAIL', AppGlobals::EMAIL_MEMBER_REQUEST_RECIPIENT), 
					"sender" => AppGlobals::EMAIL_MEMBER_REQUEST_SENDER,
					"subject" => AppGlobals::EMAIL_MEMBER_REQUEST_SUBJECT,
					"view" => "soup::email.request_membership",
					"view_properties" => [
							"user" => $user,
					]
				]);
				$this->dispatch($emailJob);
			
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
			$pageData = $this->dataForPage(self::FORM_SIGNUP_THANKS);
			//$pageData = $this->dataForFormId(self::FORM_SIGNUP_THANKS);
			
			//draw page
			return View::make('soup::pages.signup.thanks')->with([
				'pageName' => 'request membership thanks',
				'pageData'=> $pageData,
				//'nextURL' => route('soup.question'),
				'backURL' => route('soup.signup.code')
			]);
			
		} //end getSignupThanks()
	

	

	
								
	} //end class SignUpController


?>