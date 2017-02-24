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
	
	//form submit URL
	$formURL = isset($formURL) ? $formURL : "";
	
?>

<div class="text-center">

	{{ Form::open(Array('role' => 'form', 'name' => 'loginForm')) }}
	
		{{-- login page --}}
		<div class="page-container">
			
			<h1 class="color-2">{{ $title }}</h1>
		
		
			<h4 class="color-2">{{ $subtitle }}</h4>
			
			
			{{-- enter email --}}
			<div class="form-group"> 
			
				{{ Form::email('email', null, Array ('placeholder' => 'your@email.com', 'class' => 'page-input-text', 'tabindex' => '1', 'required' => '', 'autofocus' => '', 'auto-next-focus' => '')) }}
				
			</div>
				
				
			{{-- enter password --}}
			<div class="form-group"> 
			
				{{ Form::password('password', Array ('placeholder' => 'password', 'class' => 'page-input-text', 'tabindex' => '1', 'required' => '', 'autofocus' => '', 'auto-next-focus' => '')) }}
				
			</div>
			
			
			{{-- forgot password --}}
			<div class="form-group">
				<a href="#">{{ $text }}</a>
			</div>
			
		
			{{-- log in buttons --}}
			<button class="button-page">{{ $button }}</button>
			
			<div>or</div>
			
			<button class="button-page">{{ $secondaryButton }}</button>
		
		</div>
		
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
