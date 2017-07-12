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

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$buttonNo = safeArrayValue('button_cancel', $pageData, "");
	
?>

<div class="text-center page-padding">
	
	{{ Form::open(Array('role' => 'form', 'name' => 'addressForm')) }}
	
		
		<div class="spacer-larger">
		<div class="spacer-medium">
		
		<div class="page-padding-medium">
		
			{{-- title --}}
			<h2 class="color-2 bold">{!! $title !!}</h2>
		
			<div class="spacer-small">
		
			<h4 class="color-2">{{ $subtitle }}</h4>
		


		
			{{-- info --}}
			<div class="row page-margin">
				<h2 class="bold color-2 box-padding">{{ $text }}</h2>
			</div>
		
			<div class="spacer-medium">
		
			<a href="{{ $buttonNo }}" class="button-page button-next bg-color-3 color-2" innerclass="color-2" label="{{ $button }}" image="{{ $assetPath }}/images/logo-instagram.png" target="_blank">
				{{ $button }}
			</a>
		
		
			{{-- Cancel button --}}
			{{-- <a href="#" class="color-1"><h4 class="button-link">{{ $buttonNo }}</h4></a> --}}
				
		
		</div>
	
		<div class="spacer-large">
	
		
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
