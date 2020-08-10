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

		<div class="no-margins size-7 color-2 font-3 stroke">{!! $title !!}</div>

		<div class="spacer-small"></div>

		<div class="no-margins size-4 color-14 font-9">{!! $subtitle !!}</div>

		<div class="spacer-small"></div>
	
		{{-- image --}}
		@if ($image && strlen($image)>0) 
			<div class="page-padding-large">
				<img src="{{ $image }}" class="page-image" load-style="fade" load-group="page">
			</div>
		@endif
		
		<div class="spacer-medium"></div>
		
		<!-- load group -->
		<div load-style="fade" load-group="page">
		
			{{-- info --}}
			<div class="no-margins size-5 color-14 font-7">{!! $text !!}</div>
		
			<div class="spacer-small"></div>

			{{-- Re-verify button --}}
			<a href="{{ route('belif.reverify') }}" class="button-page color-2">
				<h4 class="button-link">{!! $buttonNo !!}</h4>
			</a>
		
		</div>
	
	</div>

	<div class="spacer-larger"></div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
