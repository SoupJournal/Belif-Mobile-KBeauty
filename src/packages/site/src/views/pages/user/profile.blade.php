@extends('soup::layouts.fullscreen')


{{------------------ TITLE -------------------}}

@section('title') Soup @stop

{{---------------- END TITLE -----------------}}




{{----------------- SCRIPTS ------------------}}

@section('scripts')

	{{-- HTML::script('packages/artisan/cms/js/cms/form/form.js') --}}	
	
@stop
{{--------------- END SCRIPTS ----------------}}





{{----------------- CONTENT ------------------}}

@section('content')

<?php

	//ensure page data is set
	$user = isset($user) ? $user : null;
	$pageData = isset($pageData) ? $pageData : null;

	//get page variables
//	$title = safeArrayValue('title', $pageData, "");
//	$subtitle = safeArrayValue('subtitle', $pageData, "");
//	$text = safeArrayValue('text', $pageData, "");
//	$button = safeArrayValue('button', $pageData, "");
//	$secondaryButton = safeArrayValue('secondary_button', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	
	//images
	$titleImage = "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/logo-soup-large-white.png";
	
	
	//user properties
	$userName = fullName($user, "");
	$userAge = userAge($user);  
	$userEmail = safeObjectValue('email', $user, "");
	$userPhone = safeObjectValue('phone', $user, "");
	$userAddress = fullAddress($user);
	
	//profile properties
	$diets = isset($diets) ? $diets : null;
	$allergies = isset($allergies) ? $allergies : null;
	$favouriteMeal = isset($favouriteMeal) ? $favouriteMeal : null;
	$morningRoutine = isset($morningRoutine) ? $morningRoutine : null;
	$drinkPreference = isset($drinkPreference) ? $drinkPreference : null;
	$locations = isset($locations) ? $locations : null;
	$favouriteCuisine = isset($favouriteCuisine) ? $favouriteCuisine : null;
	$favouriteRestaurant = isset($favouriteRestaurant) ? $favouriteRestaurant : null;
	$restaurantQualities = isset($restaurantQualities) ? $restaurantQualities : null;
	
	
	//diet images
	$dietImages = [
		'PESCATARIAN' => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/icon_diet_vegetarian.png",
		'VEGETARIAN' => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/icon_diet_vegetarian.png",
		'GLUTEN' => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/icon_diet_gluten.png",
		'VEGAN' => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/icon_diet_vegan.png"
	];
	
//	$diets = ['veg', 'gluten', 'vegan'];
//	$allergies = "asdf asdf asdf asdf";
//	$favouriteMeal = "test";
//	$morningRitual = "test";
//	
//	$hangOuts = "test";
//	$favouriteCuisine = "test";
//	$favouriteRestaurant = "test";

?>

