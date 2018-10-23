@extends('belif::layouts.master')


{{------------------ TITLE -------------------}}

@section('title') Belif @stop

{{---------------- END TITLE -----------------}}




{{----------------- SCRIPTS ------------------}}

@section('scripts')

	{{-- HTML::script('packages/artisan/cms/js/cms/form/form.js') --}}	
	
@stop
{{--------------- END SCRIPTS ----------------}}


{{--------------- HEADER RIGHT ----------------}}
@section('header-right')
<?php
	//ensure page properties are set
	$numberOfSamples = isset($numberOfSamples) ? $numberOfSamples : 0;
?>
<span ng-controller="BelifController">
	<h4 class="color-2">#{ numberOfSelectedProducts() }# / {{ $numberOfSamples }}</h4>
</span>
@stop
{{------------- END HEADER RIGHT --------------}}



{{----------------- CONTENT ------------------}}

@section('content')

<?php

	//ensure page properties are set
	$pageData = isset($pageData) ? $pageData : null;
	$products = isset($products) ? $products : null;
	$numberOfSamples = isset($numberOfSamples) ? $numberOfSamples : 0;
	$formURL = isset($formURL) ? $formURL : '';

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	
	//already selected items
	$selected = "[]";
	if(Session::has('selectedProducts')) {
     	$selected = json_encode(Session::get('selectedProducts'));
	}
	
?>

<div class="text-center page-padding-small" ng-controller="BelifController" ng-init="initProducts({{ $numberOfSamples }}, {{ $selected }})">
	
	
	{{ Form::open(Array('role' => 'form', 'name' => 'productForm', 'url' => $formURL)) }}
		
		<div class="spacer-small-2"></div>
		
		
		{{-- title --}}
		<h2 class="bold color-2">{{ $title }}</h2>
	
	
		<div class="spacer-small-2"></div>
	
	
		{{-- product carosel --}}
		@if ($products)
			<div class="product-slider-box" scroll-view scroll-pages="{{ count($products) }}">
				<div class="product-slider" >
					@for ($i=0; $i<count($products); ++$i)
						<?php
							//get product id
							$pId = safeObjectValue('id', $products[$i], '');
						?>
						<div id="product_{{ $i }}" class="product-box" load-style="fade" load-group="product_{{ $i }}" style="z-index: {{ count($products) - $i }}">
							<div class="product-image-padding page-padding-larger">
								<img class="product-image" src="{{ safeObjectValue('sample_image', $products[$i], '') }}" load-style="fade" load-group="product_{{ $i }}">
							</div>
							<div class="spacer-large"></div>
							<div class="spacer-medium"></div>
							<div class="product-title-box">
								<h4 class="product-title large">{{ safeObjectValue('name', $products[$i], '') }}</h4>
								<div>
									<button id="product_{{ $i }}" name="product_{{ $pId }}" class="product-select-button bg-color-3" ng-click="productClicked($event)" type="button"></button>
									<input type="hidden" id="product_{{ $i }}_input" name="product[{{ $pId }}]"></input>
								</div>
							</div>
						</div>
					@endfor
				</div>
			</div>
		@endif
	
		{{-- selected products --}}
		<div class="selected-products-box">
			<div class="selected-product-image-box" ng-repeat="product in selectedProducts">
				<img src="#{ product.img }#" class="selected-product-image">
			</div>
		</div>
		
		{{-- display form errors --}}
	    @if ($errors->has())
	        @foreach ($errors->all() as $error)
	            <div class='bg-danger alert'>{{ $error }}</div>
	        @endforeach
	    @else
			<div class="spacer-medium"></div>
	   	 	<div class="spacer-tiny"></div>
			<div class="spacer-tiny"></div>
	    @endif
	
		{{-- next button --}}
		<button class="button-page bg-color-5 color-2" label="{{ $button }}">
			{{ $button }}
		</button>
		
		<div class="spacer-small">
		
	{{ Form::close() }}
	
</div>

@stop
{{--------------- END CONTENT ----------------}}
