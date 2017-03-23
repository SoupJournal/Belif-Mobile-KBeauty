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
	$option = safeArrayValue('options', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	$step = safeArrayValue('step', $pageData, 0);
	$totalSteps = isset($totalSteps) ? $totalSteps : 0;
	
	//form submit URL
	$formURL = isset($formURL) ? $formURL : "";

	//TODO: get current selection??
	$selected = null;
	
?>


{{-- background image --}}
@include('soup::sections.background', ['backgroundImage' => $backgroundImage, 'loadGroup' => 'main'])


<div class="text-center">


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
			
			
			<div class="spacer-medium"></div>
				
	
			<div class="row page-padding-large">
			
				{{-- dropdown --}}
				{{ Form::text('value', $selected, Array ('placeholder' => $option, 'class' => 'page-input-select', 'required' => '')) }}
			
			</div>	
			
			
			
			{{-- next button --}}
			@if (isset($button))
				<div class="spacer-large"></div>
				<div class="spacer-medium"></div>
			
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
