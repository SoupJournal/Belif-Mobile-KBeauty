@extends('soup::layouts.master')


{{------------------ TITLE -------------------}}

@section('title') Soup @stop

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

	//get page variables
	$key = safeArrayValue('key', $pageData, "");
	$question = safeArrayValue('question', $pageData, "");
	$optionsJSON = safeArrayValue('options', $pageData, "");
	$settingsJSON = safeArrayValue('settings', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	$step = safeArrayValue('step', $pageData, 0);
	$totalSteps = isset($totalSteps) ? $totalSteps : 0;
	
	//decode options
	$options = null;
	$settings = null;
	if (strlen($optionsJSON)>0) {
		try {
			$options  = json_decode($optionsJSON);
			$settings = json_decode($settingsJSON);
		}
		catch (Exception $ex) {
			
		}
	}
	
	//determine number of allowed selections
	$allowedChoices = safeObjectValue('choices', $settings, 1);
	
	//TODO: get current selection??
	$selected = null;
	
	
	//form submit URL
	$formURL = isset($formURL) ? $formURL : "";
	
?>


{{-- background image --}}
@include('soup::sections.background', ['backgroundImage' => $backgroundImage, 'loadGroup' => 'main'])


<div class="page-overlay text-center">


	{{ Form::open(Array('role' => 'form', 'name' => 'questionForm', 'url' => $formURL, 'class' => '')) }}

	
		{{-- top row --}}
		<div class="page-padding-medium-2">
		
	
				<div class="spacer-small"></div>
	
					
				{{-- question --}}
				<h1 class="small-2 title-light color-2">{!! $question !!}</h1>
			

				<div class="spacer-small"></div>


				<?php
				
					//show answers
					$index = 0;
					foreach ($options as $option) {
				?>
				
					<div class="button-checkbox">
					   	<label class="color-2">
					   	
					   		{{ Form::checkbox('value[' . ($index++) . ']', $option, false, Array ('class' => 'multiple-choice', 'checkbox-limit' => $allowedChoices, 'checkbox-group' => 'choices')) }}
					   		<h1 class="title-bold medium-2 color-2 clear-header-margins no-margins">{{ $option }}</h1>
	
						</label>
					</div>
				
				
				<?php
				
					} //end for()
					
				?>
			
		
			
			@if (isset($text))
				
				<div class="spacer-medium"></div>
				
				<div>
				
					{{-- second question --}}
					<h1 class="title-light small color-2 clear-header-margins">{!! $text !!}</h1>
				
				
					{{-- text input --}}
					{{ Form::textarea('secondaryValue', $selected, Array ('class' => 'page-input-text square input-padding-small', 'rows' => 2)) }}

				</div>
			
			@else
				<div class="spacer-medium"></div>
			@endif
			
		</div>
		
		<div class="page-padding-small">	
			
			
			{{-- next button --}}
			@if (isset($button))

				<div class="spacer-medium"></div>
				<div class="spacer-small"></div>
				
				<button class="button-page button-page-border bg-color-clear color-3 border-color-3">{{ $button }}</button>
			@endif
			
			
		</div>



		{{-- question key --}}
		<input type="hidden" name="key" value="{{ $key }}">

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
