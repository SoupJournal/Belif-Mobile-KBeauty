@extends('soup::layouts.master')


{{------------------ TITLE -------------------}}

@section('title') Soup @stop

{{---------------- END TITLE -----------------}}




{{----------------- SCRIPTS ------------------}}

@section('scripts')

	{{-- HTML::script('packages/artisan/cms/js/cms/form/form.js') --}}	
	
@stop
{{--------------- END SCRIPTS ----------------}}





{{----------------- CONTENT ------------------}}

@section('content')

<?php
//
//	//ensure page data is set
//	$pageData = isset($pageData) ? $pageData : null;
//
//	//get page variables
//	$title = safeArrayValue('title', $pageData, "");
//	$subtitle = safeArrayValue('subtitle', $pageData, "");
//	$text = safeArrayValue('text', $pageData, "");
//	$button = safeArrayValue('button', $pageData, "");
	
?>

<div class="text-center">


	{{----------------- WELCOME PAGE -------------------}}
	@include('soup::sections.info', $pageData);




<!--
	{{-- welcome page --}}
	<div class="page-container">

		{{-- background image --}}
		<img class="page-image" src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-001.jpg" load-style="fade">
		
		<div class="stretch-to-fit">
			<h1 class="color-2">TEST did this work!</h1>
		</div>
	
	</div>
	-->
	
	<!--
	<div class="container-top">
	
		<div class="spacer-large">
		
		<div class="row page-margin-small">
		
			{{-- title --}}
			<h2 class="title-3 color-4">{{-- $title --}}</h2>
		
			<h1 class="title-2 color-3">{{-- $subtitle --}}</h1>
		
		</div>

	</div>


	<div class="container-bottom stretch-to-width">

		<div>
		
			{{-- title --}}
			<div class="shrink-to-fit">
			<div class="bg-color-opacity-1 box-margin">
				<h3 class="title-3 color-4 box-padding">{{-- $text --}}</h3>
			</div>
			</div>
		
			<div class="spacer-larger">
		
			<page-button href="{{ URL::to('/email') }}" class="button-next bg-color-3" innerclass="color-2" label="{{-- $button --}}"></page-button>
		
			<div class="spacer-large">
		
		</div>
	
		<div class="spacer-large">
	
	</div>
	-->

</div>

@stop
{{--------------- END CONTENT ----------------}}
