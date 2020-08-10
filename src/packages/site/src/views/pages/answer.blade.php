@extends('belif::layouts.master')

{{------------------ TITLE -------------------}}

@section('title') Soup @stop

{{---------------- END TITLE -----------------}}

{{----------------- SCRIPTS ------------------}}

@section('scripts')

	<?php
	
		//ensure page data is set
		$pageData = isset($pageData) ? $pageData : null;
		$questionData = isset($questionData) ? $questionData : null;
	
		//get page variables
		$key = safeArrayValue('key', $pageData, "");
		$question = safeArrayValue('question', $pageData, "");
		$text = safeArrayValue('text', $pageData, "");

		//get question data
		$questionNumber = isset($questionNumber) ? $questionNumber : 1;
		$question = safeArrayValue('question', $questionData, "");
		$questionText = safeArrayValue('text', $questionData, "");
		$answerA = safeArrayValue('answer_A', $questionData, null);
		$answerB = safeArrayValue('answer_B', $questionData, null);
		$answerC = safeArrayValue('answer_C', $questionData, null);
		$theme = safeArrayValue('theme', $questionData, 0);
	
		//form submit URL
		$formURL = isset($formURL) ? $formURL : "";

		//determine button colours
		$answerClass = "answer-theme-" . $theme;
		$checkClass = "answer-check-theme-" . $theme;

	?>
	
@stop
{{--------------- END SCRIPTS ----------------}}

{{----------------- CONTENT ------------------}}

@section('content')

<div class="text-center">
	
	{{ Form::open(Array('role' => 'form', 'name' => 'answer-form', 'id' => 'answer-form', 'url' => $formURL)) }}

	<div>
		<img src="https://soup-journal-app-storage.s3.amazonaws.com/aqualand/countdown-GIF.gif" class="countdown-image" />
	</div>

	<button class="answer-box answer-location-{{ $questionNumber }}"></button>
	<input type="hidden" name="value" id="answer-field" value="A" />

	{{ Form::close() }}

</div>

<script type="text/javascript">
	$(document).ready(function() {
		setTimeout(function() {
			$('.countdown-image').hide();
			$('#answer-field').val('F');
			$('#answer-form').submit();
		}, 30000);
	});
</script>
@stop
{{--------------- END CONTENT ----------------}}
