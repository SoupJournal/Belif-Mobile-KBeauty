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

	$formURL = isset($formURL) ? $formURL : '';

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$buttonNo = safeArrayValue('button_cancel', $pageData, "");
	
?>

<div class="text-center page-padding-small" id="modalContainer">
	
	<div class="spacer-medium"></div>

	<div class="page-padding-small">
	
		{{-- title --}}
		<h2 class="title-1 color-1 page-padding-medium">{{ $title }}</h2>	
		<h5 class="title-4 color-1 italic page-padding-medium-2">{{ $subtitle }}</h5>

		<div class="spacer-large"></div>
		<div class="spacer-large"></div>
		<div class="spacer-large"></div>
		<div class="spacer-large"></div>
		
		<div load-style="fade" load-group="page">
	
			<h2 class="title-1 color-1 page-padding">{{ $text }}</h2>
			
			<a href="{{ route('belif.verify') }}?resend=true" class="button-page color-1">
				<h5 class="button-link">{!! $buttonNo !!}</h5>
			</a>
		
		</div>
	
	</div>

</div>

@stop

{{--------------- END CONTENT ----------------}}
