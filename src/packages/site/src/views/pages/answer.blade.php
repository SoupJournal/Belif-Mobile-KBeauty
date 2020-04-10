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
	
	{{ Form::open(Array('role' => 'form', 'name' => 'emailForm', 'url' => $formURL)) }}
		
		<div class="row page-margin-small">
	
			<div class="spacer-large"></div>
		
			<div class="font-3 color-2 size-4">{!! $question !!}</div>
		
			<div class="spacer-large"></div>
		
		</div>
		
		<div class="page-padding-small">
		
			{{-- answers --}}
			@if ($answerA && strlen($answerA)>0)
				<button class="answer-box {{ $answerClass }} text-center" name="value" value="A">
					<h3 class="font-3 color-2 size-4">{!! $answerA !!}</h3>
				</button>
				<div class="spacer-medium"></div>
			@endif
			
			@if ($answerB && strlen($answerB)>0)
				<button class="answer-box {{ $answerClass }}" name="value" value="B">
					<h3 class="font-3 color-2 size-4">{!! $answerB !!}</h3>
				</button>
				<div class="spacer-medium"></div>
			@endif
			
			@if ($answerC && strlen($answerC)>0)
				<button class="answer-box {{ $answerClass }}" name="value" value="C">
					<h3 class="font-3 color-2 size-4">{!! $answerC !!}</h3>
				</button>
			@endif
			
			<div class="spacer-small"></div>
		
		</div>
	
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
