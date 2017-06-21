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
	$formURL = isset($formURL) ? $formURL : '';
	$unregisterURL = isset($unregisterURL) ? $unregisterURL : '';

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$buttonNo = safeArrayValue('button_cancel', $pageData, "");
	
?>

<div class="text-center page-padding-medium">
	
	{{ Form::open(Array('role' => 'form', 'name' => 'emailForm', 'url' => $formURL)) }}
	
	
		<div class="spacer-small"></div>
	
		{{-- title --}}
		<h2 class="no-margins bold">{{ $title }}</h2>	
		<h3 class="no-margins title-light">{{ $subtitle }}</h3>
		
		<div class="spacer-small"></div>
		
		
		{{-- image --}}
		@if ($image && strlen($image)>0) 
			<div class="page-padding-medium">
				<img src="{{ $image }}" class="page-image" load-style="fade" load-group="page">
			</div>
		@endif
		
		
		<!-- load group -->
		<div load-style="fade" load-group="page">
			
			{{-- enter email --}}
			<div class="form-group"> 
			
				{{ Form::email('email', null, Array ('placeholder' => 'your@email.com', 'class' => 'page-input-text large', 'tabindex' => '1', 'required' => '', 'autofocus' => '', 'auto-next-focus' => '')) }}
				
			</div>
				
		
		
			{{-- display form errors --}}
		    @if ($errors->has())
		        @foreach ($errors->all() as $error)
		            <div class='bg-danger alert'>{{ $error }}</div>
		        @endforeach
		    @else
		   	 	<div class="spacer-tiny"></div>
		    @endif
		
		
				
			<div class="spacer-small"></div>
			
	
		
			{{-- submit button --}}
			<button class="button-page bg-color-3 color-2" label="{{ $button }}">
				{{ $button }}
			</button>
			
			
			{{-- Unregister --}}
			<a href="{{ $unregisterURL }}" class="color-1" target="_blank">
				<h4 class="button-link">{{ $buttonNo }}</h4>
			</a>
			
			
		</div>
		<!-- load group -->
		
		<div class="spacer-small"></div>
		
		
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
