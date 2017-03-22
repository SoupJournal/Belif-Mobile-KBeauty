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
//	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$secondaryButton = safeArrayValue('secondary_button', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	
	//form submit URL
	$formURL = isset($formURL) ? $formURL : "";
	
?>

{{-- background image --}}
@include('soup::sections.background', ['backgroundImage' => $backgroundImage, 'loadGroup' => 'main'])

<div class="page-overlay bg-color-opacity-2" load-style="fade" load-group="main">

	{{ Form::open(Array('role' => 'form', 'name' => 'loginForm', 'class' => 'row-centered')) }}
	
		{{-- login page --}}
		<div class="page-container page-padding-large" style="background-color: transparent;">


			{{-- title --}}
			<h1 class="color-1">{{ $title }}</h1>
			


			{{-- enter email --}}
			<div class="form-group"> 
			
				{{ Form::email('email', null, Array ('placeholder' => 'Email', 'class' => 'page-input-text', 'tabindex' => '1', 'required' => '', 'autofocus' => '', 'auto-next-focus' => '')) }}
				
			</div>
				
				
			{{-- enter password --}}
			<div class="form-group"> 
			
				{{ Form::password('password', Array ('placeholder' => 'Create a password', 'class' => 'page-input-text', 'tabindex' => '2', 'required' => '', 'auto-next-focus' => '')) }}
				
			</div>
			
			
			{{-- confirm password --}}
			<div class="form-group"> 
			
				{{ Form::password('confirm_password', Array ('placeholder' => 'Confirm password', 'class' => 'page-input-text', 'tabindex' => '3', 'required' => '')) }}
				
			</div>
			
			
			<div class="spacer-small"></div>

		
			{{-- sign up button --}}
			<button class="button-page-round bg-color-4 color-2">{{ $button }}</button>


			<div class="spacer-medium"></div>

			
			{{-- log in button --}}
			<div>
				<a href="{{ route('soup.login') }}" class="page-link color-4">{{ $secondaryButton }}</a>
			</div>

			
			
			{{-- display form errors --}}
		    @if ($errors->has())
		    
			    <div class="spacer-small-2"></div>
		    
		        @foreach ($errors->all() as $error)
		            <div class='bg-danger alert'>{{ $error }}</div>
		        @endforeach
		        
		        <div class="spacer-small-2"></div>
		        
		    @else
				
				<div class="spacer-large"></div>
				
			@endif
			

			{{-- footer --}}
			<div>{{ $text }}</div>
			

		
		</div>
		
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
