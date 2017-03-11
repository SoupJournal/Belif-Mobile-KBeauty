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
	$secondaryButton = safeArrayValue('secondary_button', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	
	$titleImage = "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/logo-soup-large-white.png";
	
	//form submit URL
	$formURL = isset($formURL) ? $formURL : "";
	
?>

{{-- background image --}}
@include('soup::sections.background', ['backgroundImage' => $backgroundImage, 'loadGroup' => 'main'])

<div class="page-overlay bg-color-clear"  load-style="fade" load-group="main">

	{{ Form::open(Array('role' => 'form', 'name' => 'loginForm', 'class' => 'row-centered')) }}
	
		{{-- login page --}}
		<div class="page-container page-padding-large">
			
			{{-- <h1 class="color-2">{{ $title }}</h1> --}}
			<img class="logo-title-image" alt="Soup" src="{{ $titleImage }}" load-style="fade">
		
		
			<div class="spacer-large"></div>
			
		
			<h4 class="color-2">{{ $subtitle }}</h4>
			
			
			{{-- enter email --}}
			<div class="form-group"> 
			
				{{ Form::email('email', null, Array ('placeholder' => 'your@email.com', 'class' => 'page-input-text square no-border', 'tabindex' => '1', 'required' => '', 'autofocus' => '', 'auto-next-focus' => '')) }}
				
			</div>
				
				
			{{-- enter password --}}
			<div class="form-group"> 
			
				{{ Form::password('password', Array ('placeholder' => 'password', 'class' => 'page-input-text square no-border', 'tabindex' => '2', 'required' => '')) }}
				
			</div>
			
			
			<div class="spacer-tiny"></div>
			
			{{-- forgot password --}}
			<div class="form-group">
				<a href="#" class="underline color-2">{{ $text }}</a>
			</div>
			
			
			<div class="spacer-large"></div>
			
		
			{{-- log in buttons --}}
			<button class="button-page">{{ $button }}</button>
			
	{{--
			<div>or</div>
			
			<button class="button-page">{{ $secondaryButton }}</button>
	--}}
		</div>
		
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
