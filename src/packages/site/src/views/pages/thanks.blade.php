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

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$buttonNo = safeArrayValue('button_cancel', $pageData, "");
	
?>

<div class="text-center page-padding-medium" id="modalContainer">
		
	<div class="spacer-medium"></div>
	<div class="spacer-medium"></div>
	
	{{-- title --}}
	<h2 class="title-4 color-2 page-padding-small line-height-30">{!! $title !!}</h2>
	<h5 class="title-4 color-2 italic">{{ $subtitle }}</h5>

	<div class="spacer-large"></div>
	<div class="spacer-large"></div>
	<div class="spacer-medium"></div>

	<h2 class="color-1 line-height-30">{!! $text !!}</h2>

	<div class="spacer-small-2"></div>

	{{-- Next button --}}
	<a href="{{ $buttonURL }}" class="button-page bg-color-1 color-2" label="{{ $button }}">
		<img src="/belif/mobile/images/logo-instagram.png" border="0" class="icon-instagram-button" />
		{{ $button }}
	</a>

	{{-- Cancel button --}}
	<a href="{{ route('belif.home') }}" class="button-page color-1">
		<h5 class="button-link">{{ $buttonNo }}</h5>
	</a>
		
</div>

@stop
{{--------------- END CONTENT ----------------}}
