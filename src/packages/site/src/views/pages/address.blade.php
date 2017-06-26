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
	$formURL = isset($formURL) ? $formURL : "";
	$states = isset($states) ? $states : null;

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	
?>

<div class="text-center page-padding-medium">
	
	{{ Form::open(Array('role' => 'form', 'name' => 'addressForm', 'url' => $formURL)) }}
	
		<div class="spacer-medium"></div>
	
	
		{{-- title --}}
		<h2 class="medium">{{ $title }}</h2>
	
	
		<div class="spacer-tiny"></div>
		
	
		{{-- image --}}
		@if ($image && strlen($image)>0) 
			<div class="page-padding-extreme">
				<img src="{{ $image }}" class="page-image" load-style="fade" load-group="page">
			</div>
		@endif
	
	
		<div class="spacer-tiny"></div>
	


		{{-- name --}}
		<div class="form-group"> 
		
			{{ Form::text('name', null, Array ('placeholder' => 'Full Name', 'class' => 'page-input-text', 'required' => '', 'autofocus' => '', 'auto-next-focus' => '')) }}
			
		</div>



		{{-- address 1 --}}
		<div class="form-group"> 
		
			{{ Form::text('address_1', null, Array ('placeholder' => 'Address line 1', 'class' => 'page-input-text', 'required' => '', 'auto-next-focus' => '')) }}
			
		</div>
			
		
		<div class="form-group input-flex"> 
		
			{{-- address 2 --}}
			<span class="input-address-2-left">
				{{ Form::text('address_2', null, Array ('placeholder' => 'Address line 2', 'class' => 'page-input-text', 'auto-next-focus' => '')) }}
			</span>

			{{-- zip code --}}
			<span class="input-address-2-right">
				{{ Form::input('number', 'zip_code', null, Array ('placeholder' => 'ZIP', 'class' => 'page-input-text', 'required' => '', 'pattern' => '[0-9]*')) }}
			</span>
			
		</div>
		
			
		
		<div class="form-group input-flex">
		
			{{-- city --}}
			<span class="input-city-left">
				{{ Form::text('city', null, Array ('placeholder' => 'City', 'class' => 'page-input-text', 'required' => '', 'auto-next-focus' => '')) }}
			</span>

	
			{{-- state --}}
			<span class="input-city-right">
				<select-button class="page-input-text page-input-place-holder input-padding-zero" label-class="page-input-select-overlay stretch-to-fit">
				{{ Form::select('state', $states, 'State', Array ('placeholder' => 'State', 'class' => 'page-input-text page-input-select input-padding-very-large', 'ng-model' => 'state', 'ng-change' => '$parent.valueUpdated(state, this);', 'required' => '', 'auto-next-focus' => '')) }}
				</select-button>
			</span>
			
		</div>
	
	
	
		{{-- display form errors --}}
	    @if ($errors->has())
	        @foreach ($errors->all() as $error)
	            <div class='bg-danger alert'>{{ $error }}</div>
	        @endforeach
	        
	    @else
	        <div class="spacer-large">
	    @endif
	
	
		
		{{-- submit button --}}
		<button class="button-page bg-color-3 color-2" label="{{ $button }}">
			{{ $button }}
		</button>
			

		
		<div class="spacer-small"></div>
		
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
