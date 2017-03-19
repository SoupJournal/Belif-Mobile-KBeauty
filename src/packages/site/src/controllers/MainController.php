<?php

	namespace Soup\Mobile\Controllers;

	use Soup\Mobile\Controllers\BaseController;
	use Soup\Mobile\Models\SoupUser;
	use Soup\Mobile\Models\UserProfile;
	use Soup\Mobile\Models\Question;
	use Soup\Mobile\Models\Venue;
	use Soup\Mobile\Models\VenueOpenHours;
	use Soup\Mobile\Models\Reservation;
	use Soup\Mobile\Lib\AppGlobals;
	
	use View;
	use Redirect;
	use Illuminate\Support\Facades\Auth;
	
	use Carbon\Carbon;

	class MainController extends BaseController {
		

		//set menu options
		private $mainMenuOptions = null;


		public function __construct() {

			//set menu options
			$this->mainMenuOptions = [
				[
					'name' => 'Profile',
					'url' => route('soup.user.profile')
				],
				[
					'name' => 'How It Works',
				//	'url' => route('soup.user.profile')
				],
				[
					'name' => 'Blog',
				//	'url' => route('soup.user.profile')
				],
				[
					'name' => 'Help',
				//	'url' => route('soup.user.profile')
				],
				[	
					'type' => 'spacer'
				],
				[
					'name' => 'LOG OUT',
					'url' => route('soup.logout'),
					'class' => 'button-page-border border-color-9 color-9'
				]
			];

		} //end constructor()
		
		

		//==========================================================//
		//====						USER						====//
		//==========================================================//	
	
	
	
		public function getUserProfile() {
		//	\DB::connection('Soup')->enableQueryLog();
			
			//get page data
			$pageData = $this->dataForFormId(self::FORM_USER_PROFILE);
			
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
				'user' => $user,
				'dinnerVenue' => $dinnerVenue,
				'brunchVenue' => $brunchVenue,
				'showMenuButton' => true,
				'menuOptions' => $this->mainMenuOptions
				//'pageData'=> $pageData,
				//'nextURL' => route('soup.question'),
				//'backURL' => route('soup.welcome'),
			]);
			
		} //end getVenueRecommendations()
	
	
	
		public function getVenueProfile($venueId) {
			
			//get page data
			$pageData = $this->dataForFormId(self::FORM_VENUE_PROFILE);
			
			//get venue data
			$venueData = Venue::find($venueId);
			
			//draw page
			return View::make('soup::pages.venue.profile')->with([
				'pageData'=> $pageData,
				//'nextURL' => route('soup.question'),
				'backURL' => route('soup.venue.recommendation'),
				'venue' => $venueData,
				'mapsKey' => AppGlobals::GOOGLE_API_KEY
			]);
			
		} //end getVenueProfile()
	
	
	
	
	
	
		public function getReservation($venueId, $reservationKey = null) {
			
			//get page data
			$pageData = $this->dataForFormId(self::FORM_RESERVATION);
			
			//get venue data
			$venue = Venue::find($venueId);

			//get pre-existing reservation
			$reservation = null;
			if ($reservationKey && strlen($reservationKey)>0) {
				$reservation = Reservation::where('code', '=', $reservationKey)->first();
			}

			//draw page
			return View::make('soup::pages.reservation.form')->with([
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
			

			//valid venue
			if (!$venue) {
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
			
			}
			
			//form has errors
			else {
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
				$pageData = $this->dataForFormId(self::FORM_RESERVATION_CONFIRM);
				
				//get reservation
				$reservation = Reservation::where('code', '=', $reservationKey)->first();
				
				
				//validate reservation
				if ($reservation) {
				
					//get venue data
					$venueId = safeObjectValue('venue', $reservation, -1);
					$venue = null;
					if ($venueId>=0) {
						$venue = Venue::find($venueId);
					}
					else {
						$valid = false;
					}

					//valid form
					if ($valid) {
	
						//create back URL
						$backURL = route('soup.reservation.id.id', [
							'venueId' => $venueId,
							'reservationKey' => $reservation->code
						]);
	
						//draw page
						return View::make('soup::pages.reservation.confirm')->with([
							'pageData'=> $pageData,
							'venue' => $venue,
							'reservation' => $reservation,
							//'nextURL' => route('soup.question'),
							'backURL' => $backURL,
							'formURL' => route('soup.reservation.confirm')
						]);
					
					} //end if (valid form)
				
				} //end if (valid reservation)
			
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
				
				//store reservation details in session (flash)
				//\Request::session()->set('reservation', $reservation);
			
				//update reservation status
				$reservation->status = AppGlobals::RESERVATION_STATUS_REQUESTED;
				$reservation->save();
				
				//TODO: send email
	
	
				return Redirect::route('soup.reservation.thanks', ['reservationKey', $reservation->code]);
				
			}
			//invalid reservation
			else {
				return Redirect::route('soup.venue.recommendation');
			}
			
		} //end postReservationConfirmation()
		
		
		
		
		public function getReservationThanks() {
			
			//get page data
			$pageData = $this->dataForFormId(self::FORM_RESERVATION_THANKS);
			
			//draw page
			return View::make('soup::pages.reservation.thanks')->with([
				'pageData'=> $pageData,
				'nextURL' => route('soup.venue.recommendation')
			]);
			
		} //end getReservationThanks()
		
								
	} //end class MainController


?>