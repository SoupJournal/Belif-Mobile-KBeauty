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
	$pageData = isset($pageData) ? $pageData : null;
	$restaurant = isset($restaurant) ? $restaurant : null;

	//get page variables
	$title = safeArrayValue('title', $pageData, null);
	$subtitle = safeArrayValue('subtitle', $pageData, null);
	$text = safeArrayValue('text', $pageData, null);
	$button = safeArrayValue('button', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");


//test
$restaurant = "XXXX RESTAURANT";
?>


{{-- background image --}}
@include('soup::sections.background', ['backgroundImage' => $backgroundImage, 'loadGroup' => 'main'])


{{-- page --}}
<div class="page-overlay" load-style="fade" load-group="main">

	<div class="page-container row-centered">

		<div class="page-padding-medium">

			<div class="spacer-small"></div>
	
	
			{{-- title --}}
			@if (isset($title))
				<h1 class="title-light small color-2">{!! $title !!}</h1>
			@endif
			
			<div class="spacer-medium"></div>
	
	
			{{-- subtitle --}}
			@if (isset($subtitle))
				<h1 class="title-light small color-2">{!! $subtitle !!}</h1>
			@endif
	
	
			@if (isset($restaurant))
				<h2 class="title-light bg-color-2 color-3">{{ $restaurant }}</h2>
			@endif
			
	
	
			<div class="spacer-medium"></div>
	
			{{-- text --}}
			@if (isset($text))
				<h1 class="title-light small color-2">{!! $text !!}</h1>
			@endif
	
	
			<div class="spacer-large"></div>
		
		</div>
		
		
		<div class="page-padding-small">
			
	
			{{-- next button --}}
			@if (isset($nextURL))
				<a href="{{ $nextURL }}" class="button-page-border bg-color-clear color-3 border-color-3">
					<h4 class="clear-header-margins">{{ $button }}</h4>
				</a>
			@endif
	
		
		</div>
	
	</div>
	
</div>

@stop
{{--------------- END CONTENT ----------------}}
