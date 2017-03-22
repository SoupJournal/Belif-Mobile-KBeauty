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
	
	//images
	$titleImage = "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/logo-soup-large-white.png";
	
	//form submit URL
	$formURL = isset($formURL) ? $formURL : "";
	
?>

{{-- background image --}}
@include('soup::sections.background', ['backgroundImage' => $backgroundImage, 'loadGroup' => 'main'])

<div class="page-overlay bg-color-clear"  load-style="fade" load-group="main">

	{{ Form::open(Array('role' => 'form', 'name' => 'loginForm', 'class' => '')) }}
	
		
		<div class="spacer-small"></div>
		
		{{-- title image --}}
		<img class="logo-title-image" alt="Soup" src="{{ $titleImage }}" load-style="fade">
	
	
	
		{{-- login page --}}
		<div class="page-container page-padding-medium-2">
			
			<div class="spacer-medium-3"></div>
			
		
			<h4 class="color-2">{!! $subtitle !!}</h4>
			
			
			<div class="spacer-tiny-2"></div>
			
			{{-- enter email --}}
			<div class="form-group"> 
			
				{{ Form::email('email', null, Array ('placeholder' => 'your@email.com', 'class' => 'page-input-text square no-border', 'tabindex' => '1', 'required' => '', 'autofocus' => '', 'auto-next-focus' => '')) }}
				
			</div>
			
			
			<div class="spacer-small"></div>
				
				
			{{-- enter password --}}
			<div class="form-group"> 
			
				{{ Form::password('password', Array ('placeholder' => 'password', 'class' => 'page-input-text square no-border', 'tabindex' => '2', 'required' => '')) }}
				
			</div>
			
			

			
			{{-- forgot password --}}
			<div class="form-group">
				<a href="{{ route('soup.forgot') }}" class="underline color-2">
					<h5 class="title-regular">{{ $text }}</h5>
				</a>
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
			
		</div>
		
		<div class="spacer-tiny-2"></div>
		
		<div class="page-padding-medium">
		
			{{-- log in buttons --}}
			<button class="button-page bg-color-10">
				<h4 class="clear-header-margins">{{ $button }}</h4>
			</button>
			
	{{--
			<div>or</div>
			
			<button class="button-page">{{ $secondaryButton }}</button>
	--}}
		</div>
		
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
