//anonymous function to load features without name conflicts
(function() {
	
	//setup module
	var module = angular.module('soup-gui', ['ngResource']); 
	
	
	
	//pageButton directive - standard page button 
	module.directive('loadStyle', ['$rootScope', '$timeout', function($rootScope, $timeout) {
		
		//shared group data
		var groupData = {};
		
	    return {
	    	restrict: 'A',
	 	    replace: true,
	        scope: {
	            loadStyle: '@',
	            loadGroup: '@'
	        },
	        link: function (scope, element, attrs) {
	        	
	        	//styles
	        	var STYLE_FADE = 0;
	        	var STYLE_BLUR = 1;
	        	
	        	
	        	//set defaults
	        	var loadStyle = null;
	        	var style = STYLE_FADE;
	        	var duration = 1.0;
	        	var group = null;
	        	//fade
	        	var finalOpacity = 1.0;

	        	
	        	
	        	//found attributes
	        	if (attrs) {

	        		//store attributes in scope
	        		loadStyle = attrs.loadStyle;
	        		duration = (attrs.duration>0) ? attrs.duration : duration;
	        		group = attrs.loadGroup && attrs.loadGroup.length>0 ? attrs.loadGroup : null;

	        	} //end if (valid attributes)
	        	
	        	
	        	//determine style
	        	if (loadStyle && loadStyle.length>0) {
	        		
	        		//ensure lower case
	        		loadStyle = loadStyle.toLowerCase();
	        		
	        		if (loadStyle=='blur') {
	        			style = STYLE_BLUR;
	        		}
	        		
	        	} //end if (found style)
	        	
	        	
	        	
	        	//check if image loaded
	        	scope.imageLoaded = function(target) {

	        		return target && (target.complete || (typeof(target.naturalWidth)!=="undefined" && target.naturalWidth > 0));
	        		
	        	} //end imageLoaded()
	        	
	        	
	        	//update element transition
	        	scope.updateElement = function(target) {

	        		if (target) {
	        			
	        			//apply final configuration
			        	switch (style) {
			        		
			        		case STYLE_FADE:
			        		{
			        			target.style.opacity = finalOpacity;
			        		}
			        		break;
			        		
			        	} //end switch (style)
	        		}	
	        	} //end updateElement()
	        	
	        	
	        	
	        	scope.elementLoaded = function(target) {
	        		
	        		//create event data
	        		var eventData = {
	     				group: group,
	     				element: target
	     			};
	        		
	        		
	        		//indicate if update event triggered
	        		var triggerUpdate = false;

	        		//valid group
	        		if (group && group.length>0) {
	        		
	        			//has group data
	        			var data = groupData[group];
	        			if (data && data.length>0) {
	        				
	        				//check if all other group elements loaded
	        				triggerUpdate = true;
	        				for (var i=0; i<data.length; ++i) {
	        					if (!scope.imageLoaded(data[i])) {
	        						triggerUpdate = false;
	        						break;
	        					}
	        				} //end for()
	        				
	        			}
	        			//no group data
	        			else {
	        				triggerUpdate = true;
	        			}
      		
	        		}
	        		
	        		//no group
	        		else {
	        			triggerUpdate = true;	
	        		}
	        		

	        		//trigger update
	        		if (triggerUpdate) {

		        		//update element
				        scope.updateElement(target);
				        
				        //broadcast event
	     				$rootScope.$broadcast('load-group-updated', eventData);
			        
	        		}
			        
	        		
	        	} //end elementLoaded()
	        	
	        	
	        	//found element
	        	if (element) {
	        		
					//valid HTML element
		        	if (element[0]) {
		        	
			        	//apply initial configuration
			        	switch (style) {
			        		
			        		case STYLE_FADE:
			        		{
			        			finalOpacity = element[0].style.opacity;
			        			element[0].style.opacity = 0;
			        			element[0].style.transition = 'opacity ' + duration + 's';
			        		}
			        		break;
			        		
			        	} //end switch (style)
			        	
	        		
		        	}
	        		

	        		//image element
	        		if (element[0].tagName=="IMG") {
	        			
	        			//add to group
	        			if (group && group.length) {
	        				
	        				//get data
	        				var data = groupData[group];
	        				if (!data) data = [];
	        				
	        				//check if element already added
	        				var result = data.filter(function(obj) { return obj==element[0];});
	        				
	        				//add element (avoid duplicates)
	        				if (!result || result.length<=0) {
	        					data.push(element[0]);
	        				}
	        				
	        				//store data
	        				groupData[group] = data;
	        					
	        			} //end if (valid group)

	        			
		        		//listen for load event
			        	element.bind("load" , function(e){ 

							//update element
			        		scope.elementLoaded(element[0]);
			        		
			        	});
			        	
			        	element.bind("error" , function(e){ 

							//valid group
			        		if (group && group.length>0) {
			        		
			        			//has group data
			        			var data = groupData[group];
			        			if (data && data.length>0) {
			        				
			        				//remove element from group
			        				for (var i=data.length-1; i>=0; --i) {
			        					if (data[i]==element[0]) {
			        						data.splice(i, 1);
			        						break;
			        					}
			        				} //end for()
			        				
			        			}

			        		} //end if (has group)

							//update element
			        		scope.elementLoaded(element[0]);
			        		
			        	});
			        	
			        	//check if already loaded
			        	if (scope.imageLoaded(element[0])) {
			        		scope.elementLoaded(element[0]);	
			        	}
	        			
	        		}
	        		//non image element 
	        		else {

        				//add load listener
						scope.$on('load-group-updated', function (event, data) {

							//valid group
							if (data && data.group==group) {

								//update element
								scope.updateElement(element[0]);
								
							} //end if (valid group)
							
						});
	        				

	        			//check elements at page load ($timeout runs after link functions)
	        			scope.timeout = $timeout(function() {

						    //ensure elements are visible if no image is associated with group
			        		scope.elementLoaded(element[0]);
			        		
						}); 
	        		}
		

	        	} //end if (valid element)

	        }
	    }
	}]); //end directive
	
		
})();
//end anonymous function