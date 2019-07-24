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

		<div class="spacer-medium"></div>
	
		<div class="row page-margin-small">
		
			<div class="font-4 color-2 size-6">Question {{ $questionNumber }}</div>
		
			<div class="spacer-large"></div>

			<div class="question-text">
			
				<div class="spacer-medium"></div>
			
				<div class="no-margins font-4 size-5 color-2">{!! $question !!}</div>
				
			</div>
			
			<div class="spacer-medium"></div>
			<div class="spacer-large"></div>

			<div class="question-video-box">
			
				<video id="video" class="question-video" src="{{ $videoURL }}" controls hidden-video="video-button"></video>
				
				<div class="spacer-large"></div>

				<button id="video-button" class="video-button">
					<img src="{{ asset($assetPath . '/images/icon-play.png') }}" class="image-video-play">
				</button>
			
				<div class="font-4 color-2 size-4">{{ $text }}</div>
				
			</div>
					
			<div class="spacer-large"></div>
		
			<a href="{{ $buttonURL }}" class="button-page bg-color-12 color-2 font-3" label="{{ $button }}">
				{{ $button }}
			</a>
		
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
