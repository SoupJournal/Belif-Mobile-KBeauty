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
		$key = safeArrayValue('key', $pageData, "");
		$type = safeArrayValue('type', $pageData, "");
		$question = safeArrayValue('question', $pageData, "");
		$text = safeArrayValue('text', $pageData, "");
		$answer = safeArrayValue('options', $pageData, "");
		$backgroundImage = safeArrayValue('background_image', $pageData, "");
		$theme = safeArrayValue('theme', $pageData, 0);
	
		//form submit URL
		$formURL = isset($formURL) ? $formURL : "";
		$formURL = route('soup.question');
		
		//answer images
		$image_yes = "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/answer_yes.png";
		$image_no = "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/answer_no.png";
	
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


<div class="page-overlay background-fill question-overlay">


	{{ Form::open(Array('role' => 'form', 'name' => 'questionForm', 'url' => $formURL, 'class' => 'stretch-to-fit', 'id' => 'question-container')) }}

		{{-- text overlay --}}
		<div class="stretch-to-fit" swipe-view id="question-container">
		
			{{-- background image --}}
			<img class="page-image" src="{{ $backgroundImage }}" load-style="fade" load-group="main">

		
		
			{{-- top row --}}
			<div class="container-top">
			
				<div class="spacer-large"></div>
				
				<div class="row page-padding-medium">
				
					{{-- question --}}
					<h1 class="title-regular color-2">{{ $question }}</h1>
				
					<h3 class="color-2">{{ $text }}</h3>
				
				</div>
		
			</div>
		
		
			{{-- center row --}}
			<div class="text-center row-centered page-padding-tiny">
				
					<h1 class="title-bold large color-2">{{ $answer }}</h1>	
		
			</div>
		
		
		</div>
	
	
		
		{{-- buttons overlay --}}
		<div class="stretch-to-fit">
		
			{{-- bottom row --}}
			<div class="container-bottom">
			
				<div class="spacer-large"></div>
				<div class="spacer-large"></div>
				
				<div class="row">
				
					<div class="button-answer-container pull-left" swipe-fade-view="left">
						<button class="button-answer answer-reject stretch-to-fit">
							<img src="{{ $image_no }}" class="answer_image" load-style="fade">
						</button>
					</div>
					<div class="button-answer-container pull-right">
						<button class="button-answer answer-accept stretch-to-fit" swipe-fade-view="right">
							<img src="{{ $image_yes }}" class="answer_image" load-style="fade">
						</button>
					</div>
				
				</div>
		
			</div>
		
		</div>
	
		{{-- answer field for javascript submits --}}
		<input type="hidden" name="scriptAnswer">
	
		{{-- question key --}}
		<input type="hidden" name="key" value="{{ $key }}">
		
		{{-- question type --}}
		<input type="hidden" name="type" value="{{ $type }}">
	
	{{ Form::close() }}

</div>



@stop
{{--------------- END CONTENT ----------------}}
