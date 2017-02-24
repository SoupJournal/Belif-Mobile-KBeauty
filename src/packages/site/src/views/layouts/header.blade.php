<?php

	//get header styling
	$useAlternateStyle = isset($alternateHeader) && $alternateHeader;
	$hideHeaderTitle = isset($hideHeaderTitle) ? $hideHeaderTitle : false;

	//header colours
	$backgroundColor = "bg-color-1";
	$textColour = "color-2";
	if ($useAlternateStyle) {
		$backgroundColor = "bg-color-2";
		$textColour = "color-1";
	}
	
?>
{{-- header --}}
<div id="page-header" class="header navbar navbar-top {{ $backgroundColor }} {{ $textColour }}">


	{{-- back button --}}
	@if (isset($backURL))
		<a href="{{ $backURL }}" class="button-back pull-left {{ $textColour }}">BACK</a>
	@endif


	{{-- title --}}
	@if (!$hideHeaderTitle)	
		<div class="text-center">
			<h1 class="font-header {{ $textColour }}">Soup</h1>
		</div>
	@endif
   	
   	
	{{-- next button --}}
	@if (isset($nextURL) && isset($nextLabel))
		<a href="{{ $nextURL }}" class="button-next pull-right color-3">{{ $nextLabel }}</a>
	@endif


</div>

    	