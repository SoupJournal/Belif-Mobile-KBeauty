@extends('belif::layouts.master')


{{------------------ TITLE -------------------}}

@section('title') Belif @stop

{{---------------- END TITLE -----------------}}




{{----------------- SCRIPTS ------------------}}

@section('scripts')

	{{-- HTML::script('packages/artisan/cms/js/cms/form/form.js') --}}	
	
	<?php
	
		//set custom page controllers
		//$pageModules = Array('cms.form');
	
	?>
	
@stop
{{--------------- END SCRIPTS ----------------}}





{{----------------- CONTENT ------------------}}

@section('content')

<?php

	//ensure page properties are set
	$pageData = isset($pageData) ? $pageData : null;
	$products = isset($products) ? $products : null;
	$buttonURL = isset($buttonURL) ? $buttonURL : null;


	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	//$subtitle = safeArrayValue('subtitle', $pageData, ""); 
	//$text = safeArrayValue('text', $pageData, ""); 
	$button = safeArrayValue('button', $pageData, "");
		

?>

<div class="text-center page-padding-small">
	
	
	<div class="spacer-small-2"></div>
	
	
	{{-- title --}}
	<h2 class="bold color-2">{{ $title }}</h2>


	<div class="spacer-large"></div>


	{{-- product carosel --}}
	@if ($products)
		<div class="product-slider" >
			@foreach ($products as $product) 
				<div class="product-box">
					<img src="{{ safeObjectValue('sample_image', $product, '') }}" load-style="fade">
				</div>
			@endforeach
		</div>
	@endif


	<div class="spacer-medium"></div>



	{{-- next button --}}
	<a href="{{ $buttonURL }}" class="button-page bg-color-3 color-2" label="{{ $button }}">
		{{ $button }}
	</a>

	
	
	<div class="spacer-small">
	

</div>

@stop
{{--------------- END CONTENT ----------------}}
