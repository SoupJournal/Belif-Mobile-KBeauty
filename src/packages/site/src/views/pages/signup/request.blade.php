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
	//$secondaryButton = safeArrayValue('secondary_button', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	
	//form submit URL
	$formURL = isset($formURL) ? $formURL : "";
	
?>

{{-- background image --}}
@include('soup::sections.background', ['backgroundImage' => $backgroundImage, 'loadGroup' => 'main'])

<div class="page-overlay bg-color-opacity-2" load-style="fade" load-group="main">

	{{ Form::open(Array('role' => 'form', 'name' => 'loginForm', 'class' => 'row-centered')) }}
	
		{{-- login page --}}
		<div class="page-container page-padding-medium" style="background-color: transparent;">

			{{-- title --}}
			<h1 class="color-1">{{ $title }}</h1>
			<h4 class="clear-header-margins title-regular large color-1">{{ $subtitle }}</h4>
			<h4 class="clear-header-margins large color-1">{{ $text }}</h4>
			

			<div class="spacer-medium"><div>
			

			{{-- instagram --}}
			<div class="form-group"> 
			
				{{ Form::text('instagram', null, Array ('placeholder' => '@Instagram', 'class' => 'page-input-text input-padding-small small-margin', 'tabindex' => '1', 'autofocus' => '', 'auto-next-focus' => '')) }}
				
			</div>
				
				
			{{-- snapchat --}}
			<div class="form-group"> 
			
				{{ Form::text('snapchat', null, Array ('placeholder' => '@Snapchat', 'class' => 'page-input-text input-padding-small small-margin', 'tabindex' => '2', 'auto-next-focus' => '')) }}
				
			</div>
			
			
			{{-- zip code --}}
			<div class="form-group"> 
			
				{{ Form::number('zip_code', null, Array ('placeholder' => 'Zipcode*', 'class' => 'page-input-text input-padding-small small-margin', 'tabindex' => '3', 'required' => '')) }}
				
			</div>
			
		
			
			
			{{-- display form errors --}}
		    @if ($errors->has())
		    
		        @foreach ($errors->all() as $error)
		            <div class='bg-danger alert'>{{ $error }}</div>
		        @endforeach
		        
		    @else
				
				<div class="spacer-large"></div>
				
			@endif
			

			{{-- sign up button --}}
			<button class="button-page-round bg-color-6 color-2">
				<div class="spacer-miniscule"></div>
				<h4 class="clear-header-margins">{{ $button }}</h4>
				<div class="spacer-miniscule"></div>
			</button>


			<div class="spacer-medium"></div>
			<div class="spacer-tiny"></div>

		
		</div>
		
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
