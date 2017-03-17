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
		

		//public function __construct() {
			

		//} //end constructor()
		
		

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
				//$profileData = UserProfile::where('user', '=', $user->id)->groupBy('question')->get();
				
				//get user profile
				$profiles = UserProfile::where('user', '=', $user->id)->select('value');
				
				//get user questions
				//$questions = Question::where('user', '=', $user->id);
				
				//get profile data properties
				//$diets = $questions->where('group', '=', 'diet')->with('profile')->get();
				$query = clone $profiles;
				$diets = $query->whereHas('question', function($subQuery) {
					$subQuery->where('group', '=', 'diet');
				})->get();
				
//				->whereHas('profile', function($fieldQuery){
//									$fieldQuery->select(['id', 'name']);
//								});
				$query = clone $profiles;
				$allergies = $query->where('question', '=', 'diet_text')->first();
				
				$query = clone $profiles;
				$favouriteMeal = $query->whereHas('question', function($subQuery) {
					$subQuery->where('group', '=', 'meal');
				})->get();
				
				$query = clone $profiles;
				$morningRoutine = $query->whereHas('question', function($subQuery) {
					$subQuery->where('group', '=', 'wake');
				})->get();
				
				$query = clone $profiles;
				$drinkPreference = $query->whereHas('question', function($subQuery) {
					$subQuery->where('group', '=', 'drink');
				})->get();
				
				$query = clone $profiles;
				$locations = $query->whereHas('question', function($subQuery) {
					$subQuery->where('group', '=', 'location');
				})->get();
				
				$query = clone $profiles;
				$favouriteCuisine = $query->where('question', '=', 'cuisine')->first();
				
				$query = clone $profiles;
				$favouriteRestaurant = $query->where('question', '=', 'favRestaurant')->first();
				
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
			
			//draw page
			return View::make('soup::pages.venue.recommendations')->with([
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
				//'backURL' => route('soup.welcome'),
				'venue' => $venueData,
				'mapsKey' => AppGlobals::GOOGLE_API_KEY
			]);
			
		} //end getVenueProfile()
	
								
	} //end class SiteController


?>