@extends('soup::layouts.master')


{{------------------ TITLE -------------------}}

@section('title') Soup @stop

{{---------------- END TITLE -----------------}}




{{----------------- SCRIPTS ------------------}}

@section('scripts')

<?php

	//ensure page variables are set
	$sectionId = isset($sectionId) ? $sectionId : "";
	$pageData = isset($pageData) ? $pageData : null;

	//get page variables
	$title = safeArrayValue('title', $pageData, null);
	$subtitle = safeArrayValue('subtitle', $pageData, null);
	$text = safeArrayValue('text', $pageData, null);
	$button = safeArrayValue('button', $pageData, null);
	$image = safeArrayValue('image', $pageData, null);
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	$theme = safeArrayValue('theme', $pageData, 0);
	
	//set theme properties
	$bgColor = "bg-color-10";
	$buttonSpacer = "spacer-small-2";
	$headerPadding = "page-padding-medium-2";
	$useBackgroundPadding = false;

?>

@stop
{{--------------- END SCRIPTS ----------------}}

@section('background-color') 
	bg-color-10
@stop



{{----------------- CONTENT ------------------}}

@section('content')



{{-- background image --}}
<img class="page-image" src="{{ $backgroundImage }}" load-style="fade" load-group="main">

<div class="page-overlay" load-style="fade" load-group="main">

	{{-- center content vertically --}}
	<div class="table-parent fill-height">
		<div class="table-center-row fill-height">
			<div class="table-center-cell">
			
				<div class="text-center page-padding-medium">
					
					{{-- title --}}
					@if (isset($title))
						<div class="spacer-small"></div>
						<h1 class="title-semi-bold small color-1">{!! $title !!}</h1>			
					@endif
				
				</div>
				
		
				<div class="page-padding-medium-2">
	
					@if (isset($text))
						<div class="spacer-tiny-2"></div>
						<h4 class="title-light color-1 text-align-left clear-header-margins">{!! $text !!}</h4>
						<div class="spacer-small-2"></div>
					@endif
					
		
				</div>
				
				<div class="text-center page-padding-medium">
		
					@if (isset($subtitle))
						<h2 class="title-semi-bold clear-header-margins color-1">{!! $subtitle !!}</h2>
					@endif
					
				</div>
				
				
				<div class="text-center page-padding-medium">
					
					{{-- draw image --}}
					@if (isset($image) && strlen($image)>0)	
						<div class="spacer-small-2"></div>		
						<img src="{{ $image }}" class="section-image" load-style="fade" load-group="{{ $sectionId }}">
					@endif
					
					
				</div>
				
			
				<div class="spacer-small-2"></div>
				
			</div>
		</div>
	</div>

</div>


@stop
{{--------------- END CONTENT ----------------}}

