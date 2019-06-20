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
	$code = isset($code) ? $code : '';

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

	<div class="page-padding-small">

		<div class="spacer-large"></div>

		{{-- title --}}
		<h1 class="no-margins title-light large color-1">{!! $title !!}</h1>
	
		<div class="spacer-small"></div>

		<h3 class="title-light no-margins color-1 size-5">{!! $subtitle !!}</h3>
		
		<div class="spacer-small"></div>

		<div class="page-padding-large">
	
			{{-- image --}}
			@if ($image && strlen($image)>0) 
				<div class="page-padding-larger">
					<img src="{{ $image }}" class="page-image" load-style="fade" load-group="page">
				</div>
			@endif
			
		</div>

		<div class="color-1 size-6">{!! $text !!}</div>

		<div class="spacer-large"></div>

		<a href="{{ route('belif.share', ['code' => $code]) }}" class="button-page button-next bg-color-2 color-1 font-3 size-6" innerclass="color-2" label="{{ $button }}">
			{{ $button }}
		</a>

		{{-- Re-verify button --}}
		<a href="{{ route('belif.reverify') }}" class="button-page color-1">
			<h4 class="button-link">{{ $buttonNo }}</h4>
		</a>

</div>

@stop
{{--------------- END CONTENT ----------------}}
