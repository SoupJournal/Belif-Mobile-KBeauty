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
	$buttonURL = isset($buttonURL) ? $buttonURL : null;
	$formURL = isset($formURL) ? $formURL : '';

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$buttonNo = safeArrayValue('button_cancel', $pageData, "");
	
?>

<div class="text-center">

	<div class="font-1 color-2 size-3 bg-color-1">Your email has been verified!</div>

{{ Form::open(Array('role' => 'form', 'name' => 'shareForm', 'url' => $formURL)) }}

	<div class="page-padding-small">
	
		<div class="spacer-large"></div>

		{{-- title --}}
		<div class="no-margins size-6 color-2 font-3">{!! $title !!}</div>
	
		<div class="spacer-small"></div>

		<div class="no-margins size-4 color-2 font-9">{!! $subtitle !!}</div>
		
		<div class="spacer-small"></div>

		{{-- image --}}
		@if ($image && strlen($image)>0)
			<div class="page-padding">
				<img src="{{ $image }}" class="page-image" load-style="fade" load-group="page">
			</div>
		@endif

		{{-- enter email --}}
		<div class="form-group page-padding-small"> 
		
			{{ Form::email('email', null, Array ('placeholder' => 'Yourfriend@email.com', 'class' => 'page-input-text color-2', 'tabindex' => '1')) }}
			
		</div>
	
		{{-- display form errors --}}
	    @if ($errors->has())
	        @foreach ($errors->all() as $error)
	            <div class='bg-danger alert'>{{ $error }}</div>
	        @endforeach
	    @else
	   	 	<div class="spacer-small-2"></div>
	    @endif

		<div class="spacer-small"></div>

		{{-- submit button --}}
		<button class="button-page bg-color-2 color-13 font-3" label="{{ $button }}">
			{{ $button }}
		</button>

		{{-- Re-verify button --}}
		<a href="{{ route('belif.thanks') }}" class="button-page color-2">
			<h4 class="button-link">{{ $buttonNo }}</h4>
		</a>
		
{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
