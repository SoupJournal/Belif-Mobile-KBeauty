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
?>

<div class="text-center page-padding">
	
	<div class="page-padding-tiny">

		<div class="spacer-small"></div>
	
		{{-- title --}}
		<h2 class="no-margins title-bold medium color-1">{!! $title !!}</h2>

		<h3 class="no-margins font-4 bold color-1 size-6">{!! $subtitle !!}</h3>
		
		<div class="spacer-medium"></div>

		{{-- product image --}}
		<img class="product-image" src="{{ safeObjectValue('sample_image', $products[$productIdx], '') }}" load-style="fade" load-group="product_{{ $productIdx }}">

		<div class="spacer-medium"></div>

		{{-- info --}}
		<h2 class="no-margins font-3 color-1 size-4">You'll receive</h2>
		<h2 class="no-margins title-bold medium color-1 size-7">{{ safeObjectValue('name', $products[$productIdx], '') }}</h2>
		<div class="page-padding-small size-4 color-1">{{ safeObjectValue('description', $products[$productIdx], '') }}</div>

		<div class="spacer-small">
	
		<a href="/address" class="button-page button-next bg-color-1 color-2 font-3" innerclass="color-2" label="{{ $button }}">
			{{ $button }}
		</a>

		<div class="spacer-tiny"></div>

		{{-- restart --}}
		<a href="{{ $restartURL }}">
			<h4 class="title-regular color-1 box-padding">{{ $buttonNo }}</h4>
		</a>
	
	</div>	

</div>

@stop
{{--------------- END CONTENT ----------------}}
