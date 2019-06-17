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
	$answerD = safeArrayValue('answer_D', $questionData, null);
	$answerE = safeArrayValue('answer_E', $questionData, null);
	$theme = safeArrayValue('theme', $questionData, 0);

	// determine button colours
	$answerClass = "answer-theme-" . $theme;

?>

<div class="text-center">
	
	<div class="container-top">

		<div class="spacer-large"></div>
		<div class="spacer-large"></div>
		
		<div class="row page-margin-small">

			{{-- question --}}
			<div class="question-text">

				<h2 class="no-margins title-bold medium color-1">{!! $question !!}</h2>
				
			</div>

			<div class="spacer-medium"></div>

			<h3 class="no-margins title-light medium color-1">
				<img src="https://s3.amazonaws.com/soup-journal-app-storage/Sulwhasoo/star_icon.png" width="25" />
			</h3>

			<div class="spacer-small"></div>

			{{ Form::open(Array('role' => 'form', 'name' => 'emailForm', 'url' => $formURL)) }}

			{{-- answers --}}
			@if ($answerA && strlen($answerA)>0)
				<button class="answer-box {{ $answerClass }} text-center" name="value" value="A">
					<h3 class="title-semi-bold color-1">{!! $answerA !!}</h3>
				</button>
				<div class="spacer-small"></div>
			@endif

			@if ($answerB && strlen($answerB)>0)
				<button class="answer-box {{ $answerClass }}" name="value" value="B">
					<h3 class="title-semi-bold color-1">{!! $answerB !!}</h3>
				</button>
				<div class="spacer-small"></div>
			@endif

			@if ($answerC && strlen($answerC)>0)
				<button class="answer-box {{ $answerClass }}" name="value" value="C">
					<h3 class="title-semi-bold color-1">{!! $answerC !!}</h3>
				</button>
				<div class="spacer-small"></div>
			@endif

			@if ($answerD && strlen($answerD)>0)
				<button class="answer-box {{ $answerClass }}" name="value" value="D">
					<h3 class="title-semi-bold color-1">{!! $answerD !!}</h3>
				</button>
				<div class="spacer-small"></div>
			@endif

			@if ($answerE && strlen($answerE)>0)
				<button class="answer-box {{ $answerClass }}" name="value" value="E">
					<h3 class="title-semi-bold color-1">{!! $answerE !!}</h3>
				</button>
			@endif

			{{ Form::close() }}

			<div class="spacer-medium"></div>
		
		</div>
	
	</div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
