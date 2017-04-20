@extends('soup::layouts.fullscreen')


{{------------------ TITLE -------------------}}

	@section('title') Soup @stop

{{---------------- END TITLE -----------------}}




{{----------------- SCRIPTS ------------------}}

@section('scripts')

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

@stop
{{--------------- END SCRIPTS ----------------}}



@section('background-color') 
	bg-color-10
@stop



{{----------------- CONTENT ------------------}}


@section('content')

	
	{{-- background image --}}
	<img class="page-image" src="{{ $backgroundImage }}" load-style="fade" load-group="main">
	
	<div class="page-overlay text-center" load-style="fade" load-group="main">
	
		<div class="stretch-to-fit bg-color-10">
		
			{{-- page content --}}
			<div class="page-container page-padding-medium">
	
	
				<div class="spacer-medium"></div>
				<div class="spacer-large"></div>
				
	
				{{-- title --}}
				<h1 class="color-1">{!! $title !!}</h1>
				
				
				{{-- subtitle --}}
				<h3 class="title-regular">{!! $subtitle !!}</h3>
				
				
				{{-- text --}}
				<h3 class="title-light clear-header-margins">{!! $text !!}</h3>
				
	
			
			</div>
			
		</div>
	
	</div>
	
@stop
{{--------------- END CONTENT ----------------}}
