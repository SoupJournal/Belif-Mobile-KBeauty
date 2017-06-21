@extends('belif::layouts.master')


{{------------------ TITLE -------------------}}

@section('title') Belif @stop

{{---------------- END TITLE -----------------}}




{{----------------- SCRIPTS ------------------}}

@section('scripts')

	{{-- HTML::script('packages/artisan/cms/js/cms/form/form.js') --}}	
	
	<?php
	
		//set custom page controllers
		//$pageModules = Array('cms.form');
	
	?>
	
@stop
{{--------------- END SCRIPTS ----------------}}





{{----------------- CONTENT ------------------}}

@section('content')

<?php

	//get page properties
	$questionNumber = isset($questionNumber) ? $questionNumber : 1;
	$buttonURL = isset($buttonURL) ? $buttonURL : null;

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$videoURL = safeArrayValue('video_url', $pageData, $assetPath . '/videos/test.3gpp');
	
	//get question data
	$question = safeArrayValue('question', $questionData, "");
	$questionText = safeArrayValue('text', $questionData, "");

?>

<div class="text-center">
	
	<div class="container-top">
	
		<div class="spacer-large">
		
		<div class="row page-margin-small">
		
			{{-- question title --}}
			<h2 class="title-3 color-2">Question {{ $questionNumber }}</h2>
		
		
			<div class="spacer-medium"></div>
		
		
			{{-- image --}}
			@if ($image && strlen($image)>0) 
				<div class="page-padding-very-large">
					<img src="{{ $image }}" class="page-image" load-style="fade" load-group="page">
				</div>
			@endif
		
			<div class="spacer-small"></div>
		

			{{-- video --}}
			<video class="question-video" src="{{ $videoURL }}" controls hidden-video="video-button"></video>
			
			<button id="video-button" class="video-button">
				<img src="{{ asset($assetPath . '/images/icon-play.png') }}" class="image-video-play">
			</button>
		
			{{-- text --}}
			<h4 class="title-light color-2">{{ $text }}</h4>
					

		
			<div class="spacer-small"></div>
		
		
			{{-- question --}}
			<h3 class="title-light no-margins color-2">{!! $questionText !!}</h3>
			<h2 class="no-margins color-2">{!! $question !!}</h2>
			
			
			<div class="spacer-small"></div>
			
		
			{{-- answer button --}}
			<a href="{{ $buttonURL }}" class="button-page bg-color-3 color-2" label="{{ $button }}">
				{{ $button }}
			</a>
		
		
		</div>
	
	
		<div class="spacer-large">
	
	
	</div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
