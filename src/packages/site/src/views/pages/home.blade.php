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
	$infoData = safeArrayValue('info', $pageData, null);
	$info2Data = safeArrayValue('info2', $pageData, null);

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
	
	
	
	{{----------------- INFO SECTION -------------------}}
	<div class="page-section">
		@include('soup::sections.info', Array(
			'sectionId' => 'info',
			'pageData' => $infoData
		))
	</div>


	{{----------------- INFO SECTION -------------------}}
	<div class="page-section">
		@include('soup::sections.info', Array(
			'sectionId' => 'info2',
			'pageData' => $info2Data
		))
	</div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
