<?php

	namespace Belif\Mobile\Controllers;

	use Soup\CMS\Lib\CMSTrigger;

	use Belif\Mobile\Controllers\BaseController;
	use Belif\Mobile\Models\User;
	use Belif\Mobile\Models\Question;
	use Belif\Mobile\Models\ProductImage;
	use Belif\Mobile\Jobs\SendEmailJob;

	use URL;
	use View;
	use Redirect;
	use Session;
	use Illuminate\Support\Facades\Auth;

	class MainController extends BaseController implements CMSTrigger {
		
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
				$pageData = $this->dataForPage(self::FORM_DESKTOP);
				
				//get background image
				$backgroundImage = safeArrayValue('background_image', $pageData);
				
				//render view
				return View::make('belif::pages.desktop')->with(Array (
					'fullScreen' => true,
					'pageName' => 'home',
					'pageData' => $pageData
				));
			
	    	} //end if (is desktop)
	    	
	    	//redirect for mobile requests
			return Redirect::action('ProductController@getIndex');
			
		} //end getDesktop()
		
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
				'formURL' => route('belif.email'),
				'headerLogoUrl' => $this->header_logo_url_white,
				'termsURL' => $this->terms_and_conditions_url
			));
			
		} //end getEmail()
			
		public function postEmail() {
	
			$valid = true;
			$errors = null;
			
			//get form values
			$email = safeArrayValue('email', $_POST);
			$agree = safeArrayValue('agree', $_POST);
			
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

			// valid terms
			else if (!$agree) {
				$errors = 'Please agree to the T&Cs';
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
				
				//clear selected products
				Session::set('selectedProducts', null);
				
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
					return Redirect::route('belif.guide');
				
				}
				else {
					
					//show unavailable
					return Redirect::route('belif.unavailable');
					
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
		
			//clear quiz answers
			$this->clearAnswers(0);
		
			//render view
			return View::make('belif::pages.guide')->with(Array (
				'pageName' => 'guide',
				'pageData' => $pageData,
				'backgroundImage' => $backgroundImage,
				'buttonURL' => route('belif.question'),
				'backURL' => route('belif.home'),
				'nextURL' => route('belif.question'),
				'headerLogoUrl' => $this->header_logo_url_white
			));
			
		} //end getGuide()
		
		public function getUnavailable() {

			
			//check if product available
			$available = $this->productAvailable(); 
			
			//available
			if ($available) {
				
				//show quiz
				return Redirect::route('belif.home');
				
			}
			//not available
			else {
			
				//get page data
				$pageData = $this->dataForPage(self::FORM_NO_SAMPLES);
				
				//get background image
				$backgroundImage = safeArrayValue('background_image', $pageData);
				
				//render view
				return View::make('belif::pages.unavailable')->with(Array (
					'pageName' => 'unavailable',
					'pageData' => $pageData,
					'backgroundImage' => $backgroundImage,
					'headerLogoUrl' => $this->header_logo_url_white
				));
			
			}
			
		} //end getUnavailable()
		
		public function getAddress() {
			
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
				'headerLogoUrl' => $this->header_logo_url_white,
				'formURL' => route('belif.address'),
				'backURL' => route('belif.results')
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
			
				//get sample product
				$products = $this->getSelectedProducts();
				
				//get state
				$states = availableStates();
				$state = (is_numeric($stateId) && $stateId>=0 && $states && $stateId<count($states)) ? $states[$stateId] : null;
			
				//find ip address
				$ipAddress = retrieveIPAddress();
				
				//get current answers
				$answers = Session::get('answers');		
				$answersJSON = null;
				if ($answers) {
					
					//get questions
					$questions = Question::select('id')
									->orderBy('order')
									->orderBy('id')
									->get();
					
					//compile array (reference questions by Id)
					$referencedArray = [];
					for ($i=0; $i<count($questions) && $i<=count($answers); ++$i) {
						
						$qId = safeObjectValue('id', $questions[$i], -1);
						$referencedArray[$qId] = $answers[$i+1];
						
					} //end for()
					
					try {
						$answersJSON = json_encode($referencedArray);
					}
					catch (Exception $ex) {
						//error processing JSON
					}	
				}	

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
					
						//get products
						$product1 = null;
						$product2 = null;
						if ($products && count($products)>0) {
							$product1 = $products[0];	
							if (count($products)>1) {
								$product2 = $products[1];	
							}
						}
					
						//update user details
						$user->name = $name;
						$user->email = $email;
						$user->address_1 = $address1;
						$user->address_2 = $address2;
						$user->city = $city;
						$user->state = $state;
						$user->zip_code = $zipCode;
						$user->ip_address = $ipAddress;
						$user->product_1 = $product1;
						$user->product_2 = $product2;
						$user->answers = $answersJSON;
						
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

			//get session email
			$email = Session::get('email');
			if ($email && strlen($email)>0) {
				
				//get user details
				$user = User::where('email', '=', $email)->first();
				$this->sendVerifyEmail($user);
			
			}
			
			//render view
			return View::make('belif::pages.verify')->with(Array (
				'pageName' => 'verify',
				'pageData' => $pageData,
				'backgroundImage' => $backgroundImage,
				'headerLogoUrl' => $this->header_logo_url_white,
				//'backURL' => route('belif.address'),
				//'buttonURL' => route('belif.share')
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
				'headerLogoUrl' => $this->header_logo_url_white,
				'backURL' => route('belif.address'),
				'buttonURL' => route('belif.share'),				
				'verifyEmail' => $user->email
			));
			
		} //end getReverify()
		
		public function getConfirm() {
			
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
						return Redirect::route('belif.share', ['code' => $code]);
						
					}
					
					//verify code
					else {
				
						//indicate email is verified
						$user->email_verified = true;
						$user->save();
				
						//get page data
						$pageData = $this->dataForPage(self::FORM_CONFIRM);
						
						//get background image
						$backgroundImage = safeArrayValue('background_image', $pageData);
						
						//render view
						return View::make('belif::pages.confirm')->with(Array (
							'pageName' => 'share',
							'pageData' => $pageData,
							'code' => $code,
							'backgroundImage' => $backgroundImage,
							'headerLogoUrl' => $this->header_logo_url_white
						));
					
					}
				
				} //end if (valid code)
				
			} //end if (valid code)
			
			//invalid code - show home page
			return Redirect::route('belif.home');
			
		} //end getShare()	
			
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
				
					//indicate email is verified
					$user->email_verified = true;
					$user->save();

					return Redirect::route('belif.results');
				
				} //end if (valid code)
				
			} //end if (valid code)
			
			//invalid code - show home page
			return Redirect::route('belif.home');
			
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
			return Redirect::route('belif.home');
			
		} //end postShare()
		
		public function getThanks() {
			
			$userId = Session::get('userId');

			$user = User::find($userId);

			$code = $user->verify_code;

			//get page data
			$pageData = $this->dataForPage(self::FORM_THANKS);
			
			//get background image
			$backgroundImage = safeArrayValue('background_image', $pageData);
			
			//render view
			return View::make('belif::pages.thanks')->with(Array (
				'pageName' => 'thanks',
				'pageData' => $pageData,
				'backgroundImage' => $backgroundImage,
				'headerLogoUrl' => $this->header_logo_url_white,
				'buttonURL' => 'http://www.sephora.com/belif',
				'backURL' => route('belif.share', ['code' => $code])
			));
			
		} //end getThanks()
		
		public function getUnsubscribe() {
			
			//get verification code
			$code = safeArrayValue('code', $_GET, null);

			//get page data
			$pageData = $this->dataForPage(self::FORM_UNSUBSCRIBE);
			
			//get background image
			$backgroundImage = safeArrayValue('background_image', $pageData);

			$unsubscribed = safeArrayValue('unsubscribe', $_GET, 0);
			
			//valid code
			if ($code && strlen($code)>0) { 
			
				//validate code
				$user = User::where('verify_code', '=', $code)->first();
				if ($user) {
			
					//update user
					$user->unsubscribed = true;
					$unsubscribed = 1;
					$user->save();
					
				} //end if (valid code)
				
			} //end if (valid code)
			
			//render view
			return View::make('belif::pages.unsubscribe')->with(Array (
				'pageName' => 'unsubscribe',
				'pageData' => $pageData,
				'formURL' => route('belif.unsubscribe'),
				'backgroundImage' => $backgroundImage,
				'unsubscribed' => $unsubscribed,
				'headerLogoUrl' => $this->header_logo_url_white
			));
			
		} //end getUnsubscribe()
		
		public function postUnsubscribe() {

			//get verification code
			$email = safeArrayValue('email', $_POST, null);

			if ($email && strlen($email)>0) { 
			
				//validate code
				$user = User::where('email', '=', $email)->first();
				if ($user) {
			
					//update user
					$user->unsubscribed = true;
					$unsubscribed = 1;
					$user->save();
					
					return Redirect::route('belif.unsubscribe', ['unsubscribe' => 1]);

				} //end if (valid code)
				
			} //end if (valid code)

			return Redirect::route('belif.unsubscribe', ['unsubscribe' => 0]);
		}

		//==========================================================//
		//====					EMAIL METHODS					====//
		//==========================================================//
		
		public function getEmailTest() {
		
			$users = [22, 38, 40, 44, 45, 46, 47, 48, 49, 52, 54, 57, 58, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 76, 77, 78, 79, 81, 82, 83, 84, 86, 87, 88, 89, 91, 92, 93, 94, 96, 97, 98, 99, 101, 102, 104, 105, 106, 107, 109, 113, 115, 116, 119, 121, 122, 123, 124, 125, 126, 128, 130, 131, 134, 137, 138, 139, 141, 143, 146, 147, 150, 151, 152, 153, 154, 155, 156, 157, 158, 159, 161, 162, 163, 164, 165, 168, 171, 172, 173, 174, 175, 176, 178, 179, 180, 184, 186, 187, 188, 190, 191, 192, 194, 195, 198, 200, 204, 205, 208, 209, 210, 211, 214, 215, 219, 220, 221, 222, 223, 224, 225, 226, 227, 229, 230, 231, 233, 234, 235, 237, 240, 242, 243, 245, 246, 247, 248, 249, 251, 252, 253, 254, 256, 257, 258, 260, 261, 262, 266, 267, 268, 269, 270, 271, 272, 274, 275, 277, 278, 279, 280, 281, 282, 283, 284, 285, 286, 287, 289, 291, 293, 295, 297, 298, 299, 300, 301, 302, 303, 304, 305, 307, 308, 309, 310, 311, 312, 313, 314, 315, 316, 317, 320, 322, 324, 325, 327, 330, 332, 333, 334, 336, 337, 338, 339, 340, 341, 342, 343, 344, 345, 347, 349, 350, 351, 353, 354, 355, 356, 357, 358, 361, 364, 365, 370, 371, 373, 374, 376, 378, 379, 380, 381, 382, 383, 384, 385, 386, 387, 388, 389, 392, 393, 395, 397, 398, 399, 401, 402, 403, 404, 405, 409, 410, 412, 413, 414, 415, 416, 419, 423, 424, 425, 426, 427, 428, 430, 431, 436, 437, 441, 444, 445, 446, 447, 449, 451, 452, 453, 454, 455, 456, 458, 459, 460, 461, 462, 463, 464, 467, 469, 470, 471, 472, 473, 474, 477, 478, 480, 481, 483, 484, 485, 486, 490, 492, 493, 494, 495, 497, 499, 501, 503, 504, 505, 506, 507, 509, 511, 512, 513, 514, 516, 517, 518, 523, 525, 528, 529, 530, 532, 534, 536, 537, 539, 540, 541, 542, 543, 546, 547, 549, 550, 551, 552, 553, 554, 555, 556, 560, 562, 563, 564, 565, 566, 568, 569, 570, 571, 572, 573, 574, 576, 579, 580, 582, 583, 584, 585, 587, 588, 589, 591, 593, 594, 595, 596, 597, 598, 599, 600, 601, 602, 603, 604, 605, 606, 607, 608, 612, 614, 616, 618, 621, 622, 623, 624, 627, 630, 632, 633, 634, 637, 638, 639, 641, 642, 643, 644, 646, 647, 652, 653, 655, 658, 659, 660, 661, 662, 663, 666, 668, 670, 671, 672, 674, 675, 676, 677, 678, 680, 681, 684, 685, 686, 687, 692, 693, 694, 696, 697, 698, 704, 706, 707, 709, 710, 711, 712, 713, 717, 719, 721, 722, 723, 724, 727, 729, 730, 731, 732, 733, 735, 736, 737, 741, 742, 743, 744, 746, 749, 753, 754, 755, 756, 758, 760, 762, 764, 765, 766, 767, 770, 771, 773, 774, 776, 777, 779, 781, 782, 783, 784, 785, 787, 792, 793, 794, 796, 797, 798, 800, 801, 804, 806, 807, 808, 809, 810, 813, 815, 816, 817, 818, 821, 822, 823, 824, 825, 826, 830, 831, 832, 833, 834, 835, 837, 838, 839, 840, 841, 845, 846, 848, 849, 850, 852, 853, 854, 856, 857, 858, 859, 860, 863, 864, 867, 869, 871, 872, 873, 876, 877, 878, 879, 882, 883, 884, 886, 887, 888, 889, 890, 892, 893, 895, 896, 897, 898, 901, 902, 903, 904, 906, 908, 909, 910, 912, 913, 914, 918, 919, 920, 921, 922, 923, 924, 925, 926, 927, 929, 930, 931, 932, 933, 934, 935, 936, 937, 939, 941, 944, 945, 946, 950, 951, 952, 954, 956, 957, 958, 959, 961, 962, 964, 965, 966, 967, 968, 969, 970, 971, 972, 976, 977, 978, 979, 980, 982, 984, 985, 986, 987, 988, 989, 990, 992, 994, 995, 996, 1000, 1002, 1003, 1004, 1005, 1007, 1008, 1009, 1010, 1011, 1012, 1014, 1015, 1017, 1020, 1022, 1023, 1024, 1027, 1028, 1032, 1033, 1034, 1035, 1036, 1039, 1042, 1043, 1044, 1045, 1047, 1048, 1050, 1052, 1053, 1054, 1055, 1056, 1057, 1058, 1059, 1062, 1064, 1065, 1067, 1071, 1074, 1075, 1076, 1078, 1079, 1081, 1082, 1085, 1086, 1087, 1089, 1091, 1092, 1094, 1095, 1097, 1098, 1099, 1100, 1101, 1102, 1103, 1104, 1108, 1110, 1111, 1112, 1113, 1114, 1115, 1116, 1118, 1119, 1120, 1121, 1122, 1126, 1128, 1129, 1130, 1132, 1133, 1134, 1135, 1137, 1138, 1139, 1143, 1144, 1145, 1146, 1150, 1151, 1153, 1155, 1157, 1158, 1164, 1166, 1168, 1170, 1173, 1175, 1178, 1181, 1182, 1183, 1184, 1185, 1186, 1187, 1188, 1189, 1190, 1194, 1195, 1197, 1199, 1200, 1202, 1203, 1205, 1206, 1207, 1208, 1211, 1212, 1215, 1216, 1217, 1219, 1220, 1221, 1223, 1224, 1226, 1228, 1230, 1231, 1232, 1233, 1236, 1237, 1238, 1241, 1243, 1244, 1245, 1246, 1247, 1249, 1251, 1252, 1254, 1255, 1256, 1258, 1259, 1260, 1262, 1266, 1267, 1268, 1269, 1272, 1273, 1274, 1275, 1276, 1280, 1281, 1282, 1283, 1285, 1286, 1287, 1291, 1292, 1296, 1298, 1300, 1301, 1305, 1306, 1307, 1309, 1310, 1311, 1312, 1313, 1316, 1318, 1319, 1321, 1322, 1324, 1325, 1326, 1327, 1329, 1332, 1333, 1334, 1335, 1336, 1338, 1339, 1342, 1343, 1344, 1348, 1349, 1350, 1351, 1352, 1353, 1354, 1356, 1357, 1358, 1359, 1360, 1361, 1362, 1363, 1365, 1366, 1367, 1369, 1370, 1375, 1376, 1378, 1379, 1381, 1382, 1386, 1387, 1388, 1389, 1390, 1392, 1393, 1394, 1395, 1397, 1398, 1400, 1401, 1402, 1404, 1410, 1411, 1412, 1413, 1414, 1418, 1419, 1420, 1421, 1422, 1424, 1426, 1427, 1430, 1432, 1433, 1434, 1435, 1436, 1437, 1438, 1439, 1441, 1442, 1443, 1445, 1446, 1447, 1449, 1450, 1451, 1452, 1453, 1455, 1457, 1458, 1460, 1462, 1463, 1466, 1473, 1475, 1476, 1477, 1478, 1486, 1490, 1492, 1493, 1498, 1500, 1503, 1504, 1505, 1506, 1507, 1509, 1513, 1514, 1515, 1516, 1517, 1519, 1520, 1522, 1524, 1526, 1527, 1530, 1531, 1534, 1535, 1538, 1541, 1542, 1543, 1545, 1546, 1547, 1550, 1551, 1553, 1554, 1559, 1561, 1565, 1568, 1570, 1571, 1573, 1574, 1576, 1578, 1579, 1580, 1581, 1590, 1591, 1592, 1593, 1594, 1595, 1597, 1598, 1601, 1604, 1605, 1606, 1607, 1608, 1609, 1610, 1612, 1613, 1614, 1615, 1617, 1618, 1619, 1620, 1623, 1624, 1625, 1626, 1627, 1629, 1630, 1633, 1634, 1635, 1636, 1638, 1640, 1643, 1644, 1648, 1650, 1651, 1652, 1654, 1655, 1657, 1658, 1660, 1661, 1662, 1664, 1668, 1670, 1672, 1673, 1675, 1676, 1677, 1678, 1679, 1680, 1683, 1684, 1685, 1686, 1687, 1688, 1689, 1690, 1691, 1692, 1695, 1696, 1700, 1702, 1703, 1704, 1707, 1710, 1712, 1715, 1716, 1718, 1719, 1720, 1722, 1724, 1725, 1726, 1728, 1729, 1730, 1732, 1734, 1735, 1736, 1737, 1738, 1740, 1741, 1744, 1745, 1747, 1748, 1751, 1752, 1754, 1756, 1758, 1759, 1762, 1763, 1765, 1767, 1769, 1772, 1773, 1774, 1777, 1778, 1779, 1780, 1783, 1785, 1789, 1793, 1795, 1797, 1798, 1800, 1801, 1802, 1803, 1804, 1809, 1812, 1814, 1815, 1816, 1822, 1823, 1824, 1827, 1830, 1832, 1834, 1835, 1836, 1838, 1839, 1840, 1841, 1842, 1846, 1851, 1853, 1854, 1855, 1857, 1858, 1859, 1862, 1863, 1865, 1866, 1867, 1869, 1870, 1871, 1874, 1876, 1877, 1880, 1881, 1882, 1883, 1884, 1885, 1886, 1888, 1889, 1892, 1894, 1896, 1898, 1900, 1901, 1902, 1903, 1905, 1906, 1908, 1910, 1912, 1913, 1915, 1916, 1920, 1921, 1922, 1923, 1924, 1925, 1927, 1929, 1930, 1931, 1933, 1934, 1935, 1937, 1938, 1941, 1942, 1947, 1948, 1953, 1954, 1955, 1956, 1958, 1959, 1960, 1962, 1963, 1964, 1967, 1969, 1973];
			
			//test user
			$users = [20]; //[38];
			
			//valid code
			$code = safeArrayValue('code', $_GET, null);
			if ($code && strcmp($code, "JKSNCSP39034nc3a0")==0) {
				
				//valid data 
				if ($users) {
					
					$userData = [];
					foreach ($users as $userId) {
						
						$obj = new \stdClass();
						$obj->id = $userId;
						array_push($userData, $obj);
					}
					//dd($userData);
					
					//send emails
					echo $this->handleTrigger($userData, null);
					
					
				} //end if (valid users)
				
			} //end if (valid code)
				
		} //end getEmailTest()
		
		
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
				
					//get page data
					$pageData = $this->dataForPage(self::EMAIL_VERIFY);
					
				
					//compile last address line
					$address3 = $user->city;
					if ($user->state && strlen($user->state)>0) {
						$address3 .= strlen($address3)>0 ? ', ' . $user->state : $user.state;
					}
					if ($user->zip_code && strlen($user->zip_code)>0) {
						$address3 .= strlen($address3)>0 ? ', ' . $user->zip_code : $user.zip_code;
					}
					
					//send confirm email (sent via queue to avoid delay loading next page)
					$emailJob = new SendEmailJob([
						"recipient" => $user->email, 
						"sender" => [
							'email' => self::EMAIL_SENDER_VERIFY, 
							'name' => 'belif'
						],
						"subject" => self::EMAIL_SUBJECT_VERIFY,
						"view" => "belif::email.verify",
						"view_properties" => [
							'name' => $user->name,
							'address1' => $user->address_1,
							'address2' => $user->address_2,
							'address3' => $address3,
							'pageData' => $pageData,
							'verifyLink' => route('belif.share', ['code' => $user->verify_code]),
							'unsubscribeLink' => route('belif.unsubscribe', ['code' => $user->verify_code])
						]
					]);
					$this->dispatch($emailJob);
					//$emailJob->handle();
					$result = true;
				
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
					
						//get page data
						$pageData = $this->dataForPage(self::EMAIL_SHARE);
		
						//create subject line
						$subject = $user->name . self::EMAIL_SUBJECT_SHARE;
			
						//send share email (sent via queue to avoid delay loading next page)
						$emailJob = new SendEmailJob([
							"recipient" => $shareUser->email, 
							"sender" => [
								'email' => self::EMAIL_SENDER_SHARE, 
								'name' => 'Belif'
							],
							"subject" => $subject,
							"view" => "belif::email.share",
							"view_properties" => [
								'pageData' => $pageData,
								'unsubscribeLink' => route('belif.unsubscribe', ['code' => $shareUser->verify_code])
							]
						]);
						$this->dispatch($emailJob);
						$result = true;
					
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
				
				
					//get page data
					$pageData = $this->dataForPage(self::EMAIL_PRODUCT);
				
				
					//compile last address line
					$address3 = $user->city;
					if ($user->state && strlen($user->state)>0) {
						$address3 .= strlen($address3)>0 ? ', ' . $user->state : $user.state;
					}
					if ($user->zip_code && strlen($user->zip_code)>0) {
						$address3 .= strlen($address3)>0 ? ', ' . $user->zip_code : $user.zip_code;
					}
			
					//get image data
					$imageData = ProductImage::where(function ($query) use ($user) {
												$query->where('product_1', $user->product_1)
												  	  ->where('product_2', $user->product_2);
											})
											->orWhere(function ($query) use ($user) {
												$query->where('product_2', $user->product_1)
													  ->where('product_1', $user->product_2);
											})
											->first();
				
					//get product image
					$productImage = null;
					if ($imageData) {
						$productImage = safeObjectValue('image', $imageData, null);
					}

					//determine if multiple samples sent
					$multipleSamples = isset($user->product_1) && isset($user->product_2);

					//send product sent email (sent via queue to avoid delay loading next page)
					$emailJob = new SendEmailJob([
						"recipient" => $user->email, 
						"sender" => [
							'email' => self::EMAIL_SENDER_PRODUCT, 
							'name' => 'Belif'
						],
						"subject" => self::EMAIL_SUBJECT_PRODUCT,
						"view" => "belif::email.product",
						"view_properties" => [
							'pageData' => $pageData,
							'productImage' => $productImage,
							'productColour' => '#125a7d',
							'multipleSamples' => $multipleSamples,
							'unsubscribeLink' => route('belif.unsubscribe', ['code' => $user->verify_code])
						]
					]);
					$this->dispatch($emailJob);
					$result = true;

				} //end if (valid code)
				
			} //end if (valid user)
		
	
			return $result;
			
		} //end sendProductEmail()

		//==========================================================//
		//====					CMS METHODS					====//
		//==========================================================//	



		public function handleTrigger($data, $info) {

			//has data
			if ($data) {
				
				//wrap data for single users
				
				//count updated users
				$updatedUsers = 0;
				
				//process users
				foreach ($data as $userData) {
				
					//get user
					$user = User::find($userData->id);
					if ($user) {
				
						//check if product email already sent
						if (!$user->product_sent && $user->email_verified) {
							
							//get page data
							$pageData = $this->dataForPage(self::EMAIL_PRODUCT);
							
							//product image
							$productImage = null;
		
							
							//get image data
							$imageData = ProductImage::where(function ($query) use ($user) {
														$query->where('product_1', $user->product_1)
														  	  ->where('product_2', $user->product_2);
													})
													->orWhere(function ($query) use ($user) {
														$query->where('product_2', $user->product_1)
															  ->where('product_1', $user->product_2);
													})
													->first();
						
							//get product image
							if ($imageData) {
								$productImage = safeObjectValue('image', $imageData, null);
							}
						
			
							//determine if multiple samples sent
							$multipleSamples = isset($user->product_1) && isset($user->product_2);
							
							
							
							//send product sent email (sent via queue to avoid delay loading next page)
							$emailJob = new SendEmailJob([
								"recipient" => $user->email, 
								"sender" => [
									'email' => self::EMAIL_SENDER_PRODUCT, 
									'name' => 'Belif'
								],
								"subject" => self::EMAIL_SUBJECT_PRODUCT,
								"view" => "belif::email.product",
								"view_properties" => [
									'pageData' => $pageData,
									'productImage' => $productImage,
									'productColour' => '#125a7d',
									'multipleSamples' => $multipleSamples,
									'unsubscribeLink' => route('belif.unsubscribe', ['code' => $user->verify_code])
								]
							]);
							$this->dispatch($emailJob);
							//$emailJob->handle();
								
							//update user 
							$user->product_sent = true;
							$user->save();
							
							//increment user count
							++$updatedUsers;
							
							
						} //end if (product not sent)
					
					} //end if (found user match)
				
				} //end for()
				
				
				//set response message
				return "Processed users, " . $updatedUsers . " emails sent!";
				
				
			} //end if (has data)
			
			
			//return error response
			return "No data found";
			
		} //end handleTrigger()


						
	} //end class MainController
?>