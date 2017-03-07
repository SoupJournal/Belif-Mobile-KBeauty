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
	$title = safeArrayValue('title', $pageData, "");
//	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");

?>


{{-- background image --}}
@include('soup::sections.background', ['backgroundImage' => $backgroundImage, 'loadGroup' => 'main'])


{{-- page --}}
<div class="page-overlay" load-style="fade" load-group="main">

	<div class="page-container row-centered page-padding-small">


		{{-- title --}}
		<h1 class="color-2">{{ $title }}</h1>
		
		

		{{-- start button --}}
		@if (isset($nextURL))
			<a href="{{ $nextURL }}" class="button-page-border bg-color-clear color-3 border-color-3">{{ $button }}</a>
		@endif

	
	</div>
	
</div>

@stop
{{--------------- END CONTENT ----------------}}
