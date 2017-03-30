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
		//$key = safeArrayValue('key', $pageData, "");
		$title = safeArrayValue('title', $pageData, "");
		$subtitle = safeArrayValue('subtitle', $pageData, "");
		$text = safeArrayValue('text', $pageData, "");
		$backgroundImage = safeArrayValue('background_image', $pageData, "");
		$theme = safeArrayValue('theme', $pageData, 0);
		$step = isset($step) ? $step : 0;
		$totalSteps = isset($totalSteps) ? $totalSteps : 0;

		//form submit URL
		$formURL = isset($formURL) ? $formURL : "";
		
		
		//answer images
		$image_yes = "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/answer_yes.png";

	
	?>
	
@stop
{{--------------- END SCRIPTS ----------------}}





{{----------------- CONTENT ------------------}}

@section('content')



{{-- hidden background image for page sizing --}}
<!-- <img class="page-image clear" src="{{ $backgroundImage }}"> -->


<div swipe-gesture class="stretch-to-fit swipe-view"></div>

{{-- answer selection --}}
<!-- div id="question-container" class="stretch-to-fit" -->


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
				
					{{-- subtitle --}}
					<h1 class="title-light color-2">{!! $subtitle !!}</h1>
				
				</div>
		
			</div>
		
		
			<div class="row-centered">
			
				<div class="row page-padding-small">
				
					{{-- main title --}}
					<h1 class="title-bold medium-2 color-2">{!! $title !!}</h1>
				
					<div class="spacer-large"></div>
				
				</div>
			
			</div>
		
		</div>
	
	
		
		{{-- buttons overlay --}}
		<div class="stretch-to-fit">
		
			{{-- bottom row --}}
			<div class="container-bottom page-padding-small">

	
					{{-- help --}}
					<div class="question-text"><h3 class="title-light color-2">{!! $text !!}</h3></div>
					
					<div class="spacer-large"></div>
					<div class="spacer-tiny-2"></div>
					
					
					{{-- yes --}}
					<div class="button-answer-container">
						<button name="value" value="1" class="button-answer answer-accept stretch-to-fit">
							<img src="{{ $image_yes }}" class="answer_image" load-style="fade">
						</button>
					</div>
				

				
				<div class="spacer-small-2"></div>
		
			</div>
		
		</div>
	
		{{-- answer field for javascript submits --}}
		<input type="hidden" name="scriptValue">
	

	
	{{ Form::close() }}

</div>



@stop
{{--------------- END CONTENT ----------------}}




{{----------------- FOOTER ------------------}}

@section('footer')

	<div class="progress-footer">
		<div class="main-page">
		
			{{----------------- PROGRESS BAR -------------------}}
			<div class="progress-section page-padding-tiny">
				@include('soup::sections.progress', Array(
					'step' => $step,
					'total' => $totalSteps
				))
			</div>
			
		</div>
	</div>

@stop
