@extends('belif::layouts.master')

{{------------------ TITLE -------------------}}

@section('title') Belif @stop

{{---------------- END TITLE -----------------}}

{{----------------- SCRIPTS ------------------}}

@section('scripts')

	{{-- HTML::script('packages/artisan/cms/js/cms/form/form.js') --}}	
	
@stop

{{--------------- END SCRIPTS ----------------}}

{{----------------- CONTENT ------------------}}

@section('content')

<?php

	$formURL = isset($formURL) ? $formURL : '';

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$buttonNo = safeArrayValue('button_cancel', $pageData, "");
	
?>

{{ Form::open(Array('role' => 'form', 'name' => 'emailForm', 'url' => $formURL)) }}

<div class="text-center page-padding-small" id="modalContainer">
		
	<div class="spacer-small-2"></div>
	<div class="spacer-tiny"></div>
	
	<div class="page-padding-small">
	
		{{-- title --}}
		<h2 class="title-4 color-2 page-padding-medium-2">{{ $title }}</h2>	
		<h5 class="title-4 color-2 italic">{{ $subtitle }}</h5>

		<div class="spacer-large"></div>
		<div class="spacer-large"></div>
		<div class="spacer-large"></div>
		<div class="spacer-large"></div>
		<div class="spacer-small"></div>
		
		<div load-style="fade" load-group="page">
	
			{{-- enter email --}}
			<div class="form-group"> 
				{{ Form::email('share_email', null, Array ('placeholder' => 'your@email.com', 'class' => 'page-input-text large no-border color-4 white-background', 'tabindex' => '1', 'required' => '', 'auto-next-focus' => '')) }}
			</div>

			{{-- info --}}
			<h4 class="title-light color-2 page-padding">{{ $text }}</h4>
			
			{{-- submit button --}}
			<button class="button-page bg-color-1 color-2" label="{{ $button }}">
				{{ $button }}
			</button>
		
			{{-- Re-verify button --}}
			<a href="{{ route('belif.home') }}" class="button-page color-1">
				<h4 class="button-link">{{ $buttonNo }}</h4>
			</a>
		
		</div>
	
	</div>

	<div class="spacer-larger"></div>

</div>

{{ Form::close() }}

@stop

{{--------------- END CONTENT ----------------}}
