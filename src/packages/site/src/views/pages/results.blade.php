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

	//ensure page properties are set
	$buttonURL = isset($buttonURL) ? $buttonURL : null;
	$restartURL = isset($restartURL) ? $restartURL : '';
	$textColor = isset($textColor) ? $textColor : 'color-3';

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$html = safeArrayValue('html', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$buttonCancel = safeArrayValue('button_cancel', $pageData, "");
	
?>

<div class="text-center">
	
	<div class="container-top">
		
		<div class="row page-margin-small">
		
			<div class="spacer-medium"></div>
			<div class="spacer-small"></div>
		
			{{-- title --}}
			<h2 class="title-2 {{ $textColor }} line-height-30">{!! $title !!}</h2>
		
			<div class="spacer-large"></div>
			<div class="spacer-large"></div>
			<div class="spacer-large"></div>
			<div class="spacer-large"></div>
			<div class="spacer-medium"></div>
		
			<h4 class="title-3 {{ $textColor }} italic">{{ $subtitle }}</h4>

			<div load-style="fade" load-group="page">
		
				{{-- next button --}}
				<a href="{{ $buttonURL }}" class="button-page bg-color-3 color-2" label="{{ $button }}">
					{{ $button }}
				</a>
				
				{{-- restart --}}
				<a href="{{ $restartURL }}">
					<h4 class="title-regular color-1 box-padding">{{ $buttonCancel }}</h4>
				</a>
			
			</div>
		
			<div class="spacer-tiny"></div>
		
		</div>

	</div>

</div>

@stop

{{--------------- END CONTENT ----------------}}