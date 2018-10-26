@extends('belif::layouts.master')


{{------------------ TITLE -------------------}}

@section('title') Belif @stop

{{---------------- END TITLE -----------------}}




{{----------------- SCRIPTS ------------------}}

@section('scripts')

	{{-- HTML::script('packages/artisan/cms/js/cms/form/form.js') --}}	
	
@stop
{{--------------- END SCRIPTS ----------------}}





{{----------------- CONTENT ------------------}}

@section('content')

<?php

 	//ensure page properties are set
	$buttonURL = isset($buttonURL) ? $buttonURL : null;
	$verified = isset($verified) ? $verified : false;

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$html = safeArrayValue('html', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$buttonNo = safeArrayValue('button_cancel', $pageData, "");
	
?>

<div class="text-center" ng-controller="BelifController" id="modalContainer">
	
	@if ($verified)
	<h5 class="title-light color-1 no-margins white-background">Votre mail a été vérifié!</h5>
	@endif

	{{ Form::open(Array('role' => 'form', 'name' => 'shareForm')) }}

		<div class="spacer-medium"></div>
		<div class="spacer-tiny"></div>
	
		<div class="page-padding-small">
	
			{{-- title --}}
			<h2 class="large color-1 no-margins">{{ $title }}</h2>
		
			<div class="spacer-small"></div>
		
			<h4 class="title-light large color-1 no-margins">{{ $subtitle }}</h4>
		
			<div class="spacer-small"></div>

		</div>

		<div class="page-padding-large">

			<div class="spacer-large"></div>
			<div class="spacer-large"></div>
			<div class="spacer-large"></div>
			<div class="spacer-medium"></div>

		
			{{-- enter email --}}
			<div class="form-group"> 
			
				{{ Form::email('email', null, Array ('placeholder' => 'vosamis@email.com', 'class' => 'page-input-text large no-border color-4 white-background', 'required' => '', 'autofocus' => '')) }}
				
			</div>
		
			{{-- display form errors --}}
		    @if ($errors->has())
		        @foreach ($errors->all() as $error)
		            <div class='bg-danger alert'>{{ $error }}</div>
		        @endforeach
		    @endif
		
			<h5 class="title-light color-1 no-margins">{!! $text !!}</h5>
			
			<div class="spacer-tiny"></div>

			{{-- submit button --}}
			<button class="button-page bg-color-1 color-2" label="{{ $button }}">
				{{ $button }}
			</button>
		
			{{-- Cancel button --}}
			<a href="{{ route('belif.home') }}" class="button-page color-1">
				<h5 class="button-link">{{ $buttonNo }}</h5>
			</a>
		
		</div>
		
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
