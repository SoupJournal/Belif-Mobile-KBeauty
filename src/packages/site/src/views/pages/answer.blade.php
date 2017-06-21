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
		$theme = safeArrayValue('theme', $pageData, 0);

		//get question data
		$question = safeArrayValue('question', $questionData, "");
		$questionText = safeArrayValue('text', $questionData, "");
		$answerA = safeArrayValue('answer_A', $questionData, null);
		$answerB = safeArrayValue('answer_B', $questionData, null);
		$answerC = safeArrayValue('answer_C', $questionData, null);
	

		//form submit URL
		$formURL = isset($formURL) ? $formURL : "";


		//determine button colours
		$answerClass = "answer-theme-" . $theme;


	?>
	
@stop
{{--------------- END SCRIPTS ----------------}}





{{----------------- CONTENT ------------------}}

@section('content')


<div class="text-center">
	
	{{ Form::open(Array('role' => 'form', 'name' => 'emailForm', 'url' => $formURL)) }}
	

	
		<div class="spacer-large">
		
		<div class="row page-margin-small">
		
			{{-- question --}}
			<h3 class="title-lightcolor-2">{!! $questionText !!}</h3>
			<h2 class="color-2">{!! $question !!}</h2>
					

		
			<div class="spacer-small"></div>
		
		
			{{-- answers --}}
			@if ($answerA && strlen($answerA)>0)
				<button class="answer-box {{ $answerClass }}" name="value" value="A">
					<span class=""><h2 class="color-2">{{ $answerA }}</h2></span>
				</button>
				<div class="spacer-small"></div>
			@endif
			
			@if ($answerB && strlen($answerB)>0)
				<button class="answer-box {{ $answerClass }}" name="value" value="B">
					<span class=""><h2 class="color-2">{{ $answerB }}</h2></span>
				</button>
				<div class="spacer-small"></div>
			@endif
			
			@if ($answerC && strlen($answerC)>0)
				<button class="answer-box {{ $answerClass }}" name="value" value="C">
					<span class=""><h2 class="color-2">{{ $answerC }}</h2></span>
				</button>
				<div class="spacer-small"></div>
			@endif
			
			
			<div class="spacer-small"></div>

		
		</div>
	
	
		<div class="spacer-large">
	
	
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
