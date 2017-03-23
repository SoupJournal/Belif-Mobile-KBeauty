<?php

	use Soup\Mobile\Lib\AppGlobals;
	

	//get header styling
	$headerStyle = isset($headerStyle) ? $headerStyle : AppGlobals::HEADER_STYLE_NORMAL;
	$hideHeaderTitle = isset($hideHeaderTitle) ? $hideHeaderTitle : false;
	$menuOptions = isset($menuOptions) ? $menuOptions : null;

	//determine if menu visible
	$showMenuButton = ($menuOptions && count($menuOptions)>0);

	//header settings
	$headerPadding = "14%";
	$backgroundColor = "bg-color-5";
	$textColour = "color-2";
	$headerImageClass = "";
	$headerImage = "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/logo-soup-white.png";
	$menuImage = "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/icon-menu.png";
	
	//custom header style
	switch ($headerStyle) {
		
		case AppGlobals::HEADER_STYLE_BLACK:
		{
			$backgroundColor = "bg-color-1";
		}
		break;
		
		case AppGlobals::HEADER_STYLE_WHITE:
		{
			$headerPadding = "16%";
			$backgroundColor = "bg-color-10";
			$textColour = "color-1";
			$headerImageClass = "large";
			$headerImage = "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/logo-soup-black.png";
		}
		break;
		
	} //end switch (header style)
	
	
?>
{{-- header --}}
<div id="page-header" class="header navbar navbar-top {{ $backgroundColor }} {{ $textColour }}">

	<div class="header-fill" style="padding-bottom: {{ $headerPadding }}"></div>
	
	<div class="stretch-to-fit">

	<div class="table-parent fill-height">

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
						<img class="logo-header-image {{ $headerImageClass }}" alt="Soup" src="{{ $headerImage }}" load-style="fade">
				@endif
			
			</div>
		   	
		   	
		   	
		   	<div class="table-center-cell header-column-right">
		   	
				{{-- next button --}}
				@if (isset($nextURL) && isset($nextLabel))
					<a href="{{ $nextURL }}" class="button-header button-next color-1">{{ $nextLabel }}</a>
				@endif
			
				{{-- menu button --}}
				@if ($showMenuButton)
					<a href="javascript:void(0)" class="button-header color-1" broadcast-click="change-menu-height">
						<img class="button-menu" alt="Soup" src="{{ $menuImage }}" load-style="fade">
					</a>
				@endif
			
			</div>
		
		
		</div>

	</div>
	
	</div>

</div>

{{-- menu --}}
<div class="menu-overlay bg-color-opacity-5" toggle-height="100%" event-name="change-menu-height">
	@include('soup::sections.menu', Array(
		'options' => $menuOptions,
	))
</div>

    	