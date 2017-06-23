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

<div class="text-center page-padding-small" ng-controller="BelifController">
	
	
	<div class="spacer-small-2"></div>
	
	
	{{-- title --}}
	<h2 class="bold color-2">{{ $title }}</h2>


	<div class="spacer-large"></div>


	{{-- product carosel --}}
	@if ($products)
		<div class="product-slider-box" scroll-view scroll-pages="{{ count($products) }}">
			<div class="product-slider" >
				@for ($i=0; $i<count($products); ++$i)
					<div id="product_{{ $i }}" class="product-box" load-style="fade" load-group="product" style="z-index: {{ count($products) - $i }}">
						<div class="product-image-padding page-padding-larger">
							<img class="product-image" src="{{ safeObjectValue('sample_image', $products[$i], '') }}" load-style="fade" load-group="product">
						</div>
						<div class="spacer-medium"></div>
						<div class="spacer-small"></div>
						<div class="product-title-box">
							<h4 class="product-title large">{{ safeObjectValue('name', $products[$i], '') }}</h4>
							<div>
								<button name="product[{{ $i }}]" value="1" class="product-select-button bg-color-3" ng-click="productClicked($event)"></button>
							</div>
						</div>
					</div>
				@endfor
			</div>
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
