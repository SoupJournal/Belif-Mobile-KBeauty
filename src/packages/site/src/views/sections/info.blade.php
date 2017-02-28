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
<img class="page-image" src="{{ $backgroundImage }}" load-style="fade">


	
<div class="page-overlay bg-color-opacity-1">

	<div class="text-center row-centered page-padding-large">
		
			{{-- title --}}
			<h2 class="bold color-2">{{ $title }}</h2>
		
			<h4 class="color-2">{{ $subtitle }}</h4>
		
		
		{{-- TODO: handle URL --}}
			@if (isset($button))
				<a href="{{ route('soup.signup') }}" class="button-page bg-color-4">{{ $button }}</a>
			@endif
			
	</div>

</div>

