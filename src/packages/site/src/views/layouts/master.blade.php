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
    
    
    <body ng-app="soup"> 
   
   
    
		{{-- controller --}}
		<div class="{{ ($fullScreen) ? 'main-page-full' : 'main-page' }} page-text" ng-controller="SoupController">
			

	   		{{----------------- HEADER -------------------}}
	    	@include('soup::layouts.header')
	   		
	

			<div class="item top-margin-small">
			
			
				<div class="text-center">
				
					{{-- section start --}}
					<div class="page-container">
			
			    <!-- div class="row" -->
			    
			   <!-- 	
			    	<div class="col-md-12" style="padding:0">
					
			            <div class="background-proportional content main-body">
					    	
					    	<div id="page-content-wrapper">
					        	<div class='stretch-to-fit'>
-->
					        		{{----------------- CONTENT ------------------}}
					        		@yield('content')
					        		{{--------------- END CONTENT ----------------}}
			<!--		        		
					       	 	</div>
					        </div>
			        
						</div>
	           
	        		</div>
	        -->
	        	<!-- /div -->
	        	
					</div>
					{{-- section end --}}
				
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