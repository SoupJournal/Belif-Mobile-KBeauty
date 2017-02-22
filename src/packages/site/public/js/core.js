//anonymous function to load features without name conflicts
(function() {
	
	//setup module
	var module = angular.module('soup-core', ['ngResource']); 
	
	//create controller
	module.controller('SoupController', [ '$http', '$scope', '$uibModal', function($http, $scope, $uibModal) {
		
		
			
	}]);	
	
	
	
	/**
	* 	Swipe Answer View - move element on swipe gesture
	**/
	module.directive('swipeView', function() {
		return {
			restrict: 'A',
			link: function(scope, element, attrs) {
				
				//max rotation angle on swipe
				scope.maxRotation = 25;
				
				//add drag listener
				scope.$on('gesture-drag-updated', function (event, data) {

					//valid element
					if (element) {
						
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
						
					} //end if (valid element)
					
				}); //end listener
				
			}
		}
	});
	
})();
//end anonymous function