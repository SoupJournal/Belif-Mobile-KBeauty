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
	$request = isset($request) ? $request : null;

	//get page variables
	//$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	//$text = safeArrayValue('text', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	
	//get request properties
	$code = safeObjectValue('code', $request, "");
	
	//images
	$titleImage = "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/logo-soup-large-white.png";
	
	//form submit URL
	$formURL = isset($formURL) ? $formURL : "";
	
	
?>

{{-- background image --}}
@include('soup::sections.background', ['backgroundImage' => $backgroundImage, 'loadGroup' => 'main'])

<div class="page-overlay bg-color-clear" load-style="fade" load-group="main">

	{{ Form::open(Array('url' => $formURL, 'role' => 'form', 'name' => 'passwordForm', 'class' => 'row-centered')) }}
	
		{{-- title image --}}
		<img class="logo-title-image" alt="Soup" src="{{ $titleImage }}" load-style="fade">

	
		{{-- login page --}}
		<div class="page-container page-padding-medium-2" style="background-color: transparent;">		
		
			<div class="spacer-large"></div>
			
			
			{{-- subtitle --}}
			<h4 class="color-2">{!! $subtitle !!}</h4>
			

			{{-- enter password --}}
			<div class="form-group"> 
			
				{{ Form::password('password', Array ('placeholder' => 'Password', 'class' => 'page-input-text square no-border', 'tabindex' => '0', 'required' => '', 'autofocus' => '', 'auto-next-focus' => '')) }}
				
			</div>
				
				
			{{-- confirm password --}}
			<div class="form-group"> 
			
				{{ Form::password('confirm_password', Array ('placeholder' => 'Confirm Password', 'class' => 'page-input-text square no-border', 'tabindex' => '1', 'required' => '', 'auto-next-focus' => '')) }}
				
			</div>
				
			
			{{-- display form errors --}}
		    @if ($errors->has())
		    
			    <div class="spacer-small"></div>
		    
		        @foreach ($errors->all() as $error)
		            <div class='bg-danger alert'>{{ $error }}</div>
		        @endforeach
		        
		        
		    @else
				
				<div class="spacer-large"></div>
				
			@endif
			
			<div class="spacer-medium"></div>
			
		
			{{-- next button --}}
			<button class="button-page bg-color-10">
				<h4 class="clear-header-margins">{{ $button }}</h4>
			</button>

			

		
		</div>
		
		{{-- request key --}}
		<input type="hidden" name="code" value="{{ $code }}">
		
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
