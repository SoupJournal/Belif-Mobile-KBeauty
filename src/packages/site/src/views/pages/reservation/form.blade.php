@extends('soup::layouts.master')


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
	$venue = isset($venue) ? $venue : null;
	$reservation = isset($reservation) ? $reservation : null;
	$pageData = isset($pageData) ? $pageData : null;

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
//	$subtitle = safeArrayValue('subtitle', $pageData, "");
//	$text = safeArrayValue('text', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
//	$secondaryButton = safeArrayValue('secondary_button', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	$mealType = safeArrayValue('meal_type', $pageData, null);

	//venue properties
	$profileImage = safeObjectValue('image_profile', $venue, "");
	$venueId = safeObjectValue('id', $venue, "");
	$venueName = safeObjectValue('name', $venue, "");
	$venueAddress = compilePropertiesString($venue, ['address', 'suburb'], [', ']);


	//validate pre-existing reservation
	if ($reservation && strcmp($reservation->venue, $venueId)!=0) {
		$reservation = null;
	}
	
	//get reservation properties
	$reservationKey = safeObjectValue('code', $reservation, null);
	$reservationDate = safeObjectValue('date', $reservation, null);
	$date = $reservationDate ? $reservationDate->format('m/d/Y') : null;
	$time = $reservationDate ? $reservationDate->format('g:i A') : null;

	//guest options
	$guestOptions = [1, 2];

	//form submit URL
	$formURL = isset($formURL) ? $formURL : "";
	
?>

{{-- background image --}}
@include('soup::sections.background', ['backgroundImage' => $backgroundImage, 'loadGroup' => 'main'])

<div class="page-overlay bg-color-clear"  load-style="fade" load-group="main">

	<div class="reservation-image-section">
		<div class="stretch-to-fit">
			<img class="reservation-title-image" alt="{{ $venueName }}" src="{{ $profileImage }}" load-style="fade">
		</div>
		<div class="stretch-to-fit page-padding-medium">
			<div class="table-parent fill-height">
				
				<div class="table-center-row">

					<div class="table-center-cell">
						<h2 class="clear-header-margins uppercase bold color-2">{{ $venueName }}</h2>
						<h2 class="clear-header-margins capitalise bold title-light color-2">{{ $venueAddress }}</h2>
					</div>
					
				</div>
				
			</div>
		</div>
	</div>
		


	{{ Form::model($reservation, Array('role' => 'form', 'name' => 'loginForm', 'url' => $formURL)) }}
	
		<div class="page-section page-padding-small">		
		
			<h2 class="color-2">
				<div>{{ $title }}</div>
				@if (isset($mealType))
					<div class="spacer-tiny"></div>
					<div class="uppercase">{{ $mealType }}</div>
				@endif
			</h2>
			
		</div>
		
		
		<div class="page-section page-padding-large">		
			
			{{-- number of guests --}}
			<div class="form-group"> 
			
				{{ Form::select('guests', $guestOptions, null, Array ('placeholder' => 'Number of guests', 'class' => 'page-input-select page-input-center square no-border input-padding-tiny input-clear-top-margin small', 'tabindex' => '0', 'required' => '', 'autofocus' => '', 'auto-next-focus' => '')) }}
				
			</div>
				
				
			<h2 class="margin-tiny clear-header-margins color-2">ON</h2>
				
				
			{{-- date --}}
			<div class="form-group"> 
			
				{{ Form::date('date', $date, Array ('placeholder' => 'Select available date', 'class' => 'page-input-text square no-border page-input-center input-padding-tiny input-clear-top-margin', 'tabindex' => '1', 'required' => '', 'auto-next-focus' => '')) }}
				
			</div>
			
			
			<h2 class="margin-tiny clear-header-margins color-2">AT</h2>
			
			
			{{-- time --}}
			<div class="form-group"> 
			
				{{ Form::time('time', $time, Array ('placeholder' => 'Select available time', 'class' => 'page-input-text square no-border page-input-center input-padding-tiny input-clear-top-margin', 'tabindex' => '2', 'required' => '', 'auto-next-focus' => '')) }}
				
			</div>
			
			
			{{-- display form errors --}}
		    @if ($errors->has())
		    
			    <div class="spacer-tiny"></div>
		    
		        @foreach ($errors->all() as $error)
		            <div class='bg-danger alert'>{{ $error }}</div>
		        @endforeach
		        
		        <div class="spacer-tiny"></div>
		        
		    @else
				
				<div class="spacer-medium"></div>
				
			@endif
		
		</div>
		
		<div class="page-section bg-color-2" fill-height>
			<div class="reservation-arrow-box">
				<div class="">
					<div class="arrow-down"></div>
				</div>
			</div>
		
			<div class="stretch-to-fit">
				<div class="table-parent fill-height">
									
					<div class="table-center-row">
		
						<div class="table-center-cell">
						
							{{-- submit button --}}
							<button class="button-page-border bg-color-clear border-color-1 color-1 border-thin">
								<h4 class="clear-header-margins">{{ $button }}</h4>
							</button>
					
						</div>
					
					</div>		
		
				</div>
			</div>
		</div>
		
		
		{{-- venue ID --}}
		<input type="hidden" name="venue" value="{{ $venueId }}">

		{{-- reservation ID --}}
		<input type="hidden" name="reservation" value="{{ $reservationKey }}">		
		
		
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}