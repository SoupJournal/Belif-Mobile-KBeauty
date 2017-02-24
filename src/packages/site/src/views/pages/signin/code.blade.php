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
	$subtext = safeArrayValue('subtext', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
//	$secondaryButton = safeArrayValue('secondary_button', $pageData, "");
	
?>

<div class="text-center">

	{{ Form::open(Array('role' => 'form', 'name' => 'loginForm')) }}
	
		{{-- login page --}}
		<div class="page-container">


			{{-- title --}}
			<h1>{{ $title }}</h1>
			
			
			{{-- description --}}
			<h4>{{ $subtitle }}</h4>
			



			{{-- enter name --}}
			<div class="form-group"> 
			
				{{ Form::text('code', null, Array ('placeholder' => 'Enter Invitation Code', 'class' => 'page-input-text', 'tabindex' => '1', 'required' => '', 'autofocus' => '', 'auto-next-focus' => '')) }}
				
			</div>
				
			
			{{-- membership --}}
			<div class="form-group">
	
				<h4>{{ $text }}</div>
		
				<button class="button-page">{{ $button }}</button>

			</div>


			{{-- footer --}}
			<div>{{ $subtext }}</div>
		
		</div>
		
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
