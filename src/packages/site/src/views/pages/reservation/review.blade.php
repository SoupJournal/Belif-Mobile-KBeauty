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
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
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

	//guest options
	$guestOptions = [1 => 1, 2 => 2];

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
	
	
		<div class="spacer-small"></div>
		
	
		<div class="page-section page-padding-small">		
		
			{{-- title --}}
			<h2 class="medium color-2">{{ $title }}</h2>
			
			
			<div class="spacer-tiny"></div>
			
			
			{{-- star rating --}}
			@include('soup::sections.rating', [])
			
			
			<div class="spacer-tiny"></div>
			
			
			{{-- subtitle --}}
			<h2 class="color-2">{{ $subtitle }}</h2>
			
			<div class="spacer-tiny"></div>
			
		</div>
		
		
		<div class="page-section page-padding-large">		
			
			{{-- comments --}}
			<div class="form-group"> 
			
				{{ Form::textarea('comment', null, Array ('class' => 'page-input-text square no-border input-clear-top-margin small', 'tabindex' => '0', 'autofocus' => '', 'rows' => 4)) }}
				
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
		
	

		{{-- reservation ID --}}
		<input type="hidden" name="reservation" value="{{ $reservationKey }}">		
		
		
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
