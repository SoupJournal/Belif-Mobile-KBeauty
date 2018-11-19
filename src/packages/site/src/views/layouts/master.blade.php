<?php

	//define variables
	$fullScreen = isset($fullScreen) ? $fullScreen : false;
	$pagetitle = isset($pagetitle) ? $pagetitle : 'VDL';
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
    
    
    <body ng-app="vdl">
   

		<div class="{{ ($fullScreen) ? 'main-page-full' : 'main-page' }} page-text stretch-to-fit @yield('background-color', 'bg-color-5')">
			
			<div class="main-page-container fill-height @yield('background-color', 'bg-color-2') color-2">
				
	
		   		{{----------------- HEADER -------------------}}
		   		@if (!$fullScreen) 
			    	@include('belif::layouts.header')
		    	@endif
		   		
			
				@if ($fillHeight)
				<div class="page-body text-center @yield('background-color', 'bg-color-5')" fill-height>
				@else 
				<div class="page-body text-center @yield('background-color', 'bg-color-5')">				
				@endif


					@if (isset($backgroundImage) && strlen($backgroundImage)>0)
						<img class="background-proportional" src="{{ $backgroundImage }}" load-style="fade" load-group="background">
					@else
						<div class="background-fill"></div>
					@endif
					
					<div class="stretch-to-fit">

	        		{{----------------- CONTENT ------------------}}
	        		@yield('content', '')
	        		{{--------------- END CONTENT ----------------}}

					</div>
								
				</div>
			
			</div>	        	
	                
              
        </div>
 
        
 		<div class="main-page">
	 		<div class="main-page-container">

		  		{{----------------- FOOTER ------------------}}
		   		@yield('footer', '')
		   		{{--------------- END FOOTER ----------------}}

			</div>
 		</div>
 
        
        
        {{-- load angular modules --}}
        <script type="text/javascript">
	     			     
			//anonymous function to load features without name conflicts
			(function() {
		        
				//load modules
				var app = angular.module('belif', ['ngResource', 'ui.bootstrap', 'belif-core', 'belif-gui', 'swipe-gesture'],  
				
					//replace code brackets so as not to conflict with Blade
					function($interpolateProvider) {
					    $interpolateProvider.startSymbol('#{');
					    $interpolateProvider.endSymbol('}#');
					}
				);   
			
			})();
			//end anonymous function
        
        </script>
        
    </body>
</html>