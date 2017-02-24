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
//	$secondaryButton = safeArrayValue('secondary_button', $pageData, "");
	
	//form submit URL
	$formURL = isset($formURL) ? $formURL : "";
	
?>

<div class="text-center">

	{{ Form::open(Array('role' => 'form', 'name' => 'loginForm')) }}
	
		{{-- login page --}}
		<div class="page-container">


			{{-- title --}}
			<h1>{{ $title }}</h1>
			
			
			{{-- TODO: show user name --}}


			{{-- enter name --}}
			<div class="form-group"> 
			
				{{ Form::text('name', null, Array ('placeholder' => 'Full Name', 'class' => 'page-input-text', 'tabindex' => '1', 'required' => '', 'autofocus' => '', 'auto-next-focus' => '')) }}
				
			</div>
				
				
			{{-- enter birth date --}}
			<div class="form-group"> 
			
				{{ Form::date('birth_date', null, Array ('placeholder' => 'Date of Birth (MM/DD/YYYY)', 'class' => 'page-input-text', 'tabindex' => '2', 'required' => '', 'autofocus' => '', 'auto-next-focus' => '')) }}
				
			</div>
			
			
			
			{{-- enter gender --}}
			<div class="form-group"> 
				{{ Form::radio('gender', 'Female', false, Array ('class' => 'page-input-radio')) }}
				{{ Form::label('female', 'Female', Array('class' => 'color-2')) }}
				
				{{ Form::radio('gender', 'Male', false, Array ('class' => 'page-input-radio')) }}
				{{ Form::label('male', 'Male', Array('class' => 'color-2')) }}
				
				{{ Form::radio('gender', 'Other', false, Array ('class' => 'page-input-radio')) }}
				{{ Form::label('other', 'Other', Array('class' => 'color-2')) }}
			</div>
			

		
			{{-- join buttons --}}
			<button class="button-page">{{ $button }}</button>


			{{-- footer --}}
			<div>{{ $text }}</div>
		
		</div>
		
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
