@extends('soup::layouts.master')


{{------------------ TITLE -------------------}}

@section('title') Soup @stop

{{---------------- END TITLE -----------------}}




{{----------------- SCRIPTS ------------------}}

@section('scripts')

	<?php
	
		//ensure page data is set
		$pageData = isset($pageData) ? $pageData : null;
	
		//get page variables
		$question = safeArrayValue('question', $pageData, "");
		$text = safeArrayValue('text', $pageData, "");
		$answer = safeArrayValue('answer', $pageData, "");
		$backgroundImage = safeArrayValue('background_image', $pageData, "");
		$theme = safeArrayValue('theme', $pageData, 0);
	
		//question submit URL
		$formURL = isset($formURL) ? $formURL : "";
		
	
	?>
	
@stop
{{--------------- END SCRIPTS ----------------}}





{{----------------- CONTENT ------------------}}

@section('content')



{{-- hidden background image for page sizing --}}
<img class="page-image clear" src="{{ $backgroundImage }}">


<div swipe-gesture class="stretch-to-fit swipe-view"></div>

{{-- answer selection --}}
<!-- div id="question-container" class="stretch-to-fit" -->


<div class="stretch-to-fit" style="pointer-events: none">


	{{ Form::open(Array('role' => 'form', 'name' => 'questionForm', 'url' => $formURL, 'class' => 'stretch-to-fit', 'id' => 'question-container')) }}

		{{-- text overlay --}}
		<div class="stretch-to-fit" swipe-view>
		
			{{-- background image --}}
			<img class="page-image" src="{{ $backgroundImage }}" load-style="fade">

		
		
			{{-- top row --}}
			<div class="container-top">
			
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				
				<div class="row page-padding-small">
				
					{{-- question --}}
					<h2 class="bold">{{ $question }}</h2>
				
					<div class="spacer-small"></div>
				
					<h3 class="color-2">{{ $text }}</h3>
				
				</div>
		
			</div>
		
		
			{{-- center row --}}
			<div class="text-center row-centered page-padding-large">
				
					<h2 class="bold color-2">{{ $answer }}</h2>	
		
			</div>
		
		
		</div>
	
	
		
		{{-- buttons overlay --}}
		<div class="stretch-to-fit">
		
			{{-- bottom row --}}
			<div class="container-bottom">
			
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				
				<div class="row">
				
					<div class="button-answer pull-left">
						<button class="answer-reject stretch-to-fit"></button>
					</div>
					<div class="button-answer pull-right">
						<button class="answer-accept stretch-to-fit"></button>
					</div>
				
				</div>
		
			</div>
		
		</div>
	
		{{-- answer field for javascript submits --}}
		<input type="hidden" name="scriptAnswer">
	
	{{ Form::close() }}

</div>



@stop
{{--------------- END CONTENT ----------------}}
