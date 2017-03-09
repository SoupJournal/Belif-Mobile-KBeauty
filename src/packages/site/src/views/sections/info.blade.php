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
	
	//set theme properties
	$bgColor = "bg-color-opacity-1";
	$textColor = "color-2";
	$titleClass = "bold";
	$subtitleClass = "";
	switch ($theme) {
	
		case 1:
			$bgColor = "bg-color-2";
			$textColor = "color-1";
			$titleClass = "title-regular";
			$subtitleClass = "title-regular";
		break;	
		
	} 
	
?>



{{-- background image --}}
@include('soup::sections.background', ['backgroundImage' => $backgroundImage, 'loadGroup' => '{{ $sectionId }}'])

<div class="page-overlay {{ $bgColor }}" load-style="fade" load-group="{{ $sectionId }}">

	<div class="text-center row-centered page-padding-large">
		
		{{-- title --}}
		@if (isset($title))
			<h2 class="{{ $titleClass }} {{ $textColor }}">{!! $title !!}</h2>
		@endif
	
		@if (isset($subtitle))
			<h4 class="{{ $subtitleClass }} {{ $textColor }}">{!! $subtitle !!}</h4>
		@endif
		
		{{-- draw image --}}
		@if (isset($image) && strlen($image)>0)			
			<img src="{{ $image }}" class="section-image" load-style="fade" load-group="{{ $sectionId }}">
		@endif
		
		{{-- TODO: handle URL --}}
			@if (isset($button))
				<div class="spacer-large"></div>
				<a href="{{ route('soup.signup') }}" class="button-page-border border-color-4 bg-color-2">{{ $button }}</a>
			@endif
			
	</div>

</div>

