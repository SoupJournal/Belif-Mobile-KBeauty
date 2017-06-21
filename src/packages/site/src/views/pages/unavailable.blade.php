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
	
		<div class="container-top">
		
			<div class="spacer-larger">
			<div class="spacer-medium">
			
			<div class="row page-margin">
			
				{{-- title --}}
				<h2 class="color-2 bold">{{ $title }}</h2>
			
				<div class="spacer-small">
			
				<h4 class="color-2">{{ $subtitle }}</h4>
			
			</div>
	
		</div>
	
	
		<div class="container-bottom stretch-to-width page-padding-small-absolute">
	
			<div class="row">
			
			
			
				{{-- info --}}
				<div class="row page-margin">
					<h2 class="bold color-1 box-padding">{{ $text }}</h2>
				</div>
			
				<div class="spacer-medium">
			
				<page-button href="https://www.instagram.com/belifusa/" class="button-next bg-color-1" innerclass="color-2" label="{{ $button }}" image="{{ $assetPath }}/images/logo-instagram.png"></page-button>
			
			
				{{-- Cancel button --}}
				<a href="#" class="color-1"><h4 class="button-link">{{ $buttonNo }}</h4></a>
					
			
			</div>
		
			<div class="spacer-large">
		
		</div>
		
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
