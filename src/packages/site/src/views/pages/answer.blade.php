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
	
		
		<div class="page-padding-medium">
	
			<div class="spacer-large"></div>
			<div class="spacer-tiny"></div>
		
			{{-- question --}}
			<h3 class="title-light color-2 no-margins">{!! $questionText !!}</h3>
			<div class="spacer-small-2"></div>
			<h3 class="color-2 no-margins">{!! $question !!}</h3>
					

		
			<div class="spacer-large"></div>
		
		
		</div>
		
		
		<div class="page-padding-small">
		
			{{-- answers --}}
			@if ($answerA && strlen($answerA)>0)
				<button class="answer-box {{ $answerClass }}" name="value" value="A">
					<span class="answer-check {{ $checkClass }}"></span>
					<span class=""><h3 class="title-semi-bold color-2">{{ $answerA }}</h3></span>
				</button>
				<div class="spacer-medium"></div>
			@endif
			
			@if ($answerB && strlen($answerB)>0)
				<button class="answer-box {{ $answerClass }}" name="value" value="B">
					<span class="answer-check {{ $checkClass }}"></span>
					<span class=""><h3 class="title-semi-bold color-2">{{ $answerB }}</h3></span>
				</button>
				<div class="spacer-medium"></div>
			@endif
			
			@if ($answerC && strlen($answerC)>0)
				<button class="answer-box {{ $answerClass }}" name="value" value="C">
					<span class="answer-check {{ $checkClass }}"></span>
					<span class=""><h3 class="title-semi-bold color-2">{{ $answerC }}</h3></span>
				</button>
			@endif
			
			
			<div class="spacer-small"></div>

		
		</div>
	
	
		<div class="spacer-small"></div>
	
	
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
