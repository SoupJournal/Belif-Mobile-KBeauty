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
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	//$subtext = safeArrayValue('subtext', $pageData, "");
	//$button = safeArrayValue('button', $pageData, "");
//	$secondaryButton = safeArrayValue('secondary_button', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	
?>

{{-- background image --}}
<img class="page-image" src="{{ $backgroundImage }}" load-style="fade" load-group="main">

<div class="page-overlay bg-color-opacity-2" load-style="fade" load-group="main">

	<div class="">
	
		{{-- page content --}}
		<div class="page-container page-padding-medium">


			<div class="spacer-medium"></div>
			<div class="spacer-tiny-2"></div>
			

			{{-- title --}}
			<h1 class="color-1">{!! $title !!}</h1>
			
			
			{{-- subtitle --}}
			<h3 class="title-regular">{!! $subtitle !!}</h3>
			
			
			{{-- text --}}
			<h3 class="clear-header-margins">{!! $text !!}</h3>
			

		
		</div>
		
	</div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
