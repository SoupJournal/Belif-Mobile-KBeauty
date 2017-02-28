//anonymous function to load features without name conflicts
(function() {
	
	//setup module
	var module = angular.module('soup-gui', ['ngResource']); 
	
	
	
	//pageButton directive - standard page button 
	module.directive('loadStyle', function($parse) {
	    return {
	    	restrict: 'A',
	 	    replace: false,
//	        scope: {
//	            loadStyle: '@'
//	        },
	        link: function (scope, element, attrs) {
	        	
	        	//styles
	        	var STYLE_FADE = 0;
	        	var STYLE_BLUR = 0;
	        	
	        	//set defaults
	        	scope.style = STYLE_FADE;
	        	scope.duration = 1.0;
	        	//fade
	        	scope.finalOpacity = 1.0;
	        	
	        	
	        	
	        	//found attributes
	        	if (attrs) {

	        		//store attributes in scope
	        		scope.loadStyle = attrs.loadStyle;
	        		scope.duration = (attrs.duration>0) ? attrs.duration : scope.duration;
	        		scope.group = attrs.loadGroup && attrs.loadGroup.length>0 ? attrs.loadGroup : null;
	        		
	        	} //end if (valid attributes)
	        	
	        	
	        	//determine style
	        	if (scope.loadStyle && scope.loadStyle.length>0) {
	        		
	        		//ensure lower case
	        		scope.loadStyle = scope.loadStyle.toLowerCase();
	        		
	        		if (scope.loadStyle=='blur') {
	        			scope.style = STYLE_BLUR;
	        		}
	        		
	        	} //end if (found style)
	        	
	        	
	        	
	        	scope.updateElement = function(target) {
	        		
	        		if (target) {
	        			
	        			//apply final configuration
			        	switch (scope.style) {
			        		
			        		case STYLE_FADE:
			        		{
			        			target.style.opacity = scope.finalOpacity;
			        		}
			        		break;
			        		
			        	} //end switch (style)
	        		}	
	        	} //end updateElement()
	        	
	        	
	        	
	        	//found element
	        	if (element) {
	        		
					//valid HTML element
		        	if (element[0]) {
		        	
			        	//apply initial configuration
			        	switch (scope.style) {
			        		
			        		case STYLE_FADE:
			        		{
			        			scope.finalOpacity = element[0].style.opacity;
			        			element[0].style.opacity = 0;
			        			element[0].style.transition = 'opacity ' + scope.duration + 's';
			        		}
			        		break;
			        		
			        	} //end switch (style)
			        	
	        		
		        	}
	        		
	        		
	        		//TODO: check element type
		
	        		//listen for load event
		        	element.bind("load" , function(e){ 

						//update element
		        		scope.updateElement(element[0]);
		        		/*
			        	if (element[0]) {
			        	
				        	//apply final configuration
				        	switch (scope.style) {
				        		
				        		case STYLE_FADE:
				        		{
				        			element[0].style.opacity = scope.finalOpacity;
				        		}
				        		break;
				        		
				        	} //end switch (style)
		        		
			        	}
			        	*/
		        		
		        	});
		        	
		        	//check if already loaded
		        	if (element[0].complete) {
		        		scope.updateElement(element[0]);	
		        	}
		        	//if (typeof img.naturalWidth !== "undefined" && img.naturalWidth === 0
	        		
	        	} //end if (valid element)

	        }
	    }
	}); //end directive
	
		
})();
//end anonymous function