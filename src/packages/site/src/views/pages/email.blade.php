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

	//ensure page properties are set
	$formURL = isset($formURL) ? $formURL : '';
	$termsURL = isset($termsURL) ? $termsURL : '';

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('html', $pageData, "");
	$emailText = safeArrayValue('text', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$buttonNo = safeArrayValue('button_cancel', $pageData, "");
	
?>

{{ Form::open(Array('role' => 'form', 'name' => 'emailForm', 'url' => $formURL)) }}

<div class="text-center">
	
	<div class="container-top">
	
		<div class="page-margin-small">
		
			<div class="spacer-medium"></div>

			{{-- title --}}
			<h2 class="title-3 color-4 uppercase">{{ $title }}</h2>	
			<h1 class="title-2 color-3 uppercase">{{ $subtitle }}</h1>

			{{-- text --}}
			<h3 class="title-3 color-4 box-padding">{!! $text !!}</h3>

		</div>	
			
		<div class="spacer-large"></div>
		<div class="spacer-large"></div>
		<div class="spacer-large"></div>
		
		<!-- load group -->
		<div class="page-padding-medium" load-style="fade" load-group="page">
			
			{{-- emailText --}}
			<h4 class="title-4 color-4 italic white-background padding-10">{!! $emailText !!}</h4>
			
			{{-- enter email --}}
			<div class="form-group"> 
				{{ Form::email('email', null, Array ('placeholder' => 'your@email.com', 'class' => 'page-input-text large no-border color-4 white-background', 'tabindex' => '1', 'required' => '', 'auto-next-focus' => '')) }}
			</div>
		
			{{-- display form errors --}}
		    @if ($errors->has())
		        @foreach ($errors->all() as $error)
		            <div class='bg-danger alert'>{{ $error }}</div>
		        @endforeach
		    @else
		   	 	<div class="spacer-tiny"></div>
		    @endif
		
			<div class="spacer-tiny"></div>
		
			{{-- submit button --}}
			<button class="button-page bg-color-3 color-2" label="{{ $button }}">
				{{ $button }}
			</button>
			
			{{-- Terms & Conditions --}}
			<div class="spacer-tiny"></div>
			<p class="terms italic"><input type="checkbox" name="agree" value="1" required /> <a href="{{ $termsURL }}" class="color-1" target="_blank">{{ $buttonNo }}</a></p>
			
		</div>
		<!-- load group -->
		
		<div class="spacer-small"></div>

</div>

{{ Form::close() }}

@stop
{{--------------- END CONTENT ----------------}}
