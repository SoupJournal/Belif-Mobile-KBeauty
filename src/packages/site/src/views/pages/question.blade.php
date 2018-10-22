@extends('belif::layouts.master')

{{------------------ TITLE -------------------}}

@section('title') Belif @stop

{{---------------- END TITLE -----------------}}

{{----------------- SCRIPTS ------------------}}

@section('scripts')

	{{-- HTML::script('packages/artisan/cms/js/cms/form/form.js') --}}	
	
@stop
{{--------------- END SCRIPTS ----------------}}

{{----------------- CONTENT ------------------}}

@section('content')

<?php

	//ensure page data is set
	$pageData = isset($pageData) ? $pageData : null;
	$questionData = isset($questionData) ? $questionData : null;
	$questionNumber = isset($questionNumber) ? $questionNumber : 1;

	//get page variables
	$image = safeArrayValue('image', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	
	//get question data
	$question = safeArrayValue('question', $questionData, "");
	$questionText = safeArrayValue('text', $questionData, "");

	$answerLeft = $questionData['answer_A'];
	$answerRight = $questionData['answer_B'];

?>

{{ Form::open(Array('role' => 'form', 'name' => 'questionForm', 'url' => $formURL)) }}

<div class="text-center">
	
	<div class="container-top">
	
		<div class="spacer-small-2"></div>
		
		<div class="row page-margin-small">
		
			{{-- question title --}}
			<h2 class="title-semi-bold large question-color-{{ $questionNumber }}">{!! $question !!}</h2>
			
			<h3 class="title-light no-margins question-color-{{ $questionNumber }}">{!! $questionText !!}</h3>
		
		</div>
		
		<div class="stretch-to-fit">

			<div id="question-right" class="left" style="width:50%;float:left;">
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="answer-cloud light-blue-left">{{ $answerLeft }}</div>
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="spacer-small"></div>
			</div>
			
			<div id="question-left"  class="right" style="width:50%;float:right;">
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="answer-cloud dark-blue-right">{{ $answerRight }}</div>
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				<div class="spacer-small"></div>
			</div>
		
		</div>
	
	</div>

</div>

{{ Form::hidden('value', '') }}

{{ Form::close() }}

<script>
	$(function() {			
		$("#question-left").swipe( {
			swipeStatus:function(event, phase, direction, distance, duration, fingers, fingerData, currentDirection)
        	{
        		$('.page-body').css('left','');
        		$('input[name="value"]').val('B');
        		console.log(direction);
        		console.log(distance);
        		//if (direction == "right") {
        			$('.page-body').css('right', distance + 'px');
	        		if (distance > 150) {
	        			$('form[name="questionForm"]').submit();
	        		}
	        	//}
	        	if (phase == 'end' && distance < 150) {
	        		$('.page-body').css('right', '0px');
	        	}
        	},
        	threshold:0
		});
		$("#question-right").swipe( {
			swipeStatus:function(event, phase, direction, distance, duration, fingers, fingerData, currentDirection)
        	{
        		$('.page-body').css('right','');
        		$('input[name="value"]').val('A');
        		console.log(direction);
        		console.log(distance);
        		//if (direction == "left") {
	        		$('.page-body').css('left', distance + 'px');
	        		if (distance > 150) {
	        			$('form[name="questionForm"]').submit();
	        		}
	        	//}
	        	if (phase == 'end' && distance < 150) {
	        		$('.page-body').css('left', '0px');
	        	}
        	},
			threshold:0
		});
	});
</script>

@stop
{{--------------- END CONTENT ----------------}}
