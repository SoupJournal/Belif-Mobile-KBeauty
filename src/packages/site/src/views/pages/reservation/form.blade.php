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
		<div class="stretch-to-fit">
			<div class="table-parent fill-height">
				
				<div class="table-center-row">

					<div class="table-center-cell">
						<h2 class="clear-header-margins uppercase color-2">{{ $venueName }}</h2>
						<h2 class="clear-header-margins capitalise title-regular color-2">{{ $venueAddress }}</h2>
					</div>
					
				</div>
				
			</div>
		</div>
	</div>
		


	{{ Form::model($reservation, Array('role' => 'form', 'name' => 'loginForm', 'url' => $formURL)) }}
	
		<div class="page-section page-padding-large">		
		
			<div class="spacer-medium"></div>
			
		
			<h4 class="color-2">{{ $title }}</h4>
			
			
			
			{{-- number of guests --}}
			<div class="form-group"> 
			
				{{ Form::number('guests', null, Array ('placeholder' => 'Number of guests', 'class' => 'page-input-text square no-border', 'tabindex' => '0', 'required' => '', 'autofocus' => '', 'auto-next-focus' => '')) }}
				
			</div>
				
				
			<h4 class="color-2">ON</h4>
				
				
			{{-- date --}}
			<div class="form-group"> 
			
				{{ Form::date('date', $date, Array ('placeholder' => 'Select available date', 'class' => 'page-input-text square no-border', 'tabindex' => '1', 'required' => '', 'auto-next-focus' => '')) }}
				
			</div>
			
			
			<h4 class="color-2">AT</h4>
			
			
			{{-- time --}}
			<div class="form-group"> 
			
				{{ Form::time('time', $time, Array ('placeholder' => 'Select available time', 'class' => 'page-input-text square no-border', 'tabindex' => '2', 'required' => '', 'auto-next-focus' => '')) }}
				
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
		
		<div class="table-parent bg-color-2" fill-height>
			
				<div class="table-center-row">

					<div class="table-center-cell">
					
						{{-- submit button --}}
						<button class="button-page-border bg-color-clear border-color-1 color-1">{{ $button }}</button>
				
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
