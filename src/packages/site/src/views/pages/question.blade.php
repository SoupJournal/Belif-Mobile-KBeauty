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
		
			<div class="font-3 color-2 size-6">Question {{ $questionNumber }}</div>
		
			<div class="question-text">
			
				<div class="spacer-medium"></div>
			
				<div class="no-margins font-3 size-4 color-2">{!! $question !!}</div>

				<div class="spacer-medium"></div>

			</div>

			{{-- answers --}}
			@if ($answerA && strlen($answerA)>0)
				<div class="answer-block">
					<button class="question question-{{ $questionNumber }}-A" style="background: url(https://soup-journal-app-storage.s3.amazonaws.com/aloeaquabomb/gifs/question-{{ $questionNumber }}-A.gif) no-repeat center center;" name="value" value="A"></button>
					<h3 class="title-semi-bold color-2">{!! $answerA !!}</h3>
				</div>
			@endif

			@if ($answerB && strlen($answerB)>0)
				<div class="answer-block">
					<button class="question question-{{ $questionNumber }}-B" style="background: url(https://soup-journal-app-storage.s3.amazonaws.com/aloeaquabomb/gifs/question-{{ $questionNumber }}-B.gif) no-repeat center center;" name="value" value="B"></button>
					<h3 class="title-semi-bold color-2">{!! $answerB !!}</h3>
				</div>
			@endif

			@if ($answerC && strlen($answerC)>0)
				<div class="answer-block-full">
					<button class="question question-{{ $questionNumber }}-C" style="background: url(https://soup-journal-app-storage.s3.amazonaws.com/aloeaquabomb/gifs/question-{{ $questionNumber }}-C.gif) no-repeat center center;" name="value" value="C"></button>
					<h3 class="title-semi-bold color-2">{!! $answerC !!}</h3>
				</div>
			@endif

			<div class="spacer-small"></div>

			<a href="{{ $buttonURL }}" class="button-page bg-color-2 color-13 font-3" label="{{ $button }}">
				{{ $button }}
			</a>
		
		</div>
	
	</div>

	{{ Form::close() }}

</div>
@stop
{{--------------- END CONTENT ----------------}}
