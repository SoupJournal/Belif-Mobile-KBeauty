<?php

	//ensure page variables are set
	$sectionId = isset($sectionId) ? $sectionId : "";
	$pageData = isset($pageData) ? $pageData : null;

	//get page variables
	$title = safeArrayValue('title', $pageData, null);
	$subtitle = safeArrayValue('subtitle', $pageData, null);
	$text = safeArrayValue('text', $pageData, null);
	$button = safeArrayValue('button', $pageData, null);
	$image = safeArrayValue('image', $pageData, null);
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	$theme = safeArrayValue('theme', $pageData, 0);
//	
//	//set theme properties
//	$bgColor = "bg-color-opacity-1";
//	$textColor = "color-2";
//	$titleClass = "bold";
//	$subtitleClass = "";
//	switch ($theme) {
//	
//		case 1:
//			$bgColor = "bg-color-2";
//			$textColor = "color-1";
//			$titleClass = "title-regular";
//			$subtitleClass = "title-regular";
//		break;	
//		
//	} 
//	
?>



{{-- background image --}}
@include('soup::sections.background', ['backgroundImage' => $backgroundImage, 'loadGroup' => '{{ $sectionId }}', 'paddingHeight' => '140%'])

<div class="page-overlay bg-color-clear" load-style="fade" load-group="{{ $sectionId }}">

	<div class="text-center page-padding-medium">
		
		@if (isset($button))
			<div class="spacer-large"></div>
			<div class="spacer-small"></div>
			
			<a href="{{ route('soup.signup') }}" class="button-page-border title-semi-bold border-color-4 bg-color-2">
				<h4 class="clear-header-margins">{{ $button }}</h4>
			</a>
		@endif
			
	</div>

</div>

