<?php

	namespace Soup\Mobile\Controllers;

	use Soup\Mobile\Controllers\BaseController;
	use Soup\Mobile\Models\SoupUser;
	use Soup\Mobile\Models\UserProfile;
	use Soup\Mobile\Models\Question;
	use Soup\Mobile\Models\Venue;
	use Soup\Mobile\Models\VenueOpenHours;
	use Soup\Mobile\Models\Reservation;
	use Soup\Mobile\Models\Review;
	use Soup\Mobile\Lib\AppGlobals;
	use Soup\Mobile\Jobs\SendEmailJob;
	
	use View;
	use Redirect;
	use Illuminate\Support\Facades\Auth;
	
	use Carbon\Carbon;

	class MainController extends BaseController {
		

		//set menu options
		private $mainMenuOptions = null;


		public function __construct() {

			//standard menu button class
			$buttonClass = "bold title-light";

			//set menu options
			$this->mainMenuOptions = [
				[
					'name' => 'Profile',
					'url' => route('soup.user.profile'),
					'class' => $buttonClass
				],
				[
					'name' => 'How It Works',
					'url' => route('soup.guide', ['page' => 0]),
					'class' => $buttonClass
				],
				[
					'name' => 'Blog',
				//	'url' => route('soup.user.profile'),
					'class' => $buttonClass
				],
				[
					'name' => 'Help',
				//	'url' => route('soup.user.profile'),
					'class' => $buttonClass
				],
				[	
					'type' => 'spacer'
				],
				[
					'name' => 'LOG OUT',
					'url' => route('soup.logout'),
					'class' => 'title-semi-bold small button-page-border border-thin border-color-9 color-9'
				]
			];

		} //end constructor()
		
		

		//==========================================================//
		//====						USER						====//
		//==========================================================//	
	
	
	
		public function getUserProfile() {
		//	\DB::connection('Soup')->enableQueryLog();
			
			//get page data
			$pageData = $this->dataForPage(self::FORM_USER_PROFILE);
			//$pageData = $this->dataForFormId(self::FORM_USER_PROFILE);
			
			//get user
			$user = Auth::guard(AppGlobals::$AUTH_GUARD)->user();
			
			//get profile data
			$diets = null;
			$allergies = null;
			$favouriteMeal = null;
			$morningRoutine = null;
			$drinkPreference = null;
			$locations = null;
			$favouriteCuisine = null;
			$favouriteRestaurant = null;
			$restaurantQualities = null;
			if ($user) {
				
				//GET PROFILE DATA PROPERTIES
				
				//get user profile
				$profiles = UserProfile::where('user', '=', $user->id)->select('value');
				
				
				
				//diets
				$query = clone $profiles;
				$diets = $query->whereHas('question', function($subQuery) {
					$subQuery->where('group', '=', 'diet');
				})->get();
				
				//allergies
				$query = clone $profiles;
				$allergies = $query->where('question', '=', 'diet_text')->first();
				
				//favourite meal
				$query = clone $profiles;
				$favouriteMeal = $query->whereHas('question', function($subQuery) {
					$subQuery->where('group', '=', 'meal');
				})->get();
				
				//morning routing
				$query = clone $profiles;
				$morningRoutine = $query->whereHas('question', function($subQuery) {
					$subQuery->where('group', '=', 'wake');
				})->get();
				
				//drinks preference
				$query = clone $profiles;
				$drinkPreference = $query->whereHas('question', function($subQuery) {
					$subQuery->where('group', '=', 'drink');
				})->get();
				
				//favourite locations
				$query = clone $profiles;
				$locations = $query->whereHas('question', function($subQuery) {
					$subQuery->where('group', '=', 'location');
				})->get();
				
				//favourite cuisine
				$query = clone $profiles;
				$favouriteCuisine = $query->where('question', '=', 'cuisine')->first();
				
				//favourite restaurant
				$query = clone $profiles;
				$favouriteRestaurant = $query->where('question', '=', 'favRestaurant')->first();
				
				//restaurant qualities
				$query = clone $profiles;
				$restaurantQualities = $query->whereHas('question', function($subQuery) {
					$subQuery->where('group', '=', 'restaurant');
				})->get();
		
//		print_r(\DB::connection('Soup')->getQueryLog());

			} //end if (valid user)
			
			
			//check if next button should show
			$showNext = \Request::session()->get('showNext');

			//restore flash data (in case page refreshed)
			\Request::session()->reflash();

			//next page url
			$nextURL = route('soup.venue.recommendation');
			
			//draw page
			return View::make('soup::pages.user.profile')->with([
				'pageName' => 'user profile',
				'pageData'=> $pageData,
				'nextURL' => $showNext ? $nextURL : null,
				'backURL' => $showNext ? null : $nextURL,
				'user' => $user,
				//'profile' => $profileData,
				'diets' => extractModelValues('value', $diets),
				'allergies' => safeObjectValue('value', $allergies),
				'favouriteMeal' => extractModelValues('value', $favouriteMeal),
				'morningRoutine' => extractModelValues('value', $morningRoutine),
				'drinkPreference' => extractModelValues('value', $drinkPreference),
				'locations' => extractModelValues('value', $locations),
				'favouriteCuisine' => safeObjectValue('value', $favouriteCuisine),
				'favouriteRestaurant' => safeObjectValue('value', $favouriteRestaurant),
				'restaurantQualities' => extractModelValues('value', $restaurantQualities),
				'fullScreen' => true,
//				'hideHeaderTitle' => true
			]);
			
		} //end getUserProfile()
	
	
	
		public function getVenueRecommendations() {
			
			//get user data
			$user = Auth::guard(AppGlobals::$AUTH_GUARD)->user();
			
			//get venues data
			$dinnerVenue = Venue::find(1);
			$brunchVenue = Venue::find(1);

			//draw page
			return View::make('soup::pages.venue.recommendations')->with([
				'pageName' => 'recommendations',
				'user' => $user,
				'dinnerVenue' => $dinnerVenue,
				'brunchVenue' => $brunchVenue,
				'menuOptions' => $this->mainMenuOptions
				//'pageData'=> $pageData,
				//'nextURL' => route('soup.question'),
				//'backURL' => route('soup.welcome'),
			]);
			
		} //end getVenueRecommendations()
	
	
	
		public function getVenueProfile($venueId) {
			
			//get page data
			$pageData = $this->dataForPage(self::FORM_VENUE_PROFILE);
			//$pageData = $this->dataForFormId(self::FORM_VENUE_PROFILE);
			
			//get venue data
			$venue = Venue::find($venueId);
			
			//draw page
			return View::make('soup::pages.venue.profile')->with([
				'pageName' => safeObjectValue('name', $venue, 'venue profile'),
				'pageData'=> $pageData,
				//'nextURL' => route('soup.question'),
				'backURL' => route('soup.venue.recommendation'),
				'menuOptions' => $this->mainMenuOptions,
				'venue' => $venue,
				'mapsKey' => AppGlobals::GOOGLE_API_KEY
			]);
			
		} //end getVenueProfile()
	
	
	
	
	
	
		public function getReservation($venueId, $reservationKey = null) {
			
			//get page data
			$pageData = $this->dataForPage(self::FORM_RESERVATION);
			//$pageData = $this->dataForFormId(self::FORM_RESERVATION);
			
			//get venue data
			$venue = Venue::find($venueId);

			//get pre-existing reservation
			$reservation = null;
			if ($reservationKey && strlen($reservationKey)>0) {
				$reservation = Reservation::where('code', '=', $reservationKey)->first();
			}

			//draw page
			return View::make('soup::pages.reservation.form')->with([
				'pageName' => 'reservation',
				'pageData'=> $pageData,
				//'nextURL' => route('soup.question'),
				'backURL' => route('soup.venue.profile', ['venueId' => $venueId]),
				'venue' => $venue,
				'reservation' => $reservation,
				'formURL' => route('soup.reservation')
			]);
			
		} //end getReservation()
	
	
	
		public function postReservation() {
			
			$valid = true;
			$errors = null;
			
			//get form values
			$venueId = safeArrayValue('venue', $_POST);
			$reservationKey = safeArrayValue('reservation', $_POST);
			$guests = safeArrayValue('guests', $_POST);
			$dateString = safeArrayValue('date', $_POST);
			$timeString = safeArrayValue('time', $_POST);
			
			//get reservation date
			$date = parseDateString($dateString);
			$time = parseDateString($timeString, ['g:i', 'g:i A', 'h:i', 'h:i A', 'H:i']);
			$reservationDate = null;
			if ($date && $time) {			
				$reservationDate = Carbon::create(
					$date->year, 
					$date->month, 
					$date->day, 
					$time->hour, 
					$time->minute,
					0
				);
			}
			
			//get bounding dates
			$currentDate = Carbon::now();
			$earliestReservationDate = Carbon::now()->addMinutes(30);
			
			//get venue data
			$venue = null;
			$hours = null;
			if ($venueId && strlen($venueId)>0) {
				$venue = Venue::find($venueId);
				if ($reservationDate) {
					$hours = VenueOpenHours::where('venue', '=', $venueId)
							->where('day', '=', $reservationDate->format('l'))
							->where('open_time', '<=', $reservationDate->format('H:i'))
							->where('close_time', '>', $reservationDate->format('H:i'))
							->first();
				}
			}
			
			//find user
			$user = Auth::guard(AppGlobals::$AUTH_GUARD)->user();
			

			//valid venue
			if (!$venue) {
				$errors = 'Sorry, an error occured processing your reservation.';
				$valid = false;
			}
			
			//valid user
			else if (!$user) {
				$errors = 'Sorry, an error occured processing your reservation.';
				$valid = false;
			}
			
			//valid guests
			else if ($guests<=0) {
				$errors = 'At least one guest is required.';
				$valid = false;
			}
			else if ($guests>30) {
				$errors = 'Sorry, reservations can not be for more than 30 people.';
				$valid = false;
			}
			
			//date exists
			else if (!$dateString || strlen($dateString)<=0 || !$date) {
				$errors = 'Please specify a valid reservation date.';
				$valid = false;
			}
			
			//time exists
			else if (!$timeString || strlen($timeString)<=0 || !$time) {
				$errors = 'Please specify a valid reservation time.';
				$valid = false;
			}
			
			//invalid date
			else if (!$reservationDate) {
				$errors = 'Sorry, we could not process your reservation date.';
				$valid = false;
			}
			
			//date is in the past
			else if ($reservationDate->lt($currentDate)) {
				$errors = 'Please specify a future date.';
				$valid = false;
			}

			//date is too soon
			else if ($reservationDate->lt($earliestReservationDate)) {
				$errors = 'Sorry, online reservations must be made at least 30mins prior to your booking.';
				$valid = false;
			}
			
			//check if venue is open
			else if (!$hours) {
				$errors = 'Sorry, it looks like ' . $venue->name . ' is not open at that time.';
				$valid = false;
			}
			
			
			
			//valid form
			if ($valid) {

				//find pre-existing reservation
				$reservation = null;
				if ($reservationKey && strlen($reservationKey)>0) {
					$reservation = Reservation::where('code', '=', $reservationKey)->where('status', '=', AppGlobals::RESERVATION_STATUS_DRAFT)->first();
				}
			
				//create reservation data
				if (!$reservation) {
					$reservation = new Reservation();
					$reservation->code = generateUniqueCode('r', 10);
				}
				
				//found reservation
				if ($reservation) {
					
					//update reservation
					$reservation->user = $user->id;
					$reservation->venue = $venueId;
					$reservation->guests = $guests;
					$reservation->date = $reservationDate;
					$reservation->status = AppGlobals::RESERVATION_STATUS_DRAFT;
					$reservation->save();
	//				$reservation = Array (
	//					'venueId' => $venueId,
	//					'guests' => $guests,
	//					'date' => $reservationDate
	//				);
					
					//store reservation details in session (flash)
					//\Request::session()->set('reservation', $reservation);

					return Redirect::route('soup.reservation.confirm.id', ['reservationKey' => $reservation->code]); 
					//->with([
					//	'reservation' => $reservation
					//]);
				
				}
				//failed to create reservation
				else {
					$errors = "Sorry, an error occurred processing your reservation";
					$valid = false;	
				}
			}
			
			//form has errors
			if (!$valid) {
				return Redirect::back()
							->withInput()
							->withErrors($errors);
			}
			
		} //end postReservation()
		
		
	
		public function getReservationConfirmation($reservationKey) {
			
			$valid = true;
		
			//valid key
			if ($reservationKey && strlen($reservationKey)>0) {
			
				//get page data
				$pageData = $this->dataForPage(self::FORM_RESERVATION_CONFIRM);
				//$pageData = $this->dataForFormId(self::FORM_RESERVATION_CONFIRM);
				
				//get reservation
				$reservation = Reservation::where('code', '=', $reservationKey)->first();
				
				
				//validate reservation
				if ($reservation) {
				
					//get reservation properties
					$userId = safeObjectValue('user', $reservation, -1);
					$venueId = safeObjectValue('venue', $reservation, -1);

					//find user
					$user = Auth::guard(AppGlobals::$AUTH_GUARD)->user();
					if ($user && strcmp($user->id, $userId)==0) {
				
						//get venue data
						$venue = null;
						if ($venueId>=0) {
							$venue = Venue::find($venueId);
						}
	
						//valid form
						if ($venue) {
		
							//create back URL
							$backURL = route('soup.reservation.id.id', [
								'venueId' => $venueId,
								'reservationKey' => $reservation->code
							]);
		
							//draw page
							return View::make('soup::pages.reservation.confirm')->with([
								'pageName' => 'confirm reservation',
								'pageData'=> $pageData,
								'venue' => $venue,
								'reservation' => $reservation,
								//'nextURL' => route('soup.question'),
								'backURL' => $backURL,
								'formURL' => route('soup.reservation.confirm')
							]);
						
						}
						//invalid venue
						else {
							$errors = "Sorry, we can't seem to find the venue you wanted.";
							$valid = false;	
						}
					
					}
					//invalid user
					else {
						$errors = "Sorry, your user details do not seem to match.";
						$valid = false;	
					}
					
				}
				//invalid reservation
				else {
					$errors = "Sorry, your reservation appears invalid.";
					$valid = false;	
				}
				
				
				//form has errors
				if (!$valid) {
					return Redirect::back()
								->withInput()
								->withErrors($errors);
				}
			
			} //end if (valid reservation key)
			
			//invalid key
			else {
				$valid = false;	
			}
			
			
			//invalid reservation
			if (!$valid) {
				
				return Redirect::route('soup.venue.recommendation');
				
			}
			
		} //end getReservationConfirmation()
		
		
		
		
		public function postReservationConfirmation() {
			
			$valid = true;
			$errors = null;
			
			//get form values
			$reservationKey = safeArrayValue('reservation', $_POST);

			//find reservation
			$reservation = Reservation::where('code', '=', $reservationKey)->first();
			if ($reservation && $reservation->status==AppGlobals::RESERVATION_STATUS_DRAFT) {
				
				//get reservation properties
				$userId = safeObjectValue('user', $reservation, -1);
				$venueId = safeObjectValue('venue', $reservation, -1);

				//find user
				$user = Auth::guard(AppGlobals::$AUTH_GUARD)->user();
				if ($user && strcmp($user->id, $userId)==0) {
					
					//get venue data
					$venue = null;
					if ($venueId>=0) {
						$venue = Venue::find($venueId);
					}
	
					//valid venue
					if ($venue) {
					
						//store reservation details in session (flash)
						//\Request::session()->set('reservation', $reservation);
					
						//update reservation status
						$reservation->status = AppGlobals::RESERVATION_STATUS_REQUESTED;
						$reservation->save();
						
						//USER CONFIRMATION EMAIL
						//send reservation request email (sent via queue to avoid delay loading next page)
						$emailJob = new SendEmailJob([
							"recipient" => $user->email, 
							"sender" => AppGlobals::EMAIL_RESERVATION_REQUEST_SENDER,
							"subject" => "Your reservation at " . $venue->name . " has been requested.",
							"view" => "soup::email.request_reservation",
							"view_properties" => [
									"reservation" => $reservation,
									"user" => $user,
									"venue" => $venue,
							]
						]);
						$this->dispatch($emailJob);
						
						//BACKEND NOTIFICATION
						//send reservation notification email (sent via queue to avoid delay loading next page)
						$emailJob = new SendEmailJob([
							"recipient" => AppGlobals::EMAIL_RESERVATION_NOTIFICATION_RECIPIENT, 
							"sender" => AppGlobals::EMAIL_RESERVATION_NOTIFICATION_SENDER,
							"subject" => AppGlobals::EMAIL_RESERVATION_NOTIFICATION_SUBJECT,
							"view" => "soup::email.reservation_notification",
							"view_properties" => [
									"reservation" => $reservation,
									"user" => $user,
									"venue" => $venue,
							]
						]);
						$this->dispatch($emailJob);
			
			
						//show thanks page
						return Redirect::route('soup.reservation.thanks', ['reservationKey', $reservation->code]);
						
					}
					//invalid venue
					else {
						$errors = "Sorry, we can't seem to find the venue you wanted.";
						$valid = false;	
					}
				
				}
				//invalid user
				else {
					$errors = "Sorry, your user details do not seem to match.";
					$valid = false;	
				}
				
			}
			//invalid reservation
			else {
				$errors = "Sorry, your reservation appears invalid.";
				$valid = false;	
			}
			
			//invalid form
			if (!$valid) {
				return Redirect::route('soup.venue.recommendation')->withErrors($errors);	
			}
			
		} //end postReservationConfirmation()
		
		
		
		
		public function getReservationThanks() {
			
			//get page data
			$pageData = $this->dataForPage(self::FORM_RESERVATION_THANKS);
			//$pageData = $this->dataForFormId(self::FORM_RESERVATION_THANKS);
			
			//draw page
			return View::make('soup::pages.reservation.thanks')->with([
				'pageName' => 'reservation complete',
				'pageData'=> $pageData,
				'nextURL' => route('soup.venue.recommendation')
			]);
			
		} //end getReservationThanks()
		
				
				
				
		public function getReview($code) {
			
			//get page data
			$pageData = $this->dataForPage(self::FORM_RESERVATION_REVIEW);
			//$pageData = $this->dataForFormId(self::FORM_RESERVATION_REVIEW);
			
			//get reservation
			$reservation = Reservation::where('code', $code)->first();
			if ($reservation) {

				//get reservation user
				$reservationUser = $reservation->user()->first();
				if ($reservationUser) {

					//find user
					$user = Auth::guard(AppGlobals::$AUTH_GUARD)->user();
					if ($user && $user->id == $reservationUser->id) {
	
						//get venue
						$venue = $reservation->venue()->first();
						
						//draw page
						return View::make('soup::pages.reservation.review')->with([
							'pageName' => 'venue review',
							'pageData'=> $pageData,
							'reservation' => $reservation,
							'venue' => $venue,
							'nextURL' => route('soup.venue.recommendation'),
							'formURL' => route('soup.reservation.review'),
							'menuOptions' => $this->mainMenuOptions
						]);
					
					} //end if (valid user)
				
				} //end if (valid reservation user)
			
			} //end if (valid reservation

			//invalid request
			return Redirect::route('soup.venue.recommendation');
			
		} //end getReview()
				
				
				
		public function postReview() {
			
			$valid = true;
			$errors = null;
			
			//get form values
			$rating = safeArrayValue('rating', $_POST);
			$comment = safeArrayValue('comment', $_POST);
			$reservationKey = safeArrayValue('reservation', $_POST);
			
			//convert rating
			$rating = intval($rating);
			
			//validate rating
			if ($rating<=0 || $rating>5) {
				$errors = "Please rate your experience.";	
				$valid = false;
			}
						
			//valid reservation key
			else if (!$reservationKey || strlen($reservationKey)<=0) {
				$errors = "Sorry, your reservation key appears invalid.";	
				$valid = false;
			}
			
			
			//valid form
			if ($valid) {
							
				//get reservation
				$reservation = Reservation::where('code', $reservationKey)->first();
				if ($reservation) {

					//get reservation properties
					$reservationUser = $reservation->user()->first();
					$review = $reservation->review()->first();
					
					//no review made
					if (!$review) {
	
						//find user
						$user = Auth::guard(AppGlobals::$AUTH_GUARD)->user();
						if ($user && $user->id == $reservationUser->id) {
						
							//create review
							$review = new Review();
							$review->reservation = $reservation->id;
							$review->rating = $rating;
							$review->comment = $comment;
							$review->save();
							
							//TODO: show thanks page?
							return Redirect::route('soup.venue.recommendation');
						
						} 
						//else (invalid user)
						else {
							$errors = "Sorry, your reservation does not seem to match your user profile.";	
						}
					
					}
					//else (review already exists)
					else {
						$errors = "It looks like you have already written a review.";	
					}
					
				} 
				//else (invalid reservation)
				else {
					$errors = "Sorry, your reservation details appear invalid.";	
				}
			
			} //end if (valid form)
			
			
			//form has errors
			return Redirect::back()
						->withInput()
						->withErrors($errors);
			
		} //end postReview()
				
				
				
				
		public function getGuide($page) {
			
			//get page data
			$guideData = $this->dataForPage(self::FORM_GUIDE);
			//$pageData = $this->dataForFormId(self::FORM_GUIDE);

			//convert page ID
			$page = $page && strlen($page)>0 ? intval($page) : 0;
			
			//get page data
			$pageData = null;
			$totalPages = 0;
			if ($guideData && $guideData['children'] && count($guideData['children'])>0) {
				
				if (array_key_exists($page, $guideData['children'])) {
				//if ($page>=0 && $page<count($guideData['children'])) {
					$pageData = $guideData['children'][$page];	
				}
				
				//get total pages
				$totalPages = count($guideData['children']);
			}
			
			//draw page
			return View::make('soup::pages.guide.info')->with([
				'pageName' => 'guide' . $page,
				'pageData'=> $pageData,
				'nextURL' => route('soup.venue.recommendation'),
				'backURL' => $page>0 ? route('soup.guide', ['page' => ($page-1)]) : null,
				'formURL' => route('soup.guide', ['page'=>$page]),
				'menuOptions' => $this->mainMenuOptions,
				'step' => intval($page) + 1,
				'totalSteps' => $totalPages
			]);
			
		} //end getGuide()
							
					
							
		public function postGuide($page) {
			
					
			//get integer Id
			$page = $page && strlen($page)>0 ? intval($page) : 0;
				
			//bounds check page
			if ($page<0) $page = 0;
			
				
			//get page data
			$guideData = $this->dataForPage(self::FORM_GUIDE);
				
			//get total pages
			$totalPages = $guideData && $guideData['children'] ? count($guideData['children']) : 0;
				
			
			//valid more pages
			if ($page<$totalPages-1) {
				return Redirect::route('soup.guide', ['page' => ($page+1)]);
			}
			//no more pages
			else {
				return Redirect::route('soup.venue.recommendation');
			}
				
				
		} //end postGuide()
			

								
	} //end class MainController


?>