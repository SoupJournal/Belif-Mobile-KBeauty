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

?>

<div class="text-center">


	{{-- login page --}}
	<div class="page-container">


		{{-- title --}}
		<h1>{{ $title }}</h1>
		
		

		{{-- start button --}}
		@if (isset($nextURL))
			<a href="{{ $nextURL }}" class="button-page">{{ $button }}</button>
		@endif

	
	</div>
	


</div>

@stop
{{--------------- END CONTENT ----------------}}
