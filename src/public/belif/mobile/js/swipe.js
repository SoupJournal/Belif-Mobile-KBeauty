//anonymous function to load features without name conflicts
(function() {
	
	//setup module
	var module = angular.module('swipe-gesture', ['ngResource']); 
	
	
	
		
	/**
	* Swipe Gesture handling - triggers events for swipe gestures
	*
	* Events:
	*		gesture-drag-start 		- triggered on start of drag gesture
	*		gesture-drag-updated 	- triggered on drag gesture movement
	*		gesture-drag-end 		- triggered on end of drag gesture
	*
	*		gesture-swipe-right		- triggered after swipe gesture with a right direction
	*		gesture-swipe-left		- triggered after swipe gesture with a left direction
	*		gesture-swipe-up		- triggered after swipe gesture with a up direction
	*		gesture-swipe-down		- triggered after swipe gesture with a down direction
	*
	*		gesture-click			- triggered if click gesture instead of swipe
	*
	**/
	module.directive('swipeGesture', ['$window', function ($window) {
	  	return {
	
		    link: function (scope, element, attr) {      
		     
		      
				//configuration
				scope.name = null;
				scope.swipeThreshold = 20; 
				scope.clickTimeThreshold = 200;
				//scope.numberOfSamples = 5;


				//set attributes
				if (attr) {
					scope.name = (attr.name ? attr.name : scope.name);
				}

		     	//valid element
		     	if (element) {

		     		//add input event listeners
		     		angular.element(element).on('touchstart', scope.dragStart);
		     		angular.element(element).on('mousedown', scope.dragStart);
		     		element.on('touchmove', scope.dragMove);
		     		element.on('mousemove', scope.dragMove);
		     		element.on('touchend', scope.dragEnd);
		     		element.on('mouseup', scope.dragEnd);
		     		element.on('touchcancel', scope.dragCancel);
		     		element.on('mousecancel', scope.dragCancel);
		     		angular.element($window).on('mouseup', scope.dragEnd);
		     		
		     	} //end if (valid element)


		    },
		    controller: ['$scope', '$rootScope', function(scope, $rootScope) {

				//active drag variables
		     	scope.startPos = null;
		     	scope.startTime = null;
		     	scope.dragAmount = null;
				scope.dragOffset = { x: 0, y: 0 };


		     	//drag started
		     	scope.dragStart = function(event) {
     		
		     		//valid event
		     		if (event) {
		     			
		     			//store start time
		     			scope.startTime = new Date().getTime();

		     			//store start position (touch events)
		     			scope.startPos = scope.getPosition(event);
		     			

						//broadcast event
		     			$rootScope.$broadcast('gesture-drag-start', {
		     				name: scope.name,
		     				position: scope.startPos
		     			});

		     			//stop other handlers
		     			event.stopPropagation();
		     		
		     		}

		     		
		     	}; //end dragStart()
		     	
		     	
		     	
		     	
	     		//drag moved
		     	scope.dragMove = function(event) {
		     		
		     		//valid event
		     		if (event) {
		     			
		     			//drag active
		     			if (scope.startPos) {
		     			
			     			//handle drag movement
			     			scope.handleDrag(event);
			     			
			     			//broadcast event
			     			$rootScope.$broadcast('gesture-drag-updated', {
			     				name: scope.name,
			     				position: scope.startPos,
			     				dragAmount: scope.dragAmount,
			     				dragOffset: scope.dragOffset
			     			});
			     			
		     			} //end if (drag active)
		     			
		     			
		     			//stop other handlers
		     			event.stopPropagation();
		     			
		     		} //end if (valid event)
		     		
		     	}; //end dragMove()
		     	
		     	
		     	
		     	
	     		//drag ended
		     	scope.dragEnd = function(event) {
		     		
		     		var triggeredEvent = false;
		     		
		     		//valid event
		     		if (event) {
		     			
		     			//drag active
		     			if (scope.startPos) {
			     			
			     			
			     			//swipe event names
			     			var swipeEventX = null;
			     			var swipeEventY = null;
			     			

			     			//found drag amount
			     			if (scope.dragAmount) {
				     			
				     			//check horizontal thresholds
				     			if (scope.dragAmount.x>scope.swipeThreshold) {
				     				swipeEventX = 'gesture-swipe-right';
				     			}
								else if (scope.dragAmount.x<-scope.swipeThreshold) {
				     				swipeEventX = 'gesture-swipe-left';
				     			}
				     			
				     			//check vertical thresholds
				     			if (scope.dragAmount.y>scope.swipeThreshold) {
				     				swipeEventY = 'gesture-swipe-up';
				     			}
								else if (scope.dragAmount.y<-scope.swipeThreshold) {
				     				swipeEventY = 'gesture-swipe-down';
				     			}
				     			
				     			
				     			//broadcast events
				     			if (swipeEventX) {
					     			$rootScope.$broadcast(swipeEventX, {
					     				name: scope.name
					     			});
				     			}
				     			if (swipeEventY) {
					     			$rootScope.$broadcast(swipeEventY, {
					     				name: scope.name
					     			});
				     			}
			     			
			     			} //end if (found drag amount)
			     			

			     			
			     			//check for click
			     			else {
			     				
			     				//get current time
			     				var currentTime = new Date().getTime();
			     				
			     				//get press duration
			     				var duration = currentTime - scope.startTime;

			     				//clicked
			     				if (duration<scope.clickTimeThreshold) {
			     					
			     					//broadcast event
					     			$rootScope.$broadcast('gesture-click', {
					     				name: scope.name,
					     				position: scope.startPos
					     			});
			     					
			     					//indicate event was handled
			     					triggeredEvent = true;
			     				}
			     			}
			     			
			     			
			     			//trigger drag event
			     			if (!triggeredEvent) {
		     			
				     			//broadcast event
				     			$rootScope.$broadcast('gesture-drag-end', {
				     				name: scope.name,
				     				position: scope.startPos,
				     				dragAmount: scope.dragAmount,
				     				dragOffset: scope.dragOffset
				     			});
				     			
			     			}
		     			
		     			} //end if (drag active)
		     			
		     			
		     			
		     			//stop other handlers
		     			event.stopPropagation();
		     			
		     		} //end if (valid event)
		     		
		     		
		     		//clear variables
					scope.clearDrag();

		     		
		     	}; //end dragEnd()
		     	
		     
		     
	     		//drag ended
		     	scope.dragCancel = function(event) {
		     		
					//clear variables
					scope.clearDrag();
		     		
     				//broadcast event
	     			$rootScope.$broadcast('gesture-drag-end', {
	     				name: scope.name,
	     				position: scope.startPos,
	     				dragAmount: scope.dragAmount,
	     				dragOffset: scope.dragOffset
	     			});
		     		
		     		//console.log("drag canceled: " + event);
		     		
		     	}; //end dragCancel()
		     
		     
		     

				scope.handleDrag = function(event) {
					
		     		//valid event
		     		if (event) {
		     			
		     			//get current position
		     			var pos = scope.getPosition(event);
		     			
		     			//determine drag amount
		     			scope.dragAmount = {
		     				x: pos.x - scope.startPos.x,
		     				y: pos.y - scope.startPos.y
		     			};
		     			
		     			//update drag offset
		     			scope.dragOffset.x += scope.dragAmount.x;
		     			scope.dragOffset.y += scope.dragAmount.y;
		     					     			

		     			//update start position
		     			scope.startPos = pos;
			
		     			//store start time
		     			scope.startTime = new Date().getTime();
		     			
		     		} //end if (valid event)
					
				}; //end handleDrag()

		     
		     
		     	scope.getPosition = function(event) {
		     		
		     		//default position
		     		var pos = { x:0, y:0 };
				    if(event) {
				    	
				    	//find input handler
				      	var touches = event.touches && event.touches.length ? event.touches : [event];
				      	var e = (event.changedTouches && event.changedTouches[0]) ? event.changedTouches[0] : touches[0];
				      	if(e) {
				       	 	pos.x = e.clientX || e.pageX || 0;
				        	pos.y = e.clientY || e.pageY || 0;
				      	}
				    }
		     		
		     		return pos;
		     		
		     	} //end getPosition()
		     
		     
		     
		     	scope.clearDrag = function() {
		     		
		     		//clear drag variables
		     		scope.startTime = null;
		     		scope.startPos = null;
		     		scope.dragAmount = null;
		     		scope.dragOffset = { x: 0, y: 0 };
		     		
		     	}; //end clearDrag()
		     	
			}]
	  	};
	}]);
	
		
})();
//end anonymous function