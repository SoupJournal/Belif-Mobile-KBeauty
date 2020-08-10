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
	$answerA = safeArrayValue('answer_A', $questionData, null);
	$answerB = safeArrayValue('answer_B', $questionData, null);
	$answerC = safeArrayValue('answer_C', $questionData, null);
	$theme = safeArrayValue('theme', $questionData, 0);

	// determine button colours
	$answerClass = "answer-theme-" . $theme;
?>

<div class="text-center">

	{{ Form::open(Array('role' => 'form', 'name' => 'emailForm', 'url' => $formURL)) }}

	<div class="container-top">

		<div class="spacer-medium"></div>
	
		<div class="row page-margin-small">
		
			<div class="no-margins size-9 color-2 font-3 stroke">Search {!! $questionNumber !!}:</div>

			<div>
				<img src="https://soup-journal-app-storage.s3.amazonaws.com/aqualand/question-{{ $questionNumber }}.png" class="question-image" />
			</div>

			<div class="question-text">
			
				<div class="spacer-large"></div>
			
				<div class="no-margins font-3 size-4 color-2">{!! $question !!}</div>

				<div class="spacer-medium"></div>

				<div class="no-margins font-5 size-4 color-2">{!! $text !!}</div>

			</div>

			<div class="spacer-small"></div>

			<a href="{{ $buttonURL }}" class="button-page bg-color-14 color-2 font-3" label="Let's Find It!">
				Let's Find It!
			</a>
		
		</div>
	
	</div>

	{{ Form::close() }}

</div>
@stop
{{--------------- END CONTENT ----------------}}
