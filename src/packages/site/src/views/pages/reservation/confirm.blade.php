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
	$text = safeArrayValue('text', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$secondaryButton = safeArrayValue('secondary_button', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	

	//venue properties
	$venueId = safeObjectValue('id', $venue, "");
	$venueName = safeObjectValue('name', $venue, "");

	//reservation properties
	$reservationKey = safeObjectValue('code', $reservation, null);
	$date = safeObjectValue('date', $reservation, null);
	$reservationGuests = safeObjectValue('guests', $reservation, 0);
	$reservationTime = $date ? $date->format('g:i A') : "";
	$reservationDay = $date ? $date->format('l, F jS') : "";

	//form submit URL
	$formURL = isset($formURL) ? $formURL : "";
	
?>

{{-- background image --}}
@include('soup::sections.background', ['backgroundImage' => $backgroundImage, 'loadGroup' => 'main'])

<div class="page-overlay bg-color-clear" load-style="fade" load-group="main">

	<div class="framed-box border-color-2 stretch-to-fit">
	
			<div class="table-parent fill-height">
			
				<div class="table-center-row">

					<div class="table-center-cell">
				
					{{ Form::open(Array('role' => 'form', 'name' => 'loginForm', 'url' => $formURL)) }}
					
						<div class="page-section page-padding-small">		
						
							<div class="spacer-small"></div>
							
						
							<h1 class="title-bold small color-2">{{ $title }}</h1>
							
							
							<div class="spacer-small"></div>
							
							<h3 class="color-2">{{ $venueName }}</h3>
							
							<h3 class="title-regular color-2">
								<div>
									Dinner for {{ $reservationGuests }} {{ $reservationGuests==1 ? 'person' : 'people' }} at {{ $reservationTime }} 
								</div>
								<div>
									On {{ $reservationDay }}.
								</div>
							</h3>
							
							<div class="spacer-medium"></div>
							
							
							<div class="form-group color-2">{!! $text !!}</div>
								
								
							<div class="spacer-medium"></div>
						
						</div>
						
						<div class="page-section">		
								
							{{-- submit button --}}
							<div class="form-group"> 
								<button class="button-page-border title-bold bg-color-clear border-color-2 color-2">
									{{ $button }}
								</button>
							</div>
						
						
							<div class="spacer-tiny"></div>
							
						
							{{-- cancel button --}}
							<div class="form-group"> 
								<a href="{{ $backURL }}" class="button-page-border title-bold bg-color-clear border-color-9 color-9">
									{{ $secondaryButton }}
								</a>
							</div>
						
							<div class="spacer-large"></div>
						
						</div>
						
						
						{{-- reservation key --}}
						<input type="hidden" name="reservation" value="{{ $reservationKey }}">
						
					{{ Form::close() }}
		
				</div>
			</div>
		</div>
	
	</div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
