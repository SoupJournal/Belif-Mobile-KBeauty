<?php

	//ensure page variables are set
	$sectionId = isset($sectionId) ? $sectionId : "";
	$pageData = isset($pageData) ? $pageData : null;

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$steps = safeArrayValue('children', $pageData, null);
	
//	$text = safeArrayValue('text', $pageData, "");
//	$button = safeArrayValue('button', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	
?>




<div class="page-container bg-color-2" load-style="fade" load-group="{{ $sectionId }}">

	<div class="text-center page-padding-small-2">
		
		<div class="spacer-small-2"></div>
		
		{{-- title --}}
		<h1 class="clear-header-margins color-1">{{ $title }}</h1>

		<div class="spacer-small-2"></div>
		
		
		<?php
		
			//has steps
			if ($steps) {
		
				//draw steps
				foreach ($steps as $step) {
					
					//get step properties
					$stepImage = safeArrayValue('image', $step, null);
					$stepText = safeArrayValue('text', $step, "");
		?>
		
					<div class="">
		
						{{-- draw image --}}
						@if (isset($stepImage) && strlen($stepImage)>0)			
							<img src="{{ $stepImage }}" class="section-image" load-style="fade" load-group="{{ $sectionId }}">
						@endif
						
						<div class="spacer-tiny"></div>
						
						{{-- draw text --}}
						<h4 class="page-padding-medium title-regular color-1">{!! $stepText !!}</h4>
	
						<div class="spacer-tiny-2"></div>
					
					</div>
		
		<?php
		
				} //end for
			
			} //end if (has steps)
		?>
			
			
	</div>
	
	<div class="text-center page-padding-tiny">
			
		{{-- footer text --}}
		@if (isset($text))
			<div class="spacer-small"></div>
			<h4 class="color-1">{{ $text }}</h4>
		@endif
		
		
		<div class="spacer-medium"></div>
		
		
	</div>

</div>