<div class="main-page-container fill-height bg-color-8">
	
	{{-- header --}}
	<div class="header navbar navbar-top bg-color-8">
	
		<img class="profile-header-image" alt="Soup" src="{{ $backgroundImage }}" load-style="fade">
	
		<div class="table-parent">
	
			<div class="table-center-row">
		
			
				<div class="table-center-cell header-column-left">
				
					{{-- back button --}}
					@if (isset($backURL))
						<a href="{{ $backURL }}" class="button-header button-back color-2">BACK</a>
					@endif
			
				</div>
			
			
				<div class="table-center-cell header-column-center text-center">
			
				
				</div>
			   	
			   	
			   	
			   	<div class="table-center-cell header-column-right">
				
				</div>
			
			
			</div>
	
		</div>
	
	</div>
	
	
	
	<div class="page-body text-center bg-color-8">				
	
		{{-- details section --}}
		<div class="page-container page-padding-small">
			
			
			{{-- name, age --}}
			<h1 class="color-2">{{ ucwords($userName) }}, {{ $userAge }}</h1>
	
	
			<div class="spacer-small"></div>
			
		
			{{-- diets --}}
			@if (isset($diets)) 
				<div class="form-group">
					<?php
					
						$dietValue = null;
						$dietImage = null;
						foreach($diets as $diet) {
							
							//get diet value
							//$dietValue = safeObjectValue('value', $diet);
							//if ($dietValue && strlen($dietValue)>0) {
							
							//get icon image
							$dietImage = array_key_exists($diet, $dietImages) ? $dietImages[$diet] : "";
							
					?>
					
								<div class="profile-diet-container">
									<!-- div class="diet-icon-box" -->
										<img src="{{ $dietImage }}" class="image-diet-icon">
									<!-- /div -->
									<h4 class="color-2">{{ $diet }}</h4>
								</div>
							
					<?php
							//} //end if (valid value)
					
						} //end for()
					?>		
				</div>
			@endif
		
			{{-- allergies --}}
			@if (isset($allergies)) 
				<div class="form-group color-2">
					<span>Allergies: </span><span>{{ $allergies }}</span>
				</div>
			@endif
		
		
			<div class="spacer-tiny"></div>
			
		</div>
		
		<div class="page-container page-padding-large">
			
		
			{{-- email --}}
			<div class="form-group">
				<div class="profile-field bg-color-7 color-2">{{ $userEmail }}</div>
			</div>
		
			{{-- phone --}}
			<div class="form-group">
				<div class="profile-field bg-color-7 color-2">{{ $userPhone }}</div>
			</div>
		
			{{-- address --}}
			<div class="form-group">
				<div class="profile-field bg-color-7 color-2">{{ $userAddress }}</div>
			</div>
		
			<div class="spacer-small"></div>
	
		</div>
	
	
		{{-- profile section --}}
		<div class="page-container page-padding-large bg-color-7">
		
			@if (isset($favouriteMeal))
				<div class="spacer-small"></div>
			
				<div class="form-group">
					<div class="color-2">Favourite meal of the day:</div>
					<div class="color-6">{{ implode(", ", $favouriteMeal) }}</div>
				</div>
			@endif
			
		
			@if (isset($morningRoutine))
				<div class="spacer-small"></div>
			
				<div class="form-group">
					<div class="color-2">Morning ritual involves:</div>
					<div class="color-6">{{ implode(", ", $morningRoutine) }}</div>
				</div>
			@endif
		
			
			@if (isset($drinkPreference))
				<div class="spacer-small"></div>
			
				<div class="form-group">
					<span class="color-2">Drinks with friends</span>
					<span class="color-6">{{ implode(", ", $drinkPreference) }}</span>
				</div>
			@endif
		
		
			@if (isset($locations))
				<div class="spacer-small"></div>
			
				<div class="form-group">
					<span class="color-2">Hangs out in </span>
					<span class="color-6">{{ implode(", ", $locations) }}</span>
				</div>
			@endif
			
			
			@if (isset($favouriteCuisine))
				<div class="spacer-small"></div>
				
				<div class="form-group">
					<div class="color-2">Favourite cuisine (ever):</div>
					<div class="color-6">{{ $favouriteCuisine }}</div>
				</div>
			@endif
		
		
			@if (isset($favouriteRestaurant))
				<div class="spacer-small"></div>
				
				<div class="form-group">
					<div class="color-2">Favourite restaurant in NYC is:</div>
					<div class="color-6">{{ $favouriteRestaurant }}</div>
				</div>
			@endif
		
			<div class="spacer-small"></div>
		
		</div>
	
	
	
		{{-- qualities section --}}
		<div class="page-container page-padding-large bg-color-8">
		
			@if (isset($restaurantQualities))
				<div class="spacer-small"></div>
			
				<div class="color-2">Key restaurant qualities:</div>
				@foreach($restaurantQualities as $quality) 
					<div class="color-6">{{ $quality }}</div>
				@endforeach
				
				<div class="spacer-medium"></div>
			@endif
			
		</div>
	
	</div>
	
</div>

@stop
{{--------------- END CONTENT ----------------}}
