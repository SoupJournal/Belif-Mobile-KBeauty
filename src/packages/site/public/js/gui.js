//anonymous function to load features without name conflicts
(function() {
	
	//setup module
	var module = angular.module('belif-gui', ['ngResource']); 
	
	
	
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
	
	
	
	
	//scrollView - scrollable content view
	module.directive( 'scrollView', ['$window', '$document', '$rootScope', function($window, $document, $rootScope) {
		
	    return {
			restrict: 'A',
			scope: {
	            scrollView: '@',
	            scrollName: '@',
	            scrollPages: '@',
	            scrollDuration: '@'
	        },
	        link: function( scope, elem, attrs ) {
	        	
	        	//default properties
	        	if (!scope.scrollDuration>0) scope.scrollDuration = 300;
	        	
	        	
	
				//timeout for scrolling
				var scrollTimeout = null;
	
				//timeout for detecting scroll end
				var endTimer = null;
	
				//indicate if touch/press held
				var touchHeld = false;
				
				//scroll update time
				var scrollFrameRate = 30;
				
				//indicate if auto scrolling
				var autoScrolling = false;
	
	
				//touch supported
				if ('ontouchstart' in window || navigator.maxTouchPoints) {
	
					//clear scrollbar
					var styleSheet = document.styleSheets[0];
				    styleSheet.insertRule('::-webkit-scrollbar { display: none; }', 0);
			    
				}
	
				//get touch/press position
//		     	scope.getPosition = function(event) {
//		     		
//		     		//default position
//		     		var pos = { x:0, y:0 };
//				    if(event) {
//				    	
//				    	//find input handler
//				      	var touches = event.touches && event.touches.length ? event.touches : [event];
//				      	var e = (event.changedTouches && event.changedTouches[0]) ? event.changedTouches[0] : touches[0];
//				      	if(e) {
//				       	 	pos.x = e.clientX || e.pageX || 0;
//				        	pos.y = e.clientY || e.pageY || 0;
//				      	}
//				    }
//		     		
//		     		return pos;
//		     		
//		     	} //end getPosition()
	
				scope.updateTimer = function() {
					
   					//invalidate any existings detection
   					if (endTimer) {
   						clearTimeout(endTimer);
   						endTimer = null;
   					}
   					
   					//set timeout to detect scroll end
	     			endTimer = setTimeout(scope.detectScrollEnd, 100);
					
				} //end updateTimer()
	
	
				//detect scroll end
				scope.detectScrollEnd = function() {

     				//scroll held
     				if (touchHeld) {
     					
     					//update timer
						scope.updateTimer();     					

     				}
     				//scroll ended
     				else {
     					scope.scrollEnd();
     				}
     				
     			}; //end detectScrollEnd()
     			
	
		     	//drag started
		     	scope.dragStart = function(event) {
     		
		     		//valid event
		     		if (event) {
		     			
		     			//store touch state
		     			touchHeld = true;
		     		
		     		}
		     		
		     	}; //end dragStart()
		     	
		     	
		     	//drag ended
		     	scope.dragEnd = function(event) {

		     		//valid event
		     		if (event) {
		     			
		     			//store touch state
		     			touchHeld = false;

						//broadcast event
//		     			$rootScope.$broadcast('gesture-drag-start', {
//		     				name: scope.name,
//		     				position: scope.startPos
//		     			});
		     		
		     		}
		     		
		     	}; //end dragEnd()
	
	
				//scrolling has ended
				scope.scrollEnd = function() {
					
					//get event data
					var eventData = scope.eventData();
					
					//valid element
					if (elem && elem[0] && eventData) {
						
						//scroll to page position
						scope.scrollToPosition(eventData.pageStart, scope.scrollDuration);
						
					}
					
					//broadcast event
					scope.triggerEvent('scroll-view-scrollEnd', eventData);	
					
				} //end scrollEnd()
	
	
				//scroll to position
				scope.scrollToPosition = function(position, duration) {
					
					//clear existing scroll
					if (scrollTimeout) {
						clearTimeout(scrollTimeout);
						scrollTimeout = null;
					}	
					
					//valid element
					if (elem && elem[0]) {
						
						//round position
						position = Math.round(position);
						
						//check bounds
						var max = elem[0].scrollWidth - elem[0].clientWidth;
						if (position<0) position = 0;
						if (position>max) position = max;
						
						//movement required
						if (elem[0].scrollLeft != position) {
						
							//indicate auto scrolling
							autoScrolling = true;
						
							//determine number of frames
							var frames = duration / scrollFrameRate;
						
							//determine scroll amount
							var difference = (position - elem[0].scrollLeft) / frames;
							
							//adjust position
							elem[0].scrollLeft += difference;

							//bounds check
							if (difference>0 && elem[0].scrollLeft > position) elem[0].scrollLeft = position;
							else if (difference<0 && elem[0].scrollLeft < position) elem[0].scrollLeft = position;
						//console.log("--- scrolled to: " + position + " - current: " + elem[0].scrollLeft + " - difference: " + difference);							
							//adjust duration
							duration -= scrollFrameRate;
							
							//retrigger update
							scrollTimeout = setTimeout(function() {
								scope.scrollToPosition(position, duration);
							}, scrollFrameRate);
							
						}
						
					} //end if (valid element)
					
				} //end scrollToPosition()
		
	
				//trigger event
				scope.triggerEvent = function(eventName, eventData) {
					
					//valid event name
					if (eventName && eventName.length>0) {
						
						//console.log("scroll event: " + eventName);
						
						//broadcast event
		     			$rootScope.$broadcast(eventName, eventData);
						
					} //end if (valid event name)
					
				}; //end triggerEvent()
	
	
				//compile event data
				scope.eventData = function() {
					
					var data = null;
					
					//valid element
					if (elem && elem[0]) {
					
						//determine number of pages
						var pages = parseInt(scope.scrollPages);
						if (!Number.isInteger(pages) || pages<0) pages = 1;
					
						//scroll position 
						var scrollPosition = elem[0].scrollLeft;
					
						//scroll view size
						var scrollWidth = elem[0].offsetWidth;
						
						//scroll content size
						var contentWidth = 0;
						var paddingElementLeft = null;
						var paddingElementRight = null;
						for (var i=0; i<elem[0].children.length; ++i) {
							
							//find end position
							var child = elem[0].children[i];
							var endX = child.offsetLeft + child.offsetWidth;
							if (endX>contentWidth) {
								contentWidth = endX;
							}
							
							//find padding elements
							if (!paddingElementLeft || child.offsetLeft < paddingElementLeft.offsetLeft) {
								paddingElementLeft = child;	
							}
							if (!paddingElementRight || endX > paddingElementRight.offsetLeft + paddingElementRight.offsetWidth) {
								paddingElementRight = child;	
							}
							
						} //end for()
						
						//determine page offset
						var pageOffsetLeft = 0;
						var pageOffsetRight = 0;
						if (paddingElementLeft) {
							var style = getComputedStyle(paddingElementLeft);
							pageOffsetLeft = style ? parseFloat(style.paddingLeft) : 0;
						}
						if (paddingElementRight) {
							var style = getComputedStyle(paddingElementRight);
							pageOffsetRight = style ? parseFloat(style.paddingRight) : 0;
						}
						
						//determine total offset
						var totalOffset = pageOffsetLeft + pageOffsetRight;
						
						//page size
						var pageSize = (contentWidth - totalOffset) / pages;
					
						//half page size
						var halfPageSize = (pageSize * 0.5);
					
						//determine offset relative to view center
						var startX = pageOffsetLeft - (scrollWidth * 0.5); // + (pageSize * 0.5);
					
						//get current page
						//var currentPage = parseInt((scrollPosition - totalOffset) / pageSize);
						var currentPage = parseInt((scrollPosition - startX) / pageSize);
						
						//find page start
						var pageStart = startX + halfPageSize + (currentPage * pageSize);
						//var pageStart = (currentPage * pageSize) + pageOffsetLeft + ((pageSize + scrollWidth) * 0.5);
						//var pageStart = pageOffsetLeft - (scrollWidth * 0.5) + (pageSize * 0.5) + (currentPage * pageSize);
						
						//select next page if beyond half way point
//						if ((scrollPosition - (pageStart)) > (pageSize * 0.5)) {
//							 ++currentPage;
//							 pageStart += pageSize;
//						}
					
					
						//console.log("inner width: " + elem[0].clientWidth + " - offsetWidth: " + scrollWidth + " - scrollWidth: " + elem[0].scrollWidth + " - contentWidth: " + contentWidth + " - totalOffset: " + totalOffset); 
						//console.log("scroll pos: " + elem[0].scrollLeft + " - scrollWidth: " + scrollWidth + " - contentWidth: " + contentWidth + " - pages: " + pages + " - pageSize: " + pageSize + " - currentPage: " + currentPage + " - pageStart: " + pageStart); 
					
						//create data
						data = {
		     				name: scope.scrollName,
		     				position: scrollPosition,
		     				viewWidth: scrollWidth,
		     				contentWidth: contentWidth,
		     				contentStart: startX,
		     				contentLeft: pageOffsetLeft,
		     				contentRight: pageOffsetRight,
		     				pageSize: pageSize,
		     				pageCenter: halfPageSize,
		     				pages: pages,
		     				currentPage: currentPage,
		     				pageStart: pageStart
		     			}
	     			
					} //end if (valid element)
	     			
	     			return data;
					
				} //end eventData()
				
				
	
		     	//valid element
		     	if (elem) {

		     		//add input event listeners
		     		angular.element(elem).bind('scroll', function () {
		     			
		     			//not auto scrolling
		     			if (!autoScrolling) {
		     			
			     			//clear existing scroll
							if (scrollTimeout) {
								clearTimeout(scrollTimeout);
								scrollTimeout = null;
							}
			     			
	     					//update timer (check for scroll end)
							scope.updateTimer();  
						
		     			}
		     			
						//broadcast event
						scope.triggerEvent('scroll-view-scroll', scope.eventData());
		     			
		     			//clear auto scrolling
						autoScrolling = false;   					
						
		     		});
		     		angular.element($window).on('mousedown', scope.dragStart);
		     		angular.element($window).on('mouseup', scope.dragEnd);
		     		angular.element($window).on('touchstart', scope.dragStart);
		     		angular.element($window).on('touchend', scope.dragEnd);
		     		
		     		
		     		//get position data
					var positionData = scope.eventData();
					
					//valid element
					if (elem[0] && positionData) {
						
						//scroll to first page position
						scope.scrollToPosition(positionData.pageStart, scope.scrollDuration);
						
					}
		     		
		     		
		     	} //end if (valid element)


		    },
//		    controller: ['$scope', '$rootScope', function(scope, $rootScope) {
//		    	
//		    }]
	        
	    }
	}]); //end directive() - scrollView
	
	
	
	
	//fillHeight - update element to fill parent height
	module.directive( 'fillHeight', ['$window', '$document', '$rootScope', function($window, $document, $rootScope) {
		
	    return {
			restrict: 'A',
			scope: {
	            fillHeight: '@',
	            minRatio: '@'
	        },
	        link: function( scope, elem, attrs ) {
	
	/*
				//get applied style
				scope.getComputedStyle = function(baseElement, property) {
				
					var style = null;
				
					//valid element
					if (baseElement && baseElement.style) {

						//set default
						style = baseElement.style[property];
						
						//current style
						if (baseElement.currentStyle) {
							style = baseElement.currentStyle[property];
						}
						
						//computed style
						else if (window.getComputedStyle) {
							style = document.defaultView.getComputedStyle(baseElement,null).getPropertyValue(property);
						}
					
					} //end if (valid element)
					
					return style;
					
				} //end getComputedStyle()
				
	*/
	
	
				//find absolute offset
				scope.absoluteOffset = function(baseElement) {
					
					var offset = {x:0, y:0};
					
					if (baseElement) {
						
						//has parent
						if (baseElement.parentNode) {
							
							//find parent offset
							var parentOffset = scope.absoluteOffset(baseElement.offsetParent); //parentNode);
							if (parentOffset) {
								offset.x = parentOffset.x;
								offset.y = parentOffset.y;
							}
							
							//determine if absolute element
							//var isAbsolute = scope.getComputedStyle(baseElement, 'position')=='absolute';
							
							//add element offset
//							if (baseElement.offsetLeft) {
//								offset.x = isAbsolute ? offset.x + baseElement.offsetLeft : baseElement.offsetLeft;
//							}
//							if (baseElement.offsetTop) {
//								offset.y = isAbsolute ? offset.y + baseElement.offsetTop : baseElement.offsetTop;
//							}
							if (baseElement.offsetLeft) offset.x += baseElement.offsetLeft;
							if (baseElement.offsetTop) offset.y += baseElement.offsetTop;
						}
						
					} //end if (valid element)
						
					return offset;
						
				} //end absoluteOffset()
				
	
				//handle resize
				scope.resizeElement = function(target) {
					
					if (target) {
						
						//get element offsets
						//var offset = scope.absoluteOffset(target[0]);
						//var boundingRect = target[0].getBoundingClientRect();
						//for (var i=0; i<2; ++i) {
						
						//get element dimensions
						var positionY = target.prop('offsetTop');
						var width = $window.innerWidth;
						var height = $window.innerHeight;

						//find actual page height (compare all elements)
						var items = document.getElementsByTagName("*");
						var item = null;
						var itemHeight = 0;
						//var itemOffset = null;
					    for (var i = 0; i < items.length; i++) {
					    	
					    	//get item
					    	item = items[i];
					    	
					    	var offsetTop = scope.absoluteOffset(item);
		//console.log("[" + item.className + "][" + item.offsetTop + "][ " + item.offsetHeight + "] - offsetTop: " + offsetTop.y); 	
					    	//valid item and avoid measuring active element
					    	if (item && item!=target[0]) {
					    		
					    		//var offsetTop = item.offsetTop;
					    		var offsetTop = scope.absoluteOffset(item);
					        	itemHeight = offsetTop.y + item.offsetHeight;
					    		//itemOffset = scope.absoluteOffset(item);
					    		//itemHeight = itemOffset.y + item.offsetHeight;
					        	//itemHeight = item.offsetTop + item.offsetHeight;
					        	
					        	//compare height
					        	if (itemHeight>height) {
					        		height = itemHeight;	
					        	}
					    	}
					    } //end for()
//console.log("[" + target.attr('class') + "] final height: " + height + " - positionY: " + positionY + " - min ratio: " + scope.minRatio);
					

					
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
						
						//} //end for()
						
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
	    
	}]); //end directive() - fillHeight
	
	
	
	//hiddenVideo - creates video HTML elements  
	module.directive('hiddenVideo', ['$compile', function($compile) {
	    return {
	    	restrict: 'A',
	        scope: {
	            hiddenVideo: '@'
	        },
	        link: function (scope, element, attrs) {
	        
	        	//find button element
	        	if (scope.hiddenVideo && scope.hiddenVideo.length>0) {
	        		var buttonElem = document.getElementById(scope.hiddenVideo);
	        		if (buttonElem) {
	        			scope.buttonElement = angular.element(buttonElem);	
	        		}
	        	}
	        
	        	//valid button element
	        	if (scope.buttonElement) {
	        		
	        		//handle button press
	        		scope.buttonElement.on('click', function() {

	        			if (element) {

	        				//start video
	        				element[0].load();
	        				element[0].play();

	        			}
	        			
	        		});
	        		
	        	}
	        
	        
	        	//valid element
	        	if (element) {
	        		
	        		//hide video
	        		scope.oldDisplay = element[0].style.display;
	        		element[0].style.display = 'none';
	        	//	element.attr('display', 'none');
	        		
	        		//disable loop
	        	//	element.prop('loop', false);
		        	element[0].loop = false;
	        		
	        		
					//add listener
					element.on('playing', function() {
	        	
						//show video
	        			element[0].style.display = scope.oldDisplay;
		        	
		        	});

					element.on('pause', function() {
						
						//check if video plays inline
						var playsInline = typeof element[0]['oncanplay'] !== 'undefined';
						
						//inline video
						if (playsInline) {
						
							//hide video
		        			element[0].style.display = 'none';
		        			
						}
		        	
		        	});

					element.on('ended', function() {
	        	
						//hide video
	        			element[0].style.display = 'none';
		        	
		        	});
		        	
		        	//$compile(element)(scope);
		        	
	        	} //end if (valid element)
	        	
	        }
	    }
	    
	}]); //end directive() - hiddenVideo
	
	
		
	
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