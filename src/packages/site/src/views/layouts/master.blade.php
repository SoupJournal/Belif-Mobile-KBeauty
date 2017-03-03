<?php

	//define variables
	$fullScreen = (!isset($fullScreen) ? false : $fullScreen);

?>
<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        
        
        {{------------------ TITLE -------------------}}
        
        <title>{{-- @yield('title') --}}Soup</title>
        
        {{---------------- END TITLE -----------------}}
        
        
        {{----------------- SCRIPTS ------------------}}
	    @include('soup::general.scripts')
        

    </head>
    
    
    <body ng-app="soup" class="bg-color-1"> 
   
   
    
		{{-- controller --}}
		<div class="{{ ($fullScreen) ? 'main-page-full' : 'main-page' }} page-text stretch-to-fit" ng-controller="SoupController">
			
			<div class="main-page-container fill-height bg-color-5">
				
	
		   		{{----------------- HEADER -------------------}}
		    	@include('soup::layouts.header')
		   		

	
			
				<div class="page-body text-center">


	        		{{----------------- CONTENT ------------------}}
	        		@yield('content')
	        		{{--------------- END CONTENT ----------------}}

				
				</div>
				
			</div>	        	
	
	        
        {{-- end controller --}}
        </div>
        
        
        
        
        
        {{-- load angular modules --}}
        <script type="text/javascript">
	     <!--			     
			//anonymous function to load features without name conflicts
			(function() {
		        
				//load modules
				var app = angular.module('soup', ['ngResource', 'ui.bootstrap', 'soup-core', 'soup-gui', 'swipe-gesture', 'forms']);   
			
			})();
			//end anonymous function
         // -->
        </script>
        
    </body>
</html>