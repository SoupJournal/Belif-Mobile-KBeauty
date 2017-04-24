//anonymous function to load features without name conflicts
(function() {
	
	//setup module
	var module = angular.module('forms', ['ngResource']); 
	
	
	
	
	//broadcastChange directive - broadcasts named event on element change 
	module.directive('broadcastChange', ['$rootScope', function($rootScope) {
	    return {
	    	restrict: 'A',
	        scope: {
	            broadcastChange: '@'
	        },
	        link: function (scope, element, attrs) {
	        	
	        	angular.element(element).on('change', function() {
	        	
		        	//click event defined
		        	if (scope.broadcastChange && scope.broadcastChange.length>0) {

		        		//broadcast event
		        		$rootScope.$broadcast(scope.broadcastChange, angular.element(element));
		        		
		        	} //end if (valid event name)
	        	
	        	});
	        }
	        
	    }
	}]); //end directive
	
	
	
	
	/**
	* 	checkbox-limit - limits number of checkboxes selected
	**/
	module.directive('checkboxLimit', function() {
		
		var checkCounter = {};
		
		return {
			restrict: 'A',
			link: function(scope, elem, attrs) {

				//set attributes
				if (attrs) {
					scope.checkboxLimit = attrs.checkboxLimit;
					scope.checkboxGroup = attrs.checkboxGroup;
					scope.preventDeselection = (attrs.preventDeselection && attrs.preventDeselection.length<0 && attrs.preventDeselection.toLowerCase()!='false');
				}


				//create counter
				if (!checkCounter) {
					checkCounter = {};	
				}

				//setup counter
				if (scope.checkboxGroup && scope.checkboxGroup.length>0) {
					
					//create group counter
					if (!(checkCounter[scope.checkboxGroup]>0)) {
						checkCounter[scope.checkboxGroup] = 0;	
					}
						
				}
				//no group - create base counter
				else if (!(scope.checkCount>0)) {
					scope.checkCount = 0;	
				}
			
			
				//update count
				scope.updateCount = function(checkbox, checkValue) {
					
					//valid checkbox
					if (checkbox) {
						
						//update count
						if (scope.checkboxGroup && scope.checkboxGroup.length>0) {

							//update value
							checkCounter[scope.checkboxGroup] += checkbox.checked ? 1 : -1;
							
							//bounds check
							if (checkCounter[scope.checkboxGroup]<0) {
								checkCounter[scope.checkboxGroup] = 0;	
							}
							
							//enforce limit
							if (scope.checkboxLimit>=0 && checkCounter[scope.checkboxGroup]>scope.checkboxLimit) {

								checkbox.checked = false;
								--checkCounter[scope.checkboxGroup];
							}

						}
						//no group
						else {
							
							//update value
							scope.checkCount += checkbox.checked ? 1 : -1;
							
							//bounds check
							if (scope.checkCount<0) {
								scope.checkCount = 0;	
							}
							
							//enforce limit
							if (scope.checkboxLimit>=0 && scope.checkCount>scope.checkboxLimit) {
								checkbox.checked = false;
								--scope.checkCount;
							}
						}
					
					} //end if (valid checkbox)
					
				};
			
			
				//element already checked
				if (elem[0].checked) {

					//update count
					scope.updateCount(elem[0]);

				}
			

				//listen for change events
				elem.bind('change', function(e) {
					
					//update count
					scope.updateCount(elem[0]);
	
				}); //end listener
				

				
			}
		}
		
	}); //end directive
	
	
	
	
	
	
	/**
	* 	auto-next-focus - focus on next tab elment if enter pressed
	**/
	module.directive('autoNextFocus', function() {
		
		return {
			restrict: 'A',
			link: function($scope, elem, attrs) {

				//listen for keyboard events
				elem.bind('keydown', function(e) {
					
					//determine key code
					var code = e.keyCode || e.which;

					//return/enter ('GO') button pressed
					if (code === 13) {
											
						//prevent key handling
						e.preventDefault();
						
						
						//get next element
						var nextElement = elem.next();
						
						//no element found
						if (!nextElement || nextElement.length<=0) {
						
							//get list of input elements
							var inputs = document.querySelectorAll('input:not([dummy]),select');
							if (inputs && inputs.length>0) {
								
								//find current element in list of inputs
								for (var i = 0; i < inputs.length; ++i) {
	
									//found element
									if (inputs[i]==elem[0]) {
										if (i+1 < inputs.length) {
											nextElement = inputs[i+1];
										}
										break;	
									}

								};
								
							}
						
						} //end if (no element)

						//focus on next element
						if (nextElement) {

							//focus for input elements
							if (nextElement.focus) {
								nextElement.focus();
							}
							//focus for select elements
							if (nextElement.tagName=='SELECT') {
								try {

									//trigger mouse down
								    var event = document.createEvent('MouseEvents');
								    event.initMouseEvent('mousedown', true, true, window);
								    nextElement.dispatchEvent(event);
								}
								catch (e) {
									//console.log("error with dispatch: " + e);	
								};
							}
						}
	
					} //end if (return/enter pressed)
					
				}); //end bind()
				
			} //end link()
		}
		
	}); //end directive
	
	
		
})();
//end anonymous function