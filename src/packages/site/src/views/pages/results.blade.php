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
	$subtitle = safeArrayValue('subtitle', $pageData, "");
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
	if ((floatval($correctAnswers) / $numberOfQuestions) > 0.75) {
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
		
		
			<div class="spacer-medium"></div>
			<div class="spacer-tiny"></div>
			
		
			{{-- title --}}
			<h2 class="color-2 small-margins medium">{{ $correctAnswers>0 ? $title : $subtitle }}</h2>
			<h2 class="color-2 small-margins medium">
				You got {{ $correctAnswers }} out of {{ $numberOfQuestions }} correct!
			</h2>
			<h2 class="title-light color-2 small-margins medium">
				You can have {{ $numberOfSamples }} sample{{ $numberOfSamples==1 ? "" : "s" }}.
			</h2>
		
		
			<div class="spacer-small"></div>
	

			{{-- question results --}}
			@if ($results) 
				@for ($i=1; $i<=count($results); ++$i)
				
					<h4 class="title-semi-bold color-2 no-margins results-answer large">
						<span class="results-item">
							<img src="{{ safeArrayValue($i, $results) ? $imageRight : $imageWrong }}" class="results-value-image">
						</span>
						<span class="results-item">Question {{ ($i) }}</span>
					</h4>
					
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
				@if ($numberOfSamples>0)
					<a href="{{ $buttonURL }}" class="button-page bg-color-3 color-2" label="{{ $button }}">
						{{ $button }}
					</a>
				@endif
					

				
				
				{{-- restart --}}
				<a href="{{ $restartURL }}">
					<h4 class="title-regular color-1 box-padding">{{ $buttonCancel }}</h4>
				</a>
			
		
			</div>
			<!-- load group -->
		
			<div class="spacer-tiny"></div>
		
		</div>

	</div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
