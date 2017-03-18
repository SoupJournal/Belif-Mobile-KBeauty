<?php

	namespace Soup\Mobile\Controllers;

	use Soup\Mobile\Controllers\BaseController;
	use Soup\Mobile\Models\SoupUser;
	use Soup\Mobile\Models\UserProfile;
	use Soup\Mobile\Models\Question;
	use Soup\Mobile\Models\Venue;
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
			

			//dd(extractModelValues('value', $favouriteMeal));
			
			//draw page
			return View::make('soup::pages.user.profile')->with([
				'pageData'=> $pageData,
				//'nextURL' => route('soup.question'),
				//'backURL' => route('soup.welcome'),
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
			
			//get venue data
			$venueData = Venue::find($venueId);
			
			//draw page
			return View::make('soup::pages.venue.profile')->with([
				//'pageData'=> $pageData,
				//'nextURL' => route('soup.question'),
				'backURL' => route('soup.venue.recommendation'),
				'venue' => $venueData,
				'mapsKey' => AppGlobals::GOOGLE_API_KEY
			]);
			
		} //end getVenueProfile()
	
								
	} //end class SiteController


?>