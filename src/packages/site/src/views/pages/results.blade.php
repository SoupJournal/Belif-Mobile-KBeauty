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
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$buttonNo = safeArrayValue('button_cancel', $pageData, "");

	$products = isset($products) ? $products : null;
	$productIdx = isset($productIdx) ? $productIdx : 0;
	$restartURL = isset($restartURL) ? $restartURL : null;
	$sampleResult = isset($sampleResult) ? $sampleResult : null;
	$resultImage = isset($resultImage) ? $resultImage : null;
?>

<div class="text-center page-padding">
	
	<div class="page-padding-tiny">

		<div class="spacer-small"></div>
	
		<div class="no-margins size-7 color-2 font-3 stroke">{!! $title !!}</div>

		<div class="spacer-tiny"></div>

		<div class="no-margins font-7 color-14 size-4">{!! $subtitle !!}</div>
		
		<img class="page-image" src="https://soup-journal-app-storage.s3.amazonaws.com/aqualand/{{ $resultImage }}.png" load-style="fade">

		<div class="page-padding-small font-7 color-2 size-4">{!! $text !!}</div>

		<div class="spacer-small">

		@if ($sampleResult == 'page_results_a')

		<a href="{{ $restartURL }}" class="button-page button-next bg-color-14 color-2 font-3" innerclass="color-2" label="{{ $buttonNo }}">
			{{ $buttonNo }}
		</a>

		@else

		<a href="/address" class="button-page button-next bg-color-14 color-2 font-3" innerclass="color-2" label="{{ $button }}">
			{{ $button }}
		</a>

		<div class="spacer-tiny"></div>

		<a href="{{ $restartURL }}" class="button-page button-next bg-color-clear color-15 font-3" innerclass="color-2" label="{{ $buttonNo }}">
			{{ $buttonNo }}
		</a>

		@endif

		<div class="spacer-small"></div>

	</div>	

</div>

@stop
{{--------------- END CONTENT ----------------}}
