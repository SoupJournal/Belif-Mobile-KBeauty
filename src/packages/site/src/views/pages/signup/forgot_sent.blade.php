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

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	
	//images
	$titleImage = "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/logo-soup-large-white.png";
	
	//form submit URL
	$formURL = isset($formURL) ? $formURL : "";
	
?>

{{-- background image --}}
@include('soup::sections.background', ['backgroundImage' => $backgroundImage, 'loadGroup' => 'main'])

<div class="page-overlay bg-color-clear" load-style="fade" load-group="main">

	{{ Form::open(Array('role' => 'form', 'name' => 'loginForm', 'class' => 'row-centered')) }}
	
		{{-- login page --}}
		<div class="page-container page-padding-large" style="background-color: transparent;">


			<img class="logo-title-image" alt="Soup" src="{{ $titleImage }}" load-style="fade">
		
		
			<div class="spacer-large"></div>
			
			
			{{-- subtitle --}}
			<h4 class="color-2">{!! $subtitle !!}</h4>
			

			<div class="spacer-large"></div>
			<div class="spacer-medium"></div>
			
		
			{{-- next button --}}
			<button class="button-page">{{ $button }}</button>

			

		
		</div>
		
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
