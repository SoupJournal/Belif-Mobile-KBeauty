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

	{{ Form::open(Array('role' => 'form', 'name' => 'shareForm', 'url' => $formURL)) }}

	<div class="page-padding-small">

		<div class="spacer-large"></div>
		<div class="spacer-large"></div>
		<div class="spacer-medium"></div>

		{{-- title --}}
		<h2 class="no-margins title-bold medium color-1">{!! $title !!}</h2>
	
		<div class="spacer-small"></div>

		<h3 class="title-light no-margins color-1">{!! $subtitle !!}</h3>
		
		<div class="spacer-small"></div>

		{{-- enter email --}}
		<div class="form-group page-padding-small"> 
		
			{{ Form::email('email', null, Array ('placeholder' => 'yourfriend@email.com', 'class' => 'page-input-text color-1', 'tabindex' => '1',  'autofocus' => '', 'auto-next-focus' => '')) }}
			
		</div>
	
		{{-- display form errors --}}
	    @if ($errors->has())
	        @foreach ($errors->all() as $error)
	            <div class='bg-danger alert'>{{ $error }}</div>
	        @endforeach
	    @else
	   	 	<div class="spacer-small-2"></div>
	    @endif

		{{-- image --}}
		@if ($image && strlen($image)>0) 
			<div class="page-padding">
				<img src="{{ $image }}" class="page-image" load-style="fade" load-group="page">
			</div>
		@endif

		{{-- submit button --}}
		<button class="button-page button-next bg-color-2 color-1 font-3 size-6" label="{{ $button }}">
			{{ $button }}
		</button>

		{{-- Re-verify button --}}
		<a href="{{ route('belif.thanks') }}" class="button-page color-1">
			<h4 class="button-link">{{ $buttonNo }}</h4>
		</a>
		
{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
