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
	$userAddress = compilePropertiesString($user, ['address_1', 'address_2', 'city', 'state', 'zip_code', 'country'], [' ', ', ', ', ', ' ']);
	
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
		'PESCATARIAN' => "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/icon_diet_pescatarian.png",
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

		<div class="stretch-to-fit">
	
		<div class="table-parent fill-height">
	
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
				
					{{-- next button --}}
					@if (isset($nextURL))
						<a href="{{ $nextURL }}" class="button-header button-next color-2">NEXT</a>
					@endif
				
				</div>
			
			
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
							
							//get icon image
							$dietImage = safeArrayValue($diet, $dietImages, null);
							if ($dietImage && strlen($dietImage)>0) {
					?>
					
								<div class="profile-diet-container">
									<img src="{{ $dietImage }}" class="image-diet-icon">
									<h4 class="color-2">{{ $diet }}</h4>
								</div>
							
					<?php
							} //end if (valid image)
					
						} //end for()
					?>		
				</div>
			@endif
		
		</div>
		
		<div class="page-container page-padding-medium">
		
			{{-- allergies --}}
			@if (isset($allergies) && strlen($allergies)>0) 
				<div class="form-group color-2">
					<h3 class="title-regular">
						<span>Allergies: </span>
						<span>{{ $allergies }}</span>
					</h3>
				</div>
			@endif
		
		
			<div class="spacer-tiny"></div>
			

			{{-- email --}}
			@if (isset($userEmail) && strlen($userEmail)>0)
			<div class="">
				<h4 class="profile-field bg-color-7 color-2">{{ $userEmail }}</h4>
			</div>
			@endif
		
			{{-- phone --}}
			@if (isset($userPhone) && strlen($userPhone)>0)
				<div class="form-group">
					<h4 class="profile-field bg-color-7 color-2">{{ $userPhone }}</h4>
				</div>
			@endif
		
			{{-- address --}}
			@if (isset($userAddress) && strlen($userAddress)>0)
				<div class="form-group">
					<h4 class="profile-field bg-color-7 color-2">{{ $userAddress }}</h4>
				</div>
			@endif
		
			<div class="spacer-small"></div>
	
	
	
			{{-- arrow --}}
			<div class="profile-arrow-box">
				<div class="stretch-to-fit">
					<div class="arrow-up border-color-2"></div>
				</div>
			</div>
	
		</div>
	
	
		{{-- profile section --}}
		<div class="page-container page-padding-large bg-color-7">
		
			@if (isset($favouriteMeal))
				<div class="spacer-small"></div>
			
				<div class="form-group">
					<h4 class="clear-header-margins title-regular">
						<div class="color-11">Favourite meal of the day:</div>
						<div class="color-6">{{ implode(", ", $favouriteMeal) }}</div>
					</h4>
				</div>
			@endif
			
		
			@if (isset($morningRoutine))
				<div class="spacer-small"></div>
			
				<div class="form-group">
					<h4 class="clear-header-margins title-regular">
						<div class="color-11">Morning ritual involves:</div>
						<div class="color-6">{{ implode(", ", $morningRoutine) }}</div>
					</h4>
				</div>
			@endif
		
			
			@if (isset($drinkPreference))
				<div class="spacer-small"></div>
			
				<div class="form-group">
					<h4 class="clear-header-margins title-regular">
						<div class="color-11">Drinks with friends:</div>
						<div class="color-6">{{ implode(", ", $drinkPreference) }}</div>
					</h4>
				</div>
			@endif
		
		
			@if (isset($locations))
				<div class="spacer-small"></div>
			
				<div class="form-group">
					<h4 class="clear-header-margins title-regular">
						<span class="color-11">Hangs out in </span>
						<span class="color-6">{{ implode(", ", $locations) }}</span>
					</h4>
				</div>
			@endif
			
			
			@if (isset($favouriteCuisine))
				<div class="spacer-small"></div>
				
				<div class="form-group">
					<h4 class="clear-header-margins title-regular">
						<div class="color-11">Favourite cuisine (ever):</div>
						<div class="color-6">{{ $favouriteCuisine }}</div>
					</h4>
				</div>
			@endif
		
		
			@if (isset($favouriteRestaurant))
				<div class="spacer-small"></div>
				
				<div class="form-group">
					<h4 class="clear-header-margins title-regular">
						<div class="color-11">Favourite restaurant in NYC is:</div>
						<div class="color-6">{{ $favouriteRestaurant }}</div>
					</h4>
				</div>
			@endif
		
			<div class="spacer-small"></div>
		
		
		
			{{-- arrow --}}
			<div class="profile-arrow-box">
				<div class="stretch-to-fit">
					<div class="arrow-up border-color-8"></div>
				</div>
			</div>
		
		</div>
	
	
	
		{{-- qualities section --}}
		<div class="page-container page-padding-large bg-color-8">
		
			@if (isset($restaurantQualities))
				<div class="spacer-small"></div>
			
				<h4 class="clear-header-margins title-regular">
				
					<div class="color-2">Key restaurant qualities:</div>
					@foreach($restaurantQualities as $quality) 
						<div class="color-6">{{ $quality }}</div>
					@endforeach
					
				</h4>
				
				<div class="spacer-medium"></div>
			@endif
			
		</div>
	
	</div>
	
</div>

@stop
{{--------------- END CONTENT ----------------}}
