@extends('belif::layouts.master')


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
		$question = safeArrayValue('question', $pageData, "");
		$text = safeArrayValue('text', $pageData, "");
		$answer = safeArrayValue('options', $pageData, "");
		$backgroundImage = safeArrayValue('background_image', $pageData, "");
		$theme = safeArrayValue('theme', $pageData, 0);
		$step = safeArrayValue('step', $pageData, 0);
		$totalSteps = isset($totalSteps) ? $totalSteps : 0;

		//form submit URL
		$formURL = isset($formURL) ? $formURL : "";
		
		
		//answer images
		$image_yes = "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/answer_yes.png";
		$image_no = "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/answer_no.png";
	
	?>
	
@stop
{{--------------- END SCRIPTS ----------------}}





{{----------------- CONTENT ------------------}}

@section('content')


{{-- controller --}}
<div ng-controller="BelifController">



	{{-- swipe view --}}
	<div swipe-gesture class="stretch-to-fit swipe-view"></div>



	
	{{-- answer selection --}}
	<div class="page-overlay stretch-to-fit question-overlay">
	
	
		{{ Form::open(Array('role' => 'form', 'name' => 'questionForm', 'url' => $formURL, 'class' => 'stretch-to-fit', 'id' => 'question-container')) }}
	
			{{-- text overlay --}}
			<div class="stretch-to-fit" swipe-view id="question-container">
			
				{{-- background image --}}
				<img class="page-image" src="{{ $backgroundImage }}" load-style="fade" load-group="main">
	
			
			
				{{-- top row --}}
				<div class="container-top page-padding-tiny">
				
				
					
					{{-- display form errors --}}
				    @if ($errors->has())
				    
				    
				        @foreach ($errors->all() as $error)
				            <div class='bg-danger alert clear-vertical-padding'>{{ $error }}</div>
				        @endforeach
				        
				    @else
						
						<div class="spacer-small"></div>
						
					@endif
					
					
					
					
					<div class="row page-padding-small">
					
						{{-- question --}}
						<h1 class="title-light color-2">{!! $question !!}</h1>
					
					</div>
			
				</div>
			
			
				{{-- center row --}}
				<div class="text-center row-centered page-padding-tiny">
					
						<h1 class="title-bold large color-2">{{ $answer }}</h1>	
						<div class="spacer-large"></div>
			
				</div>
			
			
			</div>
		
		
			
			{{-- buttons overlay --}}
			<div class="stretch-to-fit">
			
				{{-- bottom row --}}
				<div class="container-bottom page-padding-small">
	
					
					<div class="row">
					
						{{-- no --}}
						<div class="button-answer-container pull-left" swipe-fade-view="left">
							<button name="value" value="0" class="button-answer answer-reject stretch-to-fit" id="answer-reject">
								<img src="{{ $image_no }}" class="answer_image" load-style="fade">
							</button>
						</div>
						
						
						{{-- help --}}
						<div class="question-text"><h3 class="title-light color-2">{!! $text !!}</h3></div>
						
						
						{{-- yes --}}
						<div class="button-answer-container pull-right">
							<button name="value" value="1" class="button-answer answer-accept stretch-to-fit" swipe-fade-view="right" id="answer-accept">
								<img src="{{ $image_yes }}" class="answer_image" load-style="fade">
							</button>
						</div>
					
					</div>
			
			
					<div class="progress-footer">
			
						{{----------------- PROGRESS BAR -------------------}}
					{{--	<div class="progress-section page-padding-tiny">
							@include('belif::sections.progress', Array(
								'step' => $step,
								'total' => $totalSteps
							))
						</div>
					--}}
					</div>
					
					
					<div class="spacer-small-2"></div>
			
				</div>
			
			</div>
		
			{{-- answer field for javascript submits --}}
			<input type="hidden" name="scriptValue">
		
			{{-- question key --}}
			<input type="hidden" name="key" value="{{ $key }}">
	
		
		{{ Form::close() }}
	
	</div>

{{-- end controller --}}
</div>


@stop
{{--------------- END CONTENT ----------------}}




{{----------------- FOOTER ------------------}}

@section('footer')

	<div class="progress-footer">
		<div class="main-page">
		
			{{----------------- PROGRESS BAR -------------------}}
		{{--	<div class="progress-section page-padding-tiny">
				@include('belif::sections.progress', Array(
					'step' => $step,
					'total' => $totalSteps
				))
			</div>
			--}}
		</div>
	</div>

@stop
