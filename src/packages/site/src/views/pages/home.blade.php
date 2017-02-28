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
	@include('soup::sections.info', $pageData)



</div>

@stop
{{--------------- END CONTENT ----------------}}
