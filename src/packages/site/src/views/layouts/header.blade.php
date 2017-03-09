<?php

	//get header styling
	$useAlternateStyle = isset($alternateHeader) && $alternateHeader;
	$hideHeaderTitle = isset($hideHeaderTitle) ? $hideHeaderTitle : false;

	//header colours
	$backgroundColor = "bg-color-5";
	$textColour = "color-2";
	$headerImage = "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/logo-soup-white.png";
	if ($useAlternateStyle) {
		$backgroundColor = "bg-color-2";
		$textColour = "color-1";
		$headerImage = "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/logo-soup-black.png";
	}
	
?>
{{-- header --}}
<div id="page-header" class="header navbar navbar-top {{ $backgroundColor }} {{ $textColour }}">

	<div class="table-parent">

		<div class="table-center-row">
		
			<div class="table-center-cell header-column-left">
			
				{{-- back button --}}
				@if (isset($backURL))
					<a href="{{ $backURL }}" class="button-header button-back {{ $textColour }}">BACK</a>
				@endif
		
			</div>
		
		
			<div class="table-center-cell header-column-center text-center">
		
				{{-- title --}}
				@if (!$hideHeaderTitle)	
						<!-- h1 class="font-header {{ $textColour }}">Soup</h1 -->
						<img class="logo-header-image" alt="Soup" src="{{ $headerImage }}" load-style="fade">
				@endif
			
			</div>
		   	
		   	
		   	
		   	<div class="table-center-cell header-column-right">
		   	
				{{-- next button --}}
				@if (isset($nextURL) && isset($nextLabel))
					<a href="{{ $nextURL }}" class="button-header button-next color-1">{{ $nextLabel }}</a>
				@endif
			
			</div>
		
		
		</div>

	</div>

</div>

    	