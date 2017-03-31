<?php

	//define variables
	$fullScreen = isset($fullScreen) ? $fullScreen : false;
	$fillHeight = isset($fillHeight) ? $fillHeight : true;
	$pageName = isset($pageName) ? $pageName : 'soup';
	$backgroundColor = isset($backgroundColor) ? $backgroundColor : 'bg-color-1';
	

?>
<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        
        
        {{------------------ TITLE -------------------}}
        
        <title>{{-- @yield('title', '') --}}Soup</title>
        
        {{---------------- END TITLE -----------------}}
        
        
        {{----------------- SCRIPTS ------------------}}
	    @include('soup::general.scripts')
        

    </head>
    
    
    <body ng-app="soup" class="bg-color-1" ng-controller="SoupController"> 
   
   
    
		{{-- controller --}}
		<div class="{{ ($fullScreen) ? 'main-page-full' : 'main-page' }} page-text stretch-to-fit @yield('background-color', 'bg-color-5')">
			
			<div class="main-page-container fill-height @yield('background-color', 'bg-color-5')">
				
	
		   		{{----------------- HEADER -------------------}}
		   		@if (!$fullScreen) 
			    	@include('soup::layouts.header')
		    	@endif
		   		
			
				@if ($fillHeight)
				<div class="page-body text-center" fill-height min-ratio="1.4">
				@else 
				<div class="page-body text-center">				
				@endif

					<div class="background-fill"></div>
					
					<div class="stretch-to-fit @yield('background-color', 'bg-color-5')">

	        		{{----------------- CONTENT ------------------}}
	        		@yield('content', '')
	        		{{--------------- END CONTENT ----------------}}

					</div>
								
				</div>
			
			</div>	        	
	                
              
        {{-- end controller --}}
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
	     <!--			     
			//anonymous function to load features without name conflicts
			(function() {
		        
				//load modules
				var app = angular.module('soup', ['ngResource', 'ui.bootstrap', 'soup-core', 'soup-gui', 'swipe-gesture', 'forms', 'maps']);   
			
			})();
			//end anonymous function
         // -->
        </script>
        
    </body>
</html>