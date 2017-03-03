<?php

	//ensure page variables are set
	$sectionId = isset($sectionId) ? $sectionId : "";
	$pageData = isset($pageData) ? $pageData : null;

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$steps = safeArrayValue('steps', $pageData, null);
	
//	$text = safeArrayValue('text', $pageData, "");
//	$button = safeArrayValue('button', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	
?>




<div class="page-container bg-color-opacity-1" load-style="fade" load-group="{{ $sectionId }}">

	<div class="text-center page-padding-large">
		
			{{-- title --}}
			<h2 class="bold color-2">{{ $title }}</h2>
		
		
		<?php
		
			//has steps
			if ($steps) {
		
				//draw steps
				foreach ($steps as $step) {
					
					//get step properties
					$image = safeArrayValue('image', $step, null);
					$text = safeArrayValue('text', $step, "");
		?>
		
					{{-- draw image --}}
					@if (isset($image) && strlen($image)>0)			
						<img src="{{ $image }}" class="section-image" load-style="fade" load-group="{{ $sectionId }}">
					@endif
					
					{{-- draw text --}}
					<div>{!! $text !!}</div>
		
		<?php
		
				} //end for
			
			} //end if (has steps)
		?>
			
	</div>

</div>

