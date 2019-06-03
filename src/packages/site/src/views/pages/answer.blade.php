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
		$backgroundImage = safeArrayValue('background_image', $pageData, "");

		//get question data
		$questionNumber = isset($questionNumber) ? $questionNumber : 1;
		$question = safeArrayValue('question', $questionData, "");
		$questionText = safeArrayValue('text', $questionData, "");
		$answerA = safeArrayValue('answer_A', $questionData, null);
		$answerB = safeArrayValue('answer_B', $questionData, null);
		$answerC = safeArrayValue('answer_C', $questionData, null);
		$answerD = safeArrayValue('answer_D', $questionData, null);
		$answerE = safeArrayValue('answer_E', $questionData, null);
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
	
	{{ Form::open(Array('role' => 'form', 'name' => 'emailForm', 'url' => $formURL)) }}
		
		<div class="row page-margin-small">
	
			<div class="spacer-medium"></div>
		
			{{-- question --}}
			<h2 class="title-semi-bold large color-1">Question {{ $questionNumber }}</h2>
			<div class="spacer-small-2"></div>
			<h2 class="no-margins title-bold medium color-1">{!! $question !!}</h2>
		
			<div class="spacer-large"></div>
		
		</div>

		<div class="page-padding-small">
		
			{{-- answers --}}
			@if ($answerA && strlen($answerA)>0)
				<button class="answer-box {{ $answerClass }} text-center" name="value" value="A">
					<h3 class="title-semi-bold color-2">{!! $answerA !!}</h3>
				</button>
				<div class="spacer-medium"></div>
			@endif
			
			@if ($answerB && strlen($answerB)>0)
				<button class="answer-box {{ $answerClass }}" name="value" value="B">
					<h3 class="title-semi-bold color-2">{!! $answerB !!}</h3>
				</button>
				<div class="spacer-medium"></div>
			@endif

			@if ($answerC && strlen($answerC)>0)
				<button class="answer-box {{ $answerClass }}" name="value" value="C">
					<h3 class="title-semi-bold color-2">{!! $answerC !!}</h3>
				</button>
				<div class="spacer-medium"></div>
			@endif

			@if ($answerD && strlen($answerD)>0)
				<button class="answer-box {{ $answerClass }}" name="value" value="D">
					<h3 class="title-semi-bold color-2">{!! $answerD !!}</h3>
				</button>

			@endif

			@if ($answerE && strlen($answerE)>0)
				<button class="answer-box {{ $answerClass }}" name="value" value="E">
					<h3 class="title-semi-bold color-2">{!! $answerE !!}</h3>
				</button>
			@endif
			
			<div class="spacer-small"></div>
		
		</div>
	
		<div class="spacer-small"></div>
	
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
