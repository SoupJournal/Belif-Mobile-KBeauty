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
	$termsURL = isset($termsURL) ? $termsURL : '';

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$buttonNo = safeArrayValue('button_cancel', $pageData, "");
	
?>

<div class="text-center">
	
	{{ Form::open(Array('role' => 'form', 'name' => 'emailForm', 'url' => $formURL)) }}
	
	
		<div class="page-padding-tiny">
	
			<div class="spacer-small-2"></div>
		
			{{-- title --}}
			<h2 class="no-margins title-bold medium">{{ $title }}</h2>	
			<h2 class="no-margins title-light large">{{ $subtitle }}</h2>
			
			<div class="spacer-small"></div>
		
		</div>	
			
			
		{{-- image --}}
		@if ($image && strlen($image)>0) 
			<div class="page-padding-large">
				<img src="{{ $image }}" class="page-image" load-style="fade" load-group="page">
			</div>
		@endif

		
		<div class="spacer-small"></div>
		
		
		<!-- load group -->
		<div class="page-padding-medium" load-style="fade" load-group="page">
			
			
			
			{{-- text --}}
			<h3 class="title-light no-margins small">{!! $text !!}</h3>
			
			
			{{-- enter email --}}
			<div class="form-group"> 
			
				{{ Form::email('email', null, Array ('placeholder' => 'your@email.com', 'class' => 'page-input-text large color-2', 'tabindex' => '1', 'required' => '', 'autofocus' => '', 'auto-next-focus' => '')) }}
				
			</div>
				
		
		
			{{-- display form errors --}}
		    @if ($errors->has())
		        @foreach ($errors->all() as $error)
		            <div class='bg-danger alert'>{{ $error }}</div>
		        @endforeach
		    @else
		   	 	<div class="spacer-tiny"></div>
		    @endif
		
		
				
			<div class="spacer-small-2"></div>
			
	
		
			{{-- submit button --}}
			<button class="button-page bg-color-3 color-2" label="{{ $button }}">
				{{ $button }}
			</button>
			
			
			{{-- Terms & Conditions --}}
			<a href="{{ $termsURL }}" class="color-1" target="_blank">
				<h4 class="button-link">{{ $buttonNo }}</h4>
			</a>
			
			
		</div>
		<!-- load group -->
		
		<div class="spacer-small"></div>
		
		
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
