@extends('belif::layouts.master')

{{------------------ TITLE -------------------}}

@section('title') Belif @stop

{{---------------- END TITLE -----------------}}

{{----------------- SCRIPTS ------------------}}

@section('scripts')

@stop
{{--------------- END SCRIPTS ----------------}}

{{----------------- CONTENT ------------------}}

@section('content')

<?php

	//ensure page data is set
	$pageData = isset($pageData) ? $pageData : null;
	$questionData = isset($questionData) ? $questionData : null;

	//get page properties
	$questionNumber = isset($questionNumber) ? $questionNumber : 1;
	$buttonURL = isset($buttonURL) ? $buttonURL : null;

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	
	//get question data
	$question = safeArrayValue('question', $questionData, "");
	$questionText = safeArrayValue('text', $questionData, "");
	$videoURL = safeArrayValue('video', $questionData, $assetPath . '/videos/test.3gpp');

?>

<div class="text-center">
	
	<div class="container-top">
	
		<div class="spacer-small-2">
		
		<div class="row page-margin-small">
		
			{{-- question title --}}
			<h2 class="title-semi-bold large color-1">Question {{ $questionNumber }}</h2>
		
			<div class="spacer-medium"></div>

			{{-- image --}}
			@if ($image && strlen($image)>0) 
				<div class="page-padding-larger-more">
					<img src="{{ $image }}" class="page-image" load-style="fade" load-group="page">
				</div>
			@endif
		
			<div class="spacer-small"></div>
		
			{{-- question --}}
			<div class="question-text">
			
				<div class="spacer-medium"></div>
			
				<h2 class="no-margins title-bold medium color-1">{!! $question !!}</h2>
				
			</div>
			
			<div class="spacer-medium"></div>
			<div class="spacer-large"></div>

			{{-- video --}}
			<div class="question-video-box">
			
				<video id="video" class="question-video" src="{{ $videoURL }}" controls hidden-video="video-button"></video>
				
				<button id="video-button" class="video-button">
					<img src="{{ asset($assetPath . '/images/icon-play.png') }}" class="image-video-play">
				</button>
			
				{{-- text --}}
				<h4 class="title-light color-1">{{ $text }}</h4>
				
			</div>
					
			<div class="spacer-medium"></div>
			<div class="spacer-large"></div>
		
			{{-- answer button --}}
			<a href="{{ $buttonURL }}" class="button-page bg-color-1 color-2 font-3" label="{{ $button }}">
				{{ $button }}
			</a>
		
			<div class="spacer-large"></div>
			<div class="spacer-large"></div>

		</div>
	
	</div>

</div>
<script type="text/javascript">
$(document).ready(function() {
	$('#video').css('display', 'none');
	$("#video-button").click(function(){
		$('#video').css('display', 'block');
		$('#video')[0].play();
		$('#video').on('ended',function(){
			$('#video').css('display', 'none');
		});
	});
});
</script>
@stop
{{--------------- END CONTENT ----------------}}
