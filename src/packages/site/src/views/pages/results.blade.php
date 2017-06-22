@extends('belif::layouts.master')


{{------------------ TITLE -------------------}}

@section('title') Belif @stop

{{---------------- END TITLE -----------------}}




{{----------------- SCRIPTS ------------------}}

@section('scripts')

	{{-- HTML::script('packages/artisan/cms/js/cms/form/form.js') --}}	
	
	<?php
	
		//set custom page controllers
		//$pageModules = Array('cms.form');
	
	?>
	
@stop
{{--------------- END SCRIPTS ----------------}}





{{----------------- CONTENT ------------------}}

@section('content')

<?php

	//ensure page properties are set
	$results = isset($results) ? $results : null;
	$buttonURL = isset($buttonURL) ? $buttonURL : null;
	$restartURL = isset($restartURL) ? $restartURL : '';

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$html = safeArrayValue('html', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$buttonCancel = safeArrayValue('button_cancel', $pageData, "");
	
	//determine number of questions
	$numberOfQuestions = count($results);
	
	//determine number of correct answers
	$correctAnswers = 0;
	foreach ($results as $result) {
		if ($result) {
			++$correctAnswers;
		}
	}
	
	//determine number of samples
	$numberOfSamples = 0;
	if ((floatval($correctAnswers) / $numberOfQuestions) > 0.5) {
		$numberOfSamples = 2;
	}
	else if ((floatval($correctAnswers) / $numberOfQuestions) > 0.35) {
		$numberOfSamples = 1;
	}
	
	//answer images
	$imageRight = asset($assetPath . "/images/icon-answer-right.png");
	$imageWrong = asset($assetPath . "/images/icon-answer-wrong.png");
	
	
?>

<div class="text-center">
	
	<div class="container-top">
		
		<div class="row page-margin-small">
		
		
			<div class="spacer-large"></div>
			
		
			{{-- title --}}
			<h2 class="color-2 no-margins">{{ $title }}</h2>
			<h2 class="color-2 no-margins">
				You got {{ $correctAnswers }} out of {{ $numberOfQuestions }} correct!
			</h2>
			<h2 class="title-light color-2 no-margins">
				You can have {{ $numberOfSamples }} samples.
			</h2>
		
		
			<div class="spacer-tiny"></div>
	

			{{-- question results --}}
			@if ($results) 
				@for ($i=0; $i<count($results); ++$i)
				
					<h2 class="title-3 color-2 no-margins results-answer">
						<span class="results-item"><img src="{{ $imageRight }}" class="results-value-image"></span>
						<span class="results-item">Question {{ ($i+1) }}</span>
					</h2>
					
				@endfor
			@endif

			<div class="spacer-small"></div>
		
		
			{{-- image --}}
			@if ($image && strlen($image)>0) 
				<div class="page-padding-larger">
					<img src="{{ $image }}" class="page-image" load-style="fade" load-group="page">
				</div>
			@endif
		
		
			<div class="spacer-small"></div>
		
		
			<!-- load group -->
			<div load-style="fade" load-group="page">
		
				{{-- next button --}}
				<a href="{{ $buttonURL }}" class="button-page bg-color-3 color-2" label="{{ $button }}">
					{{ $button }}
				</a>
					
				<div class="spacer-tiny"></div>
				
				
				{{-- restart --}}
				<a href="{{ $restartURL }}">
					<h4 class="title-regular color-1 box-padding">{{ $buttonCancel }}</h4>
				</a>
			
		
			</div>
			<!-- load group -->
		
			<div class="spacer-small"></div>
		
		</div>

	</div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
