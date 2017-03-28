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
	$bgColor = "bg-color-clear"; //opacity-1";
	$textColor = "color-2";
	$titleClass = "small title-bold extra-padding-small";
	$subtitleClass = "";
	$buttonSpacer = "spacer-large";
	$headerPadding = "page-padding-small-2";
	$useBackgroundPadding = true;
	switch ($theme) {
	
		case 1:
			$bgColor = "bg-color-10";
			$textColor = "color-1";
			$titleClass = "title-regular small extra-padding";
			$subtitleClass = "title-regular extra-padding-small clear-header-margins";
			$buttonSpacer = "spacer-small-2";
			$headerPadding = "page-padding-medium-2";
			$useBackgroundPadding = false;
		break;	
		
	} 
	
?>


{{-- background image --}}
@if ($useBackgroundPadding)

	@include('soup::sections.background', ['backgroundImage' => $backgroundImage, 'loadGroup' => '{{ $sectionId }}'])

	<div class="page-overlay {{ $bgColor }}" load-style="fade" load-group="{{ $sectionId }}">
@else
	<div class="page-section {{ $bgColor }}">
@endif


	{{-- center content vertically --}}
	<div class="table-parent fill-height">
		<div class="table-center-row fill-height">
			<div class="table-center-cell">
			
				<div class="text-center page-padding-small-2">
					
					{{-- title --}}
					@if (isset($title))
						@if ($theme==1)
							<div class="spacer-tiny"></div>
							<h1 class="{{ $titleClass }} {{ $textColor }}">{!! $title !!}</h1>			
						@else
							<h1 class="{{ $titleClass }} {{ $textColor }}">{!! $title !!}</h1>
							<div class="spacer-medium"></div>
							<div class="spacer-tiny-2"></div>
						@endif
					@endif
				
				</div>
				
				<div class="text-center page-padding-small-2">
				
					@if (isset($subtitle))
						<h3 class="{{ $subtitleClass }} {{ $textColor }}">{!! $subtitle !!}</h3>
						<div class="spacer-small"></div>
					@endif
					
				</div>
				
				
				<div class="text-center page-padding-small">
					
					{{-- draw image --}}
					@if (isset($image) && strlen($image)>0)	
						<div class="spacer-small-2"></div>		
						<img src="{{ $image }}" class="section-image" load-style="fade" load-group="{{ $sectionId }}">
					@endif
					
					
				</div>
				
				<div class="text-center page-padding-medium">
					
					{{-- TODO: handle URL --}}
						@if (isset($button))
							<div class="{{ $buttonSpacer }}"></div>
							<a href="{{ route('soup.signup') }}" class="button-page-border title-semi-bold border-color-4 bg-color-2">
								<h4 class="clear-header-margins">{{ $button }}</h4>
							</a>
						@endif
						
				</div>
			
				<div class="spacer-small-2"></div>
				
			</div>
		</div>
	</div>

</div>

