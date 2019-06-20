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
	$image = safeArrayValue('image', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$buttonNo = safeArrayValue('button_cancel', $pageData, "");
	
?>

<div class="text-center page-padding-small">
	
	<div class="page-padding-small">
	
		<div class="spacer-large"></div>
		<div class="spacer-large"></div>
		<div class="spacer-large"></div>

		{{-- title --}}
		<h1 class="no-margins title-bold medium color-1">{!! $title !!}</h1>
	
		<div class="spacer-large"></div>
	
		{{-- image --}}
		@if ($image && strlen($image)>0) 
			<div class="page-padding-large">
				<img src="{{ $image }}" class="page-image" load-style="fade" load-group="page">
			</div>
		@endif

		<!-- load group -->
		<div load-style="fade" load-group="page">
		
			{{-- info --}}
			<h3 class="title-light page-padding color-1">{!! $text !!}</h3>

			<div class="spacer-large"></div>

			{{-- Re-verify button --}}
			<a href="{{ route('belif.reverify') }}" class="button-page color-1">
				<h4 class="button-link">{{ $buttonNo }}</h4>
			</a>
		
		</div>
	
	</div>

	<div class="spacer-larger"></div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
