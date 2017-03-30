//anonymous function to load features without name conflicts
(function() {
	
	//setup module
	var module = angular.module('soup-gui', ['ngResource']); 
	
	
	
	//broadcastClick directive - broadcasts named event on element click 
	module.directive('broadcastClick', ['$rootScope', function($rootScope) {
	    return {
	    	restrict: 'A',
	        scope: {
	            broadcastClick: '@'
	        },
	        link: function (scope, element, attrs) {
	        	
	        	angular.element(element).on('click', function() {
	        	
		        	//click event defined
		        	if (scope.broadcastClick && scope.broadcastClick.length>0) {

		        		//broadcast event
		        		$rootScope.$broadcast(scope.broadcastClick);
		        		
		        	} //end if (valid event name)
	        	
	        	});
	        }
	        
	    }
	}]); //end directive
	
	
	
	//broadcastClick directive - broadcasts named event on element click 
	module.directive('toggleHeight', ['$rootScope', function($rootScope) {
	    return {
	    	restrict: 'A',
	        scope: {
	            toggleHeight: '@',
	            eventName: '@',
	        },
	        link: function (scope, element, attrs) {
	        	
	        	//store element height
	        	scope.baseHeight = element.css('height');
	
	        	//valid event name
	        	if (scope.eventName && scope.eventName.length>0) {

		        	scope.$on(scope.eventName, function() {
		        	
			        	//click event defined
			        	if (scope.toggleHeight && scope.toggleHeight.length>0) {
	
			        		//update element
			        		if (element.css('height') == scope.baseHeight) {
			        			element.css('height', scope.toggleHeight);
			        		}
			        		//restore element
			        		else {
			        			element.css('height', scope.baseHeight);
			        		}
			        		
			        	} //end if (valid event name)
		        	
		        	});
	        	
	        	} //end if (valid event name)
	        }
	        
	    }
	}]); //end directive
	
	
	
	
	//fillHeight - update element to fill parent height
	module.directive( 'fillHeight', ['$window', '$document', '$rootScope', function($window, $document, $rootScope) {
		
	    return {
			restrict: 'A',
			scope: {
	            fillHeight: '@',
	            minRatio: '@'
	        },
	        link: function( scope, elem, attrs ) {
	
				//handle resize
				scope.resizeElement = function(target) {
					
					if (target) {
						
						//get element dimensions
						var positionY = target.prop('offsetTop');
						var width = $window.innerWidth;
						var height = $window.innerHeight;
					
					/*
						//append element to body (used to measure document height)
						var docBody = angular.element(document.body);
						var documentBase = angular.element('<div style="position: relative; background-color: red; width: 50px; height: 50px; display: block;"></div>');
						docBody.append(documentBase);
						//var documentBase = docBody.append('<div style="position: absolute; background-color: red; width: 50px; height: 50px; display: block;"></div>');
						documentBase.remove();
						*/
					/*
						//get document height
						var docHeight = document.height | (document.body ? document.body.offsetHeight : 0) | document.documentElement.scrollHeight;
						//var docHeight = $document.height;

						console.log("window.innerHeight: " + window.innerHeight);
						console.log("document.height: " + document.height);
						console.log("document.documentElement.clientHeight: " + document.documentElement.clientHeight);
						console.log("document.body.offsetHeight: " + document.body.offsetHeight);
						console.log("document.body.innerHeight: " + document.body.innerHeight);
						console.log("document.documentElement.scrollHeight: " + document.documentElement.scrollHeight);
						console.log("docHeight: " + docHeight + " - greater: " + (docHeight>height) + "\n\n\n\n");
						if (docHeight>height) {
							height = docHeight;	
						}*/
					
						//determine new height
						var elemHeight = height - positionY;
						if (elemHeight<0) elemHeight = 0;
					
						//handle minimum ratio
						if (scope.minRatio && scope.minRatio.length>0) {
							var minHeight = width * parseInt(scope.minRatio);
							if (elemHeight < minHeight) {
								elemHeight = minHeight;	
							}
						}

						//(subtrack two pixels to avoid scroll bar in chrome)
						elemHeight -= 2;
	
						//set height
		            	target.css('height', elemHeight +  'px');
						
						// manuall $digest required as resize event
						// is outside of angular
						//scope.$digest();
					
						//broadcast update event
						$rootScope.$broadcast('window-height-updated');
						
					}
					
				} //end scope.resizeElement()
	
				//listen for window events
				angular.element($window).bind('resize', function() {

					//resize element
					scope.resizeElement(elem);

				});
				
				//listen for load events
				$rootScope.$on('load-group-updated', function() {

					//re-check element sizes
					scope.resizeElement(elem);
					
				}); //end listener
	
	
				//set element initial size
				scope.resizeElement(elem);
	
	        }
	    }
	    
	}]); //end directive()
	
	
	
	
	//star rating directive - broadcasts named event on element click 
	module.directive('starRating', ['$rootScope', function($rootScope) {
	    return {
	    	restrict: 'A',
	        scope: {
	            starRating: '@',
	            starRatingOn: '@',
	            starRatingOff: '@'
	        },
	        link: function (scope, element, attrs) {
	        	
	        	//get input element
	        	var inputs = element.find('input');
	        	scope.inputElement = inputs && inputs.length>0 ? angular.element(inputs[0]) :  null;
	        	//scope.inputElement = angular.element(element.getElementByName('rating'));

	        	//get children
	        	scope.stars = element[0].getElementsByTagName('BUTTON'); //element.children();
	        	if (scope.stars) {
	        		
	        		var child = null;
	        		for (var i=0; i<scope.stars.length; ++i) {
	        	
	        			//get child
	        			child = scope.stars[i];
	        			if (child) {
	        				
				        	angular.element(child).on('click', function() {
				        	
				        		//update stars
				        		var item = null;
				        		var itemIndex = 0;
				        		var foundIndex = false;
				        		var images = null;
				        		var image = null;
				        		for (var j=0; j<scope.stars.length; ++j) {
				        			
				        			item = scope.stars[j];
				        			if (item) {
				        			
				        				//apply image
				        				images = item.getElementsByTagName('IMG');
				        				if (images && images.length>0) {
				        					image = angular.element(images[0]);
				        					image.prop('src', foundIndex ? scope.starRatingOff : scope.starRatingOn);
				        					if (foundIndex) {
				        						image.removeClass('rating-on');				        						
				        					}
				        					else {
				        						image.addClass('rating-on');
				        					}
				        					//image.css('opacity', foundIndex ? '0.6' : '1');
				        				}
				        				
					        			//found current item
					        			if (item == this) {
					        				foundIndex = true;
					        				itemIndex = j + 1;	
					        			}
				        			
				        			} //end if (valid item)
				        			
				        		} //end for()

								//set input value
								if (scope.inputElement) {
									scope.inputElement.attr('value', itemIndex);
								}
				        	
				        	});
				        	
	        			}
		        	
	        		} //end for()
	        	
	        	} //end if (found children)
	        }
	        
	    }
	}]); //end directive
	
	
	
	//carousel - creates carousel of HTML elements  
	module.directive('carousel', ['$rootScope', function($rootScope) {
	    return {
	    	restrict: 'A',
	        scope: {
	            carousel: '@'
	        },
	        link: function (scope, element, attrs) {
	        	
				//animation active
				scope.animationActive = false;
				
				

				//next navigation
				scope.nextItem = function() {
					
        			//get child elements
        			var children = element.children();
        			if (children && children.length>1) {
	        	
			        	//get next item
			        	var nextItem = scope.index + 1;
			        	if (nextItem>=children.length) {
			        		nextItem = 0;	
			        	}

						//move to next item
						scope.showItem(nextItem);

        			} //end if (has items)
					
				} //end nextItem()



				//change item
				scope.showItem = function(itemIndex) {
					
					var children = element.children();
					if (itemIndex>=0 && itemIndex<children.length) {
					
						//get child element
						var child = children[itemIndex];
						if (child) {
							
							//get offset position
							var offset = child.offsetLeft;
							
							//update carousel position
							scope.scrollTo(element[0], offset, 1000);
							
							//store index
							scope.index = itemIndex;
							
						} //end if (valid child)
						
					}
					
				} //end showItem()


				//smooth scrolling function
				scope.scrollTo = function(element, to, duration) {
					
					//find change amount
					var start = element.scrollLeft;
					var change = to - start;
					
					var data = {
						
						//configure scroll
					    start: start,
					    change: change,
					    currentTime: 0,
					    increment: 20,
					    duration: duration,
					        
					        
					    //create scroll function
					    animateScroll: function() {     
					    	
					    	//update timer   
					        data.currentTime += data.increment;
					        
					        //get next scroll position
					        var val = scope.easeInOutQuad(data.currentTime, data.start, data.change, data.duration);
					        
					        //apply scroll
					        element.scrollLeft = val;
					        if(data.currentTime < data.duration) {
					        	scope.animationActive = true;
					            setTimeout(data.animateScroll, data.increment);
					        }
					        //scroll ended
					        else {
					        	scope.animationActive = false;	
					        }
					        
					    } //end animateScroll()  //();
					    //animateScroll();
				    
					};
					data.animateScroll();
				    
				} //end scrollTo();
				
				
				//ease function
				scope.easeInOutQuad = function (t, b, c, d) {
					
					t /= d/2;
					if (t < 1) return c/2*t*t + b;
					t--;
					return -c/2 * (t*(t-2) - 1) + b;
					
				} //end easeInOutQuad()



				//==== CONFIGURATION ====//

				//add button elements
				scope.index = 0;
				
				//get carousel properties
				if (element) {
					
					//clear scroll bar
					element.css('overflow-x', 'hidden');
					
					
					//implement auto timer
					if (scope.carousel && scope.carousel.length>0) {
						
						//get automation time
						var itemDuration = parseInt(scope.carousel);
						if (itemDuration>0) {
							setInterval(function() {
								
								//not scrolling
								if (!scope.animationActive) {
									scope.nextItem();
								}
								
							}, itemDuration);	
						}
					}
					
					//add listener
					element.on('click', function() {
	        	
						//change item
						scope.nextItem();
		        	
		        	});
					
					
				} //end if (valid element)

	        }
	        
	    }
	}]); //end directive
	
	
	
	
	
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
	        		//else {

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
	        		//}
		

	        	} //end if (valid element)

	        }
	    }
	}]); //end directive
	
		
})();
//end anonymous function