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
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	
?>

{{-- background image --}}
<img class="page-image" src="{{ $backgroundImage }}" load-style="fade">

<div class="page-overlay bg-color-opacity-2">

	{{ Form::open(Array('role' => 'form', 'name' => 'loginForm', 'class' => 'row-centered')) }}
	
		{{-- login page --}}
		<div class="page-container page-padding-large">


			{{-- title --}}
			<h1>{{ $title }}</h1>
			
			
			{{-- description --}}
			<h4>{!! $subtitle !!}</h4>
			



			{{-- enter name --}}
			<div class="form-group"> 
			
				{{ Form::text('code', null, Array ('placeholder' => 'Enter Invitation Code', 'class' => 'page-input-text', 'tabindex' => '1', 'required' => '', 'autofocus' => '', 'auto-next-focus' => '')) }}
				
			</div>
				
				
			<div class="spacer-medium"></div>
				
			
			{{-- membership --}}
			<div class="form-group">
	
				<h4>{!! $text !!}</div>
		
				<div class="spacer-medium"></div>
		
				<button class="button-page-round bg-color-4 color-2">{{ $button }}</button>

			</div>


			<div class="spacer-large"></div>
			

			{{-- footer --}}
			<div>{{ $subtext }}</div>
		
		</div>
		
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
