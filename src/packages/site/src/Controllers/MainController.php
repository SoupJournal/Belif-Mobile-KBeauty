<?php


	namespace Belif\Mobile\Controllers;


	use Belif\Mobile\Controllers\BaseController;
	use Belif\Mobile\Models\User;

	use URL;
	use View;
	use Redirect;
	use Session;
	use Illuminate\Support\Facades\Auth;

	class MainController extends BaseController {
		

		//==========================================================//
		//====					PAGE METHODS					====//
		//==========================================================//	
		
		//catch all undefined request and route to home
		public function missingMethod($parameters = array()) {
			
			return Redirect::to('/');
			
		} //end missingMethod()
		
		
		
		
		public function getDesktop() {
			
			//non-mobile device
	    	if (!isMobileDevice()) {
			
				//get page data
				$pageData = $this->dataForFormId(self::FORM_DESKTOP);
				
				//get background image
				$backgroundImage = safeArrayValue('background_image', $pageData);
				
				//render view
				return View::make('belif::pages.desktop')->with(Array (
					'fullScreen' => true,
					'pageName' => 'home',
					'pageData' => $pageData,
					'backgroundImage' => $backgroundImage
				));
			
	    	} //end if (is desktop)
	    	
	    	//redirect for mobile requests
			return Redirect::action('ProductController@getIndex');
			
		} //end getDesktop()
		
		
		
		
//		public function getIndex() {
//		
//			//get page data
//			$pageData = parent::dataForFormId(self::FORM_HOME);
//			
//			//get background image
//			$backgroundImage = safeArrayValue('background_image', $pageData);
//			
//			//render view
//			return View::make('belif::pages.home')->with(Array (
//				'pageName' => 'home',
//				'pageData' => $pageData,
//				'backgroundImage' => $backgroundImage
//			));
//			
//		} //end getIndex()
	
	

		
		
		
		public function getEmail() {

			//get page data
			$pageData = $this->dataForPage(self::FORM_EMAIL);
			
			//get background image
			$backgroundImage = safeArrayValue('background_image', $pageData);

			//render view
			return View::make('belif::pages.email')->with(Array (
				'pageName' => 'email',
				'pageData' => $pageData,
				'backgroundImage' => $backgroundImage,
				//'backURL' => route('belif.home'),
				'formURL' => route('belif.email'),
				'unregisterURL' => '' //route('belif.unsubscribe')
			));
			
		} //end getEmail()
		
			
			
			
		public function postEmail() {
	
			$valid = true;
			$errors = null;
			
			//get form values
			$email = safeArrayValue('email', $_POST);
			$confirmEmail = safeArrayValue('confirm-email', $_POST);
			
			
			//email exists
			if (!$email || strlen(trim($email))<=0) {
				$errors = 'Please specify a email address.';
				$valid = false;
			}
			
			//valid email
			else if (!validEmail($email)) {
				$errors = 'Please specify a valid email address.';
				$valid = false;
			}
			
			
			
			//check if email used already
			$user = User::where('email', '=', $email)->where('email_verified', '=', true)->first();
			if ($user) {
				$errors = 'Sorry, looks like you\'ve already registered with that email';
				$valid = false;
			}
			
			
			
			//valid form
			if ($valid) {
				
				//store email
				Session::set('email', trim($email));
	
				//find existing user
				$user = User::where('email', $email)->first();
				
				//no user exists so create new user to store email
				if (!$user) {
					
					//create user
					$user = new User();
					$user->email = $email;
					$user->email_registration_attempts = 1;
					$user->save();
					
				}
				//user already exists
				else {
					$user->email_registration_attempts += 1;
					$user->save();
				}
	
	
				//clear any existing answers
				$this->clearAnswers();
	
				//check if product available
				$available = $this->productAvailable();
				if ($available) {
	
					//move to first question
					return Redirect::to('/guide');
				
				}
				else {
					
					//show unavailable
					return Redirect::to('/unavailable');
					
				}
				
			}
			//invalid form
			else {
				return Redirect::back()
							->withInput()
							->withErrors($errors);
			}
			
		} //end postEmail()
		
			
			
			
		public function getGuide() {

			//get page data
			$pageData = parent::dataForPage(self::FORM_GUIDE);
			
			//get background image
			$backgroundImage = safeArrayValue('background_image', $pageData);
		
			//render view
			return View::make('belif::pages.guide')->with(Array (
				'pageName' => 'guide',
				'pageData' => $pageData,
				'backgroundImage' => $backgroundImage,
				'buttonURL' => route('belif.question'),
				'backURL' => route('belif.home'),
			));
			
		} //end getGuide()
		
			
			
			
		
		public function getUnavailable() {
			//calculate product
			//$product = $this->getSelectedProduct();
			
			//check if product available
			$available = $this->productAvailable(); //$product);
			
			//available
			if ($available) {
				
				//show quiz
				return Redirect::to('/question');
				
			}
			//not available
			else {
			
				//get page data
				$pageData = $this->dataForFormId(self::FORM_NO_SAMPLES);
				
				//get background image
				$backgroundImage = safeArrayValue('background_image', $pageData);
				
				//render view
				return View::make('belif::pages.unavailable')->with(Array (
					'pageName' => 'unavailable',
					'pageData' => $pageData,
					'backgroundImage' => $backgroundImage,
					//'backURL' => URL::to('/email'),
				));
			
			}
			
		} //end getUnavailable()
		
		
			
			
			
		public function getAddress() {
			
			//calculate product
			//$product = $this->getSelectedProduct();
			
			//check if product available
			//$available = $this->productAvailable($product);
			
			
			//get page data
			$pageData = $this->dataForPage(self::FORM_ADDRESS);
			
			//get background image
			$backgroundImage = safeArrayValue('background_image', $pageData);
			
			//render view
			return View::make('belif::pages.address')->with(Array (
				'pageName' => 'address',
				'pageData' => $pageData,
				'states' => availableStates(),
				'backgroundImage' => $backgroundImage,
				'formURL' => route('belif.address'),
				'backURL' => route('belif.product')
			));
			
		} //end getAddress()
			
		
		
		
		public function postAddress() {
			
			//get user email 
			$email = Session::get('email');
		
			//valid email
			if ($email && strlen($email)>0 && validEmail($email)) {
			
				//get form values
				$name = safeArrayValue('name', $_POST, null);
				$address1 = safeArrayValue('address_1', $_POST, null);
				$address2 = safeArrayValue('address_2', $_POST, null);
				$city = safeArrayValue('city', $_POST, null);
				$stateId = safeArrayValue('state', $_POST, null);
				$zipCode = safeArrayValue('zip_code', $_POST, null);
			
				//trim strings
				$address1 = $address1 ? trim($address1) : null;
				$city = $city ? trim($city) : null;
				
				
			
				//calculate product
				$product = $this->getSelectedProducts();
				
				//get state
				$states = availableStates();
				$state = (is_numeric($stateId) && $stateId>=0 && $states && $stateId<count($states)) ? $states[$stateId] : null;
			
				//find ip address
				$ipAddress = retrieveIPAddress();
	
				//form validation
				$valid = true;
				//email exists
				if (!$name || strlen(trim($name))<=0) {
					$errors = 'Please specify your name.';
					$valid = false;
				}
				
				//valid address
				//if ($valid && (!$address1 || !$address2 || strlen(trim($address1))<=0 || strlen(trim($address2))<=0)) {
				if ($valid && (!$address1 || strlen(trim($address1))<=0)) {
					$errors = 'Please specify your full address.';
					$valid = false;
				}
				//valid city
				if ($valid && (!$city || strlen(trim($city))<=0)) {
					$errors = 'Please specify your city.';
					$valid = false;
				}
				
				//valid state
				if ($valid && (!$state || strlen(trim($state))<=0)) {
					$errors = 'Please specify your state.';
					$valid = false;
				}
				
				//valid zip code
				if ($valid && (!$zipCode || strlen(trim($zipCode))<=0)) {
					$errors = 'Please specify your zip code.';
					$valid = false;
				}
				else if ($valid && (strlen(trim($zipCode))!=5 || intval($zipCode)<=0)) {
					$errors = 'Please specify a vaild zip code.';
					$valid = false;
				}
				//check for existing addresses
				if ($valid) {
						
					//check for existing addresses
					$addressUsers = User::where('email_verified', '=', true)
							->where('state', '=', $state)
							->where('zip_code', '=', $zipCode)
							->where('city', 'like', $city)
							->where('address_1', 'like', $address1)
							->count();
				
					//address used too many times
					if ($addressUsers>=4) {
						$errors = 'This address has already claimed samples. Please use a valid address.';
						$valid = false;
					}
					
				}
				
				//valid form
				if ($valid) {
	
					//ensure user doesn't already exist
					$user = User::where('email', $email)->first();
					if ($user) {
						
						//user already verified
						if ($user->email_verified) {
							
							//TODO: show separate error page
						
							//show error
							$errors = 'Sorry, it looks like your email address has already been used to register';
							
							//indicate error
							return Redirect::back()
								->withInput()
								->withErrors($errors);
						
						}
						
					}
					//new user
					else {
						
						//create user
						$user = new User();
						
					}
					
					
					//valid user
					if ($user) {
					
						//update user details
						$user->name = $name;
						$user->email = $email;
						$user->address_1 = $address1;
						$user->address_2 = $address2;
						$user->city = $city;
						$user->state = $state;
						$user->zip_code = $zipCode;
						$user->ip_address = $ipAddress;
						$user->product_1 = $product;
						
						//save user details
						if (!$user->save()) {
							
							//show error
							$errors = 'Sorry, it looks like we had a problem processing your details';
							
							//indicate error
							return Redirect::back()
								->withInput()
								->withErrors($errors);
							
						}
						
						//saved details
						else {
							
							//send verification email
							$this->sendVerifyEmail($user);
								
						}
						
					}
	
					//show verify page
					return Redirect::route('belif.verify');
					
				}
				//invalid form
				else {
					return Redirect::back()
								->withInput()
								->withErrors($errors);
				}
			
			} //end if (valid question id)
			
			
			//no email specified
			return Redirect::route('belif.home');
			
			
		} //end postAddress()
		
				
			
			
		public function getVerify() {
			
			//get page data
			$pageData = $this->dataForPage(self::FORM_VERIFY);
			
			//get background image
			$backgroundImage = safeArrayValue('background_image', $pageData);
			
			//render view
			return View::make('belif::pages.verify')->with(Array (
				'pageName' => 'verify',
				'pageData' => $pageData,
				'backgroundImage' => $backgroundImage,
				'backURL' => route('belif.address'),
			));
			
		} //end getVerify()
		
		
		
		
		
		public function getReverify() {
			
			//get session email
			$email = Session::get('email');
			if ($email && strlen($email)>0) {
				
				//get user details
				$user = User::where('email', '=', $email)->first();
				$this->sendVerifyEmail($user);
			
			}
			
			
			//get page data
			$pageData = $this->dataForPage(self::FORM_VERIFY);
			
			//get background image
			$backgroundImage = safeArrayValue('background_image', $pageData);
			
			//render view
			return View::make('belif::pages.verify')->with(Array (
				'pageName' => 'reverify',
				'pageData' => $pageData,
				'backgroundImage' => $backgroundImage,
				'backURL' => route('belif.address'),
				'verifyEmail' => $user->email
			));
			
		} //end getReverify()
		
		
		
		
		
		public function getShare() {
			
			//get verification code
			$code = safeArrayValue('code', $_GET, null);
			
			//valid code
			if ($code && strlen($code)>0) { 
			
				//validate code
				$user = User::where('verify_code', '=', $code)->first();
				if ($user) {
					
					//store user
					Session::set('userId', $user->id);
					
				
					//user already shared
					if ($user->shared_email && strlen($user->shared_email)>0) {
						
						//ensure email is considered verified
						if (!$user->email_verified) {
							$user->email_verified = true;
							$user->save();
						}
						
						//jump to thanks page
						return Redirect::to('/thanks');
						
					}
					
					//verify code
					else {
				
						//indicate email is verified
						$user->email_verified = true;
						$user->save();
				
				
						//get page data
						$pageData = $this->dataForFormId(self::FORM_SHARE);
						
						//get background image
						$backgroundImage = safeArrayValue('background_image', $pageData);
						
						//render view
						return View::make('belif::pages.share')->with(Array (
							'pageName' => 'share',
							'pageData' => $pageData,
							'backgroundImage' => $backgroundImage,
							//'backURL' => URL::to('/address'),
						));
					
					}
				
				} //end if (valid code)
				
			} //end if (valid code)
			
			//invalid code - show home page
			return Redirect::to('/');
			
		} //end getShare()	
			
			
			
			
		public function postShare() {
			
			//get user id
			$userId = Session::get('userId');
			
			//validate user id
			$user = User::find($userId);
			if ($user) {
				
			
				$valid = true;
				$errors = null;
				
				//get form values
				$email = safeArrayValue('email', $_POST);
				
				
				//email exists
				if (!$email || strlen(trim($email))<=0) {
					$errors = 'Please specify a email address.';
					$valid = false;
				}
				
				//valid email
				else if (!validEmail($email)) {
					$errors = 'Please specify a valid email address.';
					$valid = false;
				}
				
				
				//valid form
				if ($valid) {
					
					//if user hasn't already sent share email
					if (!$user->shared_email || strlen($user->shared_email)==0) {
	
						//determine if email should be sent
						$sendMail = true;
	
						//check if shared email is already a user (avoid sending emails to unsubscribed users)
						$sharedUser = User::where('email', '=', $email)->first();
						if ($sharedUser) {
							
							//user has unsubscribed - do not send them an email
						 	if ($sharedUser->unsubscribed) {
								$sendMail = false;	
						 	}
						}
						//new user
						else {
							
							//create user
							$sharedUser = new User();
							$sharedUser->email = $email;
							$sharedUser->save();	
							
						}
	
						//send email
						if ($sendMail) {
							$this->sendShareEmail($user, $sharedUser);
						}
	
						//store friends email
						$user->shared_email = $email;
						$user->save();
					
					} //end if (new share)
					
	
					//show next page
					return Redirect::to('/thanks');
					
				}
				//invalid form
				else {
					return Redirect::back()
								->withInput()
								->withErrors($errors);
				}
			
			} //end if (valid user)
			
			
			//show home page
			return Redirect::to('/');
			
		} //end postShare()
		
		
		
		
		
		public function getThanks() {
			
			//get page data
			$pageData = $this->dataForFormId(self::FORM_THANKS);
			
			//get background image
			$backgroundImage = safeArrayValue('background_image', $pageData);
			
			//render view
			return View::make('belif::pages.thanks')->with(Array (
				'pageName' => 'thanks',
				'pageData' => $pageData,
				'backgroundImage' => $backgroundImage,
				//'backURL' => URL::to('/share'),
			));
			
		} //end getThanks()
		
			
			
			
			
		public function getUnsubscribe() {
			
			//get verification code
			$code = safeArrayValue('code', $_GET, null);
			
			//valid code
			if ($code && strlen($code)>0) { 
			
				//validate code
				$user = User::where('verify_code', '=', $code)->first();
				if ($user) {
			
					//update user
					$user->unsubscribed = true;
					$user->save();
					
			
					//get page data
					$pageData = $this->dataForFormId(self::FORM_UNSUBSCRIBE);
					
					//get background image
					$backgroundImage = safeArrayValue('background_image', $pageData);
					
					//render view
					return View::make('belif::pages.unsubscribe')->with(Array (
						'pageName' => 'unsubscribe',
						'pageData' => $pageData,
						'backgroundImage' => $backgroundImage,
					));
					
				} //end if (valid code)
				
			} //end if (valid code)
			
			//invalid code - show home page
			return Redirect::to('/');
			
			
		} //end getUnsubscribe()
		
		
		
			
					
		
		//==========================================================//
		//====					EMAIL METHODS					====//
		//==========================================================//
		
		
		private function generateVerifyCode($user) {
			
			//valid user
			if ($user) {
				
				//generate unique code
				if (!$user->verify_code || strlen($user->verify_code)==0) {
					
					//create unique string
					$userString = $user->email . microtime() . uniqid();
					
					//encrypt code
					$user->verify_code = hash('sha256', $userString);	
					
					//save code
					$user->save();
					
				}
				
				
			} //end if (valid user)
			
		} //end generateVerifyCode()
		
		

	
		
		private function sendVerifyEmail($user) {
			
			$result = false;
			
			//valid user
			if ($user && $user->email && strlen($user->email)>0) {
				
				//generate and store unique code
				$this->generateVerifyCode($user);
				
				
				//valid code
				if ($user->verify_code && strlen($user->verify_code)>0) { 
				
				
					//compile last address line
					$address3 = $user->city;
					if ($user->state && strlen($user->state)>0) {
						$address3 .= strlen($address3)>0 ? ', ' . $user->state : $user.state;
					}
					if ($user->zip_code && strlen($user->zip_code)>0) {
						$address3 .= strlen($address3)>0 ? ', ' . $user->zip_code : $user.zip_code;
					}
					
					
					//create view parameters
					$viewParams = Array(
						'name' => $user->name,
						'address1' => $user->address_1,
						'address2' => $user->address_2,
						'address3' => $address3,
						'verifyLink' => URL::to('/share?code=' . $user->verify_code),
						'unsubscribeLink' => URL::to('/unsubscribe?code=' . $user->verify_code)
					);
					
					//create email view
					$view = View::make('belif::email.verify')->with($viewParams);
					
					
					//create headers
					$headers = "MIME-Version: 1.0\r\n"
							 . "Content-type: text/html;charset=UTF-8\r\n"
							 . "From: " . self::EMAIL_SENDER_VERIFY . "\r\n";
					
					
					//send through Laravel
				/*	try {
						
						//send email
						$result = Mail::send('belif::email.verify', $viewParams, function ($data) use ($user) {
							$data->from(self::EMAIL_SENDER_VERIFY, 'Belif');
							$data->to($user->email, $user->name);
							$data->subject(self::EMAIL_SUBJECT_VERIFY);
						});
						
					}
					//Laravel SMTP failed try alternate
					catch (Exception $e) {
				*/		
						//send email through sendmail
						$result = mail($user->email, self::EMAIL_SUBJECT_VERIFY, $view->render(), $headers);	
										
				//	}
					
						
					
				
				} //end if (valid code)
				
			} //end if (valid user)
		
	
			return $result;
			
		} //end sendVerifyEmail()
		
		
		
		
		
		
		private function sendShareEmail($user, $shareUser) {
			
			$result = false;
			
			
			//valid user
			if ($user && $user->email && strlen($user->email)>0) {
		
		
				//valid share address
				if ($shareUser && $shareUser->email && strlen($shareUser->email)>0) {
		
		
					//shared user has not unsubscribed
					if (!$shareUser->unsubscribed) {
		
						//generate and store unique code (if one doesn't already exist)
						$this->generateVerifyCode($shareUser);
					
		
						//create view parameters
						$viewParams = Array(
							'unsubscribeLink' => URL::to('/unsubscribe?code=' . $shareUser->verify_code)
						);
						
						//create email view
						$view = View::make('belif::email.share')->with($viewParams);
			
						//create subject line
						$subject = $user->name . self::EMAIL_SUBJECT_SHARE;
			
						//create headers
						$headers = "MIME-Version: 1.0\r\n"
								 . "Content-type: text/html;charset=UTF-8\r\n"
								 . "From: " . self::EMAIL_SENDER_SHARE . "\r\n";
			
			/*
						//send through Laravel
						try {
							
							//send email
							$result = Mail::send('belif::email.share', $viewParams, function ($data) use ($user) {
								$data->from(self::EMAIL_SENDER_SHARE, 'Belif');
								$data->to($shareUser->email);
								$data->subject($user->name . self::EMAIL_SUBJECT_SHARE);
							});
							
						}
						//Laravel SMTP failed try alternate
						catch (Exception $e) {
				*/
							//send email through sendmail
							$result = mail($shareUser->email, $subject, $view->render(), $headers);
							
				//		}
					
					}
				
				} //end if (valid share address)
				
			} //end if (valid user)
		
	
			return $result;
			
		} //end sendShareEmail()
		
		
		
		
		
		
		private function sendProductEmail($user) {
			
			$result = false;
			
			//valid user
			if ($user && $user->email && strlen($user->email)>0) {
				
				//generate and store unique code
				$this->generateVerifyCode($user);
				
				
				//valid code
				if ($user->verify_code && strlen($user->verify_code)>0) { 
				
				
					//compile last address line
					$address3 = $user->city;
					if ($user->state && strlen($user->state)>0) {
						$address3 .= strlen($address3)>0 ? ', ' . $user->state : $user.state;
					}
					if ($user->zip_code && strlen($user->zip_code)>0) {
						$address3 .= strlen($address3)>0 ? ', ' . $user->zip_code : $user.zip_code;
					}
					
					
					//create view parameters
					$viewParams = Array(
						'unsubscribeLink' => URL::to('/unsubscribe?code=' . $user->verify_code)
					);
					
					//create email view
					$view = null;
					if ($user->product==1) {
						$view = View::make('belif::email.product1')->with($viewParams);
					}
					else {
						$view = View::make('belif::email.product2')->with($viewParams);	
					}
					
					//valid view
					if ($view) {
					
						//create headers
						$headers = "MIME-Version: 1.0\r\n"
								 . "Content-type: text/html;charset=UTF-8\r\n"
								 . "From: " . self::EMAIL_SENDER_PRODUCT . "\r\n";
						
						//send email through sendmail
						$result = mail($user->email, self::EMAIL_SUBJECT_PRODUCT, $view->render(), $headers);	
						
					} //end if (valid view)
				
				} //end if (valid code)
				
			} //end if (valid user)
		
	
			return $result;
			
		} //end sendProductEmail()
		

						
	} //end class MainController
?>