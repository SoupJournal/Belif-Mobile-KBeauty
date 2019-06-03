@extends('belif::layouts.master')

{{------------------ TITLE -------------------}}

@section('title') Belif @stop

{{---------------- END TITLE -----------------}}

{{----------------- SCRIPTS ------------------}}

@section('scripts')

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
	$text = safeArrayValue('text', $pageData, "");
	$html = safeArrayValue('html', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$buttonNo = safeArrayValue('button_cancel', $pageData, "");
	
?>

<div class="text-center">
	
	{{ Form::open(Array('role' => 'form', 'name' => 'emailForm', 'url' => $formURL)) }}
	
		<div class="page-padding-tiny">
	
			<div class="spacer-large"></div>
			<div class="spacer-large"></div>
			<div class="spacer-small"></div>
		
			{{-- title --}}
			<h1 class="no-margins title-light large color-2">{!! $title !!}</h1>

			<div class="spacer-small"></div>

			<h2 class="no-margins title-light small color-2">{!! $subtitle !!}</h2>

			<div class="spacer-medium"></div>

			{{-- text --}}
			<img src="https://s3.amazonaws.com/soup-journal-app-storage/Sulwhasoo/star_icon.png" width="25" />

			<div class="spacer-small"></div>

			<h3 class="no-margins title-light color-2 size-6">{!! $text !!}</h3>

			<div class="spacer-small"></div>

			<p class="no-margins title-light color-2 size-4">{!! $html !!}</p>

			<div class="spacer-small"></div>

		</div>

		<!-- load group -->
		<div class="page-padding-medium" load-style="fade" load-group="page">

			{{-- enter email --}}
			<div class="form-group"> 
			
				{{ Form::email('email', null, Array ('placeholder' => 'your@email.com', 'class' => 'page-input-text large color-1', 'tabindex' => '1',  'autofocus' => '', 'auto-next-focus' => '')) }}
				
			</div>
		
			{{-- display form errors --}}
		    @if ($errors->has())
		        @foreach ($errors->all() as $error)
		            <div class='bg-danger alert'>{{ $error }}</div>
		        @endforeach
		    @else
		   	 	<div class="spacer-small-2"></div>
		    @endif
		
			{{-- submit button --}}
			<button class="button-page bg-color-1 color-2 font-3" label="{{ $button }}">
				{{ $button }}
			</button>
			
			{{-- Terms & Conditions --}}
			<div class="terms">
				<input type="checkbox" name="agree" value="1" /> <a href="{{ $termsURL }}" class="color-1 small" target="_blank">{{ $buttonNo }}</a>
			</div>
			
		</div>
		<!-- load group -->
		
		<div class="spacer-small"></div>
		
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
