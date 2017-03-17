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

	//ensure page data is set
	$pageData = isset($pageData) ? $pageData : null;

	//get page variables
	$welcomeData = safeArrayValue('welcome', $pageData, null);
	$guideData = safeArrayValue('guide', $pageData, null);
	$signupData = safeArrayValue('signup', $pageData, null);
	$infoData = safeArrayValue('info', $pageData, null);
	$imageData = safeArrayValue('image', $pageData, null);

	$sectionData1 = null;
	
	//images
	$logoImage = "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/logo-soup-large-black.png";
	$instagramImage = "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/icon-instagram.png";
	
	//links
	$instagramLink = "http://instagram.com/soupjournal";
	
?>

<div class="text-center">

	
	{{----------------- WELCOME SECTION -------------------}}
	<div class="page-section">
		@include('soup::sections.info', Array(
			'sectionId' => 'info',
			'pageData' => $welcomeData
		))
	</div>



	{{----------------- GUIDE SECTION -------------------}}
	<div class="page-section">
		@include('soup::sections.guide', Array(
			'sectionId' => 'guide',
			'pageData' => $guideData
		))
	</div>
	
	
	
	{{----------------- SIGNUP SECTION -------------------}}
	<div class="page-section">
		@include('soup::sections.subscribe', Array(
			'sectionId' => 'signup',
			'pageData' => $signupData
		))
	</div>


	{{----------------- INFO SECTION -------------------}}
	<div class="page-section">
		@include('soup::sections.info', Array(
			'sectionId' => 'info',
			'pageData' => $infoData
		))
	</div>
	
	
	{{----------------- IMAGE SECTION -------------------}}
	<div class="page-section">
		@include('soup::sections.image', Array(
			'sectionId' => 'info',
			'pageData' => $imageData
		))
	</div>


	{{----------------- FOOTER -------------------}}
	<div class="page-section text-center bg-color-2">
		
		<div class="spacer-small"></div>
		
		<img class="logo-page-image" alt="Soup" src="{{ $logoImage }}" load-style="fade">
		
		<div class="spacer-small"></div>
		
		<a href="{{ $instagramLink }}" target="_blank">
			<img src="{{ $instagramImage }}"> 
			<span class="spacer-horizontal-small"></span>
			@soupjournal
		<a>
		
		<div class="spacer-medium"></div>
		
		<span><a href="#">Privacy</a></span>
		<span class="spacer-horizontal-small"></span>
		<span><a href="#">Terms and Conditions</a></span>
		
		<div class="spacer-medium"></div>
		
		<div>
			&#9400; Soup 2017
		</div>
		
		<div class="spacer-small"></div>
		
	</div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
