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

	<div class="page-padding-tiny">

		<div class="spacer-medium"></div>

		{{-- title --}}
		<div class="no-margins size-7 color-2 font-3 stroke">{!! $title !!}</div>

		<div class="spacer-medium"></div>

		<div class="no-margins size-4 color-14 font-9">{!! $subtitle !!}</div>
		
		<div class="spacer-medium"></div>
		
		<a href="{{ $buttonNo }}" class="button-page bg-color-14 color-2 font-3" innerclass="color-2" label="{{ $button }}" image="{{ $assetPath }}/images/logo-instagram.png" target="_blank">
			{{ $button }} <div class="button-instagram-icon"><img src="{{ $assetPath }}/images/logo-instagram.png" width="16" /></div>
		</a>

		<div class="spacer-tiny"></div>

		{{-- Cancel button --}}
		<a href="/" class="button-page-cancel button-next bg-color-clear color-15 font-3" innerclass="color-1" label="Quit Page">
			QUIT PAGE
		</a>

</div>

@stop
{{--------------- END CONTENT ----------------}}
