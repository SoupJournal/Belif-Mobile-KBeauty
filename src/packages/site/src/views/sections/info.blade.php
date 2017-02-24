<?php

	//ensure page data is set
	$pageData = isset($pageData) ? $pageData : null;

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	
?>



		{{-- background image --}}
		<img class="page-image" src="{{ $background_image }}" load-style="fade">
		
		<div class="stretch-to-fit">

			<div class="text-center row-centered page-padding-large">
				
					{{-- title --}}
					<h2 class="bold color-2">{{ $title }}</h2>
				
					<h4 class="color-2">{{ $subtitle }}</h4>
				
				
				{{-- TODO: handle URL --}}
					@if (isset($button))
						<a href="{{ route('soup.signup') }}" class="button-page">{{ $button }}</a>
					@endif
					
			</div>
			
		</div>
	
