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
		<div class="spacer-large"></div>

		{{-- title --}}
		<h1 class="no-margins title-bold large color-1">{!! $title !!}</h1>

		<div class="spacer-small"></div>

		{{-- image --}}
		@if ($image && strlen($image)>0) 
			<div class="page-padding-medium">
				<img src="{{ $image }}" class="page-image" load-style="fade" load-group="page">
			</div>
		@endif

		{{-- info --}}
		<div class="page-margin-large">
			<h4 class="title-bold color-1 size-4">{!! $html !!}</h4>
		</div>
		
		<div class="spacer-medium"></div>
		
		<a href="https://sulwhasoo.attn.tv/p/landing" class="button-page-cancel button-next bg-color-clear color-1 font-3" innerclass="color-1" label="Shop & Save">
			Shop &amp; Save
		</a>

		<div class="spacer-medium"></div>

		<a href="{{ $buttonNo }}" class="button-page button-next bg-color-2 color-1 font-3 size-5" innerclass="color-2" label="{{ $button }}" image="{{ $assetPath }}/images/logo-instagram-black.png" target="_blank">
			<div class="button-instagram-icon"><img src="{{ $assetPath }}/images/logo-instagram-black.png" width="24" /> {{ $button }}</div>
		</a>

		<div class="spacer-medium"></div>
</div>

@stop
{{--------------- END CONTENT ----------------}}
