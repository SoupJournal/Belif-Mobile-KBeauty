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
?>

<div class="text-center page-padding">
	
	<div class="page-padding-tiny">

		<div class="spacer-small"></div>
	
		<div class="no-margins size-6 color-2 font-3">{!! $title !!}</div>

		<div class="spacer-tiny"></div>

		<div class="no-margins font-7 color-2 size-4">{!! $subtitle !!}</div>
		
		<div class="spacer-medium"></div>

		<div class="page-padding-medium">
			<img class="page-image" src="{{ safeObjectValue('sample_image', $products[$productIdx], '') }}" load-style="fade">
		</div>

		<div class="spacer-medium"></div>

		<div class="page-padding-small font-7 color-2 size-4">{!! $text !!}</div>

		<div class="spacer-small">
	
		@if ($restartURL)
		<a href="{{ $restartURL }}" class="button-page button-next bg-color-12 color-2 font-3" innerclass="color-2" label="{{ $buttonNo }}">
			{{ $buttonNo }}
		</a>
		@else
		<a href="https://seph.me/2M8ae0S" class="button-page button-next bg-color-12 color-2 font-3" innerclass="color-2" label="{{ $button }}">
			{{ $button }}
		</a>
		@endif

		<div class="spacer-small"></div>

	</div>	

</div>

@stop
{{--------------- END CONTENT ----------------}}
