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

	$products = isset($products) ? $products : null;
	$productIdx = isset($productIdx) ? $productIdx : 0;
	$theme = isset($theme) ? $theme : 1;
?>

<div class="text-center">

	<div class="container-top">

		<div class="spacer-large"></div>
		<div class="spacer-medium"></div>

		<div class="row page-margin-small">

			{{-- title --}}
			<h1 class="no-margins size-5 color-{{ $theme }}">Your scent result is:</h1>

			<div class="spacer-small"></div>

			<h1 class="no-margins title large color-{{ $theme }}">{!! $title !!}</h1>

			<div class="spacer-small"></div>

			<h3 class="no-margins font-4 bold color-{{ $theme }} size-6">{!! $subtitle !!}</h3>

			<div class="spacer-small"></div>

			{{-- product image --}}
			<img class="product-image" src="{{ safeObjectValue('sample_image', $products[$productIdx], '') }}" load-style="fade" load-group="product_{{ $productIdx }}">

			<div class="spacer-small"></div>

			{{-- info --}}
			<div class="page-padding-small size-5 color-{{ $theme }}">{!! $text !!}</div>

			<div class="spacer-small"></div>

			<div><a href="/address" class="button-page button-next bg-color-2 color-1 font-3 size-6" innerclass="color-2" label="{{ $button }}">
				{{ $button }}
			</a></div>

			<div class="spacer-tiny"></div>

			{{-- restart --}}
			<div><a href="{{ $restartURL }}">
				<h4 class="title-regular color-2 box-padding">{{ $buttonNo }}</h4>
			</a></div>

		</div>

	</div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
