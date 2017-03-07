//anonymous function to load features without name conflicts
(function() {
	
	//setup module
	var module = angular.module('soup-core', ['ngResource']); 
	
	//create controller
	module.controller('SoupController', [ '$http', '$scope', '$uibModal', function($http, $scope, $uibModal) {
		
		
		//== SWIPE CONFIGURATION ==//
		
		//get base form
		$scope.form = document.forms['questionForm'];
		
		//question swipe elements
		$scope.container = angular.element(document.getElementById('question-container'));
		if ($scope.form) {
			$scope.answerElement = $scope.form.elements['scriptAnswer'];
		}
		
		
		//handle question selection
		$scope.questionAnswered = function(value) {
			
			//valid form
			if ($scope.form) {

				//set answer value
				if ($scope.answerElement) {
					$scope.answerElement.setAttribute('value', value);
				}

				//submit form
				$scope.form.submit();	

			}
			
		}; //end questionAnswered()
		
		
		
		//== SWIPE LISTENERS ==//
		
		//add drag listener
		$scope.$on('gesture-drag-end', function (event, data) {
			
			//found data
			if ($scope.container && data) {
				
				//determine ratio
				var maxWidth = $scope.container.prop('offsetWidth');
				var ratio = data.dragOffset.x / maxWidth;
				
				//console.log("ratio: " + ratio);
				//selection made
				if (ratio<-0.4) {
					$scope.questionAnswered(1);
				//	console.log("select left");	
				}
				else if (ratio>0.4) {
					$scope.questionAnswered(0);
				//	console.log("select right");	
				}
			
			
			} //end if (valid elements)
			
		});
		
		
		
		//add swipe listener
		$scope.$on('gesture-swipe-left', function (event) {
			$scope.questionAnswered(0);
			//console.log("swipe left");
		});
		$scope.$on('gesture-swipe-right', function (event) {
			$scope.questionAnswered(1);
			//console.log("swipe right");
		});
		
			
	}]); //end controller
	
	
	
	/**
	* 	Swipe Answer View - move element on swipe gesture
	**/
	module.directive('swipeView', function() {
		return {
			restrict: 'A',
			link: function(scope, element, attrs) {
				
				//max rotation angle on swipe
				scope.maxRotation = 15;
				
				//add drag listener
				scope.$on('gesture-drag-updated', function (event, data) {

					//valid element
					if (element && data) {
						
						//determine max width
						var maxWidth = element.prop('offsetWidth');
						//var halfWidth = maxWidth * 0.5;
						
						
						//determine ratio
						var ratio = data.dragOffset.x / maxWidth;
						
						//bounds check
						if (ratio>1) ratio = 1;
						if (ratio<-1) ratio = -1;
						
						//determine percentage
						var percentage = (ratio * 100);

						//determine rotation
						var rotation = ratio * scope.maxRotation;
						
				//console.log("drag percentage: " + percentage + " - offset: " +  data.dragOffset.x + " - width: " + 	maxWidth);	
						//move element
						element.css('left', percentage + '%');
						element.css('right', (-percentage) + '%');
						
						//rotate element
						element.css('-webkit-transform', 'rotate(' + rotation + 'deg)');
    					element.css('-moz-transform', 'rotate(' + rotation + 'deg)');
    					element.css('-ms-transform', 'rotate(' + rotation + 'deg)');
    					element.css('-o-transform', 'rotate(' + rotation + 'deg)');
    					element.css('transform', 'rotate(' + rotation + 'deg)');
						
						
						//broadcast event
		     			scope.$broadcast('swipe-view-updated', {
		     				name: scope.name,
		     				ratio: ratio,
		     				percentage: percentage,
		     				rotation: rotation
		     			});
						
					} //end if (valid element)
					
				}); //end listener
				
				
				//add drag end listener
				scope.$on('gesture-drag-end', function (event, data) {
					
					//valid element
					if (element && data) {
					
						//move element
						element.css('left', '0');
						element.css('right', '0');
					
						//reset rotation
						element.css('-webkit-transform', 'none');
    					element.css('-moz-transform', 'none');
    					element.css('-ms-transform', 'none');
    					element.css('-o-transform', 'none');
    					element.css('transform', 'none');
					
						//broadcast event
		     			scope.$broadcast('swipe-view-updated', {
		     				name: scope.name,
		     				ratio: 0,
		     				percentage: 0,
		     				rotation: 0
		     			});
					
					} //end if (valid element)
					
				}); //end listener
			}
		}
	}); //end directive
	
	
	/**
	* 	Swipe Answer Fade View - fade element on swipe gesture (requires swipeView)
	**/
	module.directive('swipeFadeView', function() {
		return {
			restrict: 'A',
			scope: {
				swipeFadeView: '@'
			},
			link: function(scope, element, attrs) {
		
				//add swipe listener
				scope.$on('swipe-view-updated', function (event, data) {

					//valid element
					if (element && data) {
						
						//determine fade amout
						opacity = (data.ratio * 2);
						
						//fade element in
						if (scope.swipeFadeView && scope.swipeFadeView.toLowerCase()=='right') {
							opacity = 1+opacity;
						}
						//fade element out
						else {
							opacity = 1-opacity;	
						}
						
						//bounds check opacity
						if (opacity<0) opacity = 0;
						if (opacity>1) opacity = 1;
						
						//apply opacity
						element.css('opacity', opacity);

					} //end if (valid element)
					
				}); //end listener
				
			}
	
		}
	}); //end directive
	
	
})();
//end anonymous function