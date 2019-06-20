<?php
	$fullScreen = isset($fullScreen) ? $fullScreen : false;
	$pagetitle = isset($pagetitle) ? $pagetitle : 'Sulwhasoo';
	$fillHeight = isset($fillHeight) ? $fillHeight : true;
	$backgroundImage = isset($backgroundImage) ? $backgroundImage : null;
	$backgroundFill = isset($backgroundFill) ? $backgroundFill : false;
?>
<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        
        {{------------------ TITLE -------------------}}
        
        <title>{{ $pagetitle }}</title>
        
        {{---------------- END TITLE -----------------}}
        
        
        {{----------------- SCRIPTS ------------------}}
	    @include('belif::general.scripts')

		{{-- preloading (for modern browsers) --}}
		@if (isset($backgroundImage) && strlen($backgroundImage)>0)
			<link rel="preload" href="{{ $backgroundImage }}" as="image">
		@endif

    </head>
    
    <body ng-app="sulwhasoo">
   
		<div class="{{ ($fullScreen) ? 'main-page-full' : 'main-page' }} page-text stretch-to-fit @yield('background-color', 'bg-color-2')">
			
			<div class="main-page-container fill-height @yield('background-color', 'bg-color-2') color-2">
	
		   		{{----------------- HEADER -------------------}}
		   		@if (!$fullScreen) 
			    	@include('belif::layouts.header')
		    	@endif

				@if ($fillHeight)
					<div class="page-body text-center @yield('background-color', 'bg-color-2')" fill-height>
				@else
					<div class="page-body text-center @yield('background-color', 'bg-color-2')">
				@endif

					@if (isset($backgroundImage) && strlen($backgroundImage)>0)
						<img class="background-scale-fill" src="{{ $backgroundImage }}" load-style="fade" load-group="background">
					@else
						<div class="background-fill"></div>
					@endif
					
					<div class="stretch-to-fit">

						<?php if ($_SERVER['REQUEST_URI'] != '/desktop') { ?>
						<div class="header-logo"><img alt="{{ $pagetitle }}" src="{{ $headerLogoUrl }}" load-style1="fade"/></div>
						<?php } ?>

	        		{{----------------- CONTENT ------------------}}
	        		@yield('content', '')
	        		{{--------------- END CONTENT ----------------}}

					</div>
								
				</div>
			
			</div>	        	
              
        </div>

    </body>
</html>