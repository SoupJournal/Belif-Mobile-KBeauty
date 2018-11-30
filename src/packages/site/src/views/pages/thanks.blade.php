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

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$html = safeArrayValue('html', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$buttonNo = safeArrayValue('button_cancel', $pageData, "");
	
?>

<div class="text-center">

	<div class="page-padding-small">
	
		<div class="spacer-large"></div>

		{{-- title --}}
		<h2 class="no-margins title-bold medium color-1">{!! $title !!}</h2>
	
		<div class="spacer-small"></div>

		<h3 class="title-light no-margins color-1">{!! $subtitle !!}</h3>
		
		<div class="spacer-small"></div>

		{{-- image --}}
		@if ($image && strlen($image)>0) 
			<div class="page-padding-medium">
				<img src="{{ $image }}" class="page-image" load-style="fade" load-group="page">
			</div>
		@endif

		{{-- info --}}
		<div class="page-margin-large">
			<h4 class="title-light color-1 large">{!! $html !!}</h4>
		</div>
		
		
		<div class="spacer-large"></div>
		<div class="spacer-medium"></div>
		
		<a href="{{ $buttonNo }}" class="button-page button-next bg-color-1 color-2 font-3" innerclass="color-2" label="{{ $button }}" image="{{ $assetPath }}/images/logo-instagram.png" target="_blank">
			{{ $button }} <div class="button-instagram-icon"><img src="{{ $assetPath }}/images/logo-instagram.png" width="16" /></div>
		</a>

		<div class="spacer-tiny"></div>

		{{-- Cancel button --}}
		<a href="/" class="button-page-cancel button-next bg-color-2 color-1 font-3" innerclass="color-1" label="Quit Page">
			QUIT PAGE
		</a>

</div>

@stop
{{--------------- END CONTENT ----------------}}
