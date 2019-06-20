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
	$text = safeArrayValue('text', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$buttonNo = safeArrayValue('button_cancel', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	
?>

<div class="text-center page-padding">
	
	<div class="page-padding-tiny">

		<div class="spacer-large"></div>
		<div class="spacer-large"></div>
		<div class="spacer-medium"></div>
	
		{{-- title --}}
		<h1 class="no-margins title-bold medium color-1">{!! $title !!}</h1>

		<div class="spacer-small"></div>
		
		<h3 class="title-light no-margins small color-1 size-5">{!! $subtitle !!}</h3>
		
		<div class="spacer-medium"></div>

		{{-- image --}}
		@if ($image && strlen($image)>0) 
			<div class="page-padding-large">
				<img src="{{ $image }}" class="page-image" load-style="fade" load-group="page">
			</div>
		@endif

		<div class="spacer-large"></div>
		<div class="spacer-large"></div>

		{{-- info --}}
		<h2 class="bold color-1 font-3 box-padding">{!! $text !!}</h2>
		
		<div class="spacer-medium"></div>
	
		<a href="{{ $buttonNo }}" class="button-page button-next bg-color-2 color-1 font-3 size-5" innerclass="color-2" label="{{ $button }}" image="{{ $assetPath }}/images/logo-instagram-black.png" target="_blank">
			{{ $button }} <div class="button-instagram-icon"><img src="{{ $assetPath }}/images/logo-instagram-black.png" width="24" /></div>
		</a>

		<div class="spacer-medium"></div>

		{{-- Cancel button --}}
		<a href="/" class="button-page-cancel button-next bg-color-clear color-1 font-3" innerclass="color-1" label="Quit Page">
			QUIT PAGE
		</a>
	
	</div>	

</div>

@stop
{{--------------- END CONTENT ----------------}}
