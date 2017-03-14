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


	{{ Form::open(Array('role' => 'form', 'name' => 'questionForm', 'url' => $formURL, 'class' => 'stretch-to-fit', 'id' => 'question-container')) }}

	
		{{-- top row --}}
		<div class="container-top">
		
		
			
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
			
			
			<div class="row page-padding-medium">

				<?php
				
					//show answers
					foreach ($options as $option) {
				?>
				
					<div class="button-checkbox">
					   	<label class="color-2">
					   	
					   		{{ Form::checkbox($option, $option, false, Array ('class' => 'multiple-choice', 'checkbox-limit' => $allowedChoices, 'checkbox-group' => 'choices')) }}
					   		<h1 class="title-bold large color-2 clear-header-margins">{{ $option }}</h1>
	
						</label>
					</div>
				
				
				<?php
				
					} //end for()
					
				?>
			
			</div>
			
			@if (isset($text))
				<div class="row page-padding-small">
				
					{{-- second question --}}
					<h1 class="title-light color-2">{!! $text !!}</h1>
				
	
				</div>
				
					
				<div class="row page-padding-large">
				
					{{-- dropdown --}}
					{{ Form::text('option2', $selected, Array ('class' => 'page-input-select')) }}
				
				</div>	
				
			@else
				<div class="spacer-medium"></div>
			@endif
			
			
			
			
			{{-- next button --}}
			@if (isset($button))

				<div class="spacer-large"></div>
				
				<button class="button-page button-page-border bg-color-clear color-3 border-color-3">{{ $button }}</button>
			@endif
			
			
		</div>


		{{-- bottom row --}}
		<div class="progress-footer">
			
			{{----------------- PROGRESS BAR -------------------}}
			<div class="progress-section page-padding-tiny">
				@include('soup::sections.progress', Array(
					'step' => $step,
					'total' => $totalSteps
				))
			</div>
				
		</div>


		{{-- question key --}}
		<input type="hidden" name="key" value="{{ $key }}">

	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
