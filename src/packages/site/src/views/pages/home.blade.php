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
//	$subtitle = safeArrayValue('subtitle', $pageData, "");
//	$text = safeArrayValue('text', $pageData, "");
//	$button = safeArrayValue('button', $pageData, "");

	$sectionData1 = null;
	
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


</div>

@stop
{{--------------- END CONTENT ----------------}}
