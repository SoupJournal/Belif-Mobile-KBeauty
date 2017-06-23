//anonymous function to load features without name conflicts
(function() {

	//setup module
	var module = angular.module('belif-core', ['ngResource']); 
	
	//create controller
	module.controller('BelifController', [ '$http', '$scope', '$window', '$uibModal', function($http, $scope, $window, $uibModal) {
		


		//------------------------------------------------------//
		//----					PAGE STYLING				----//
		//------------------------------------------------------//

		$scope.$on('window-height-updated', function() {

			//update background size
			var elements = document.getElementsByClassName('background-fill');
			var elem = null;
			for (var i=0; i<elements.length; ++i) {
				
				//get element
				elem = angular.element(elements[i]);
				if (elem) {
					
					//get window width
					//var width = $window.innerWidth;
					
					//determine min padding height
					//var padding = width * 1.3;
					
					//clear padding
					elem.css('padding-bottom', 0); //width + 'px');
					
				} //end if (valid element)
				
			} //end for()
		
		}); //end listener()
		
		
		
		//------------------------------------------------------//
		//----					PRODUCT SCROLL				----//
		//------------------------------------------------------//
		
		//get product elements
		$scope.productElements = document.getElementsByClassName('product-box');
		console.log("found controller");
		
		//get sub elements
		$scope.productPaddingElements = [];
		$scope.productImageElements = [];
		$scope.productTitleElements = [];
		if ($scope.productElements) {
			
			for (var i=0; i<$scope.productElements.length; ++i) {
				
				//get element
				var product = $scope.productElements[i];
				if (product) {
					
					//get product id
					var pId = product.id;

					//get image padding elements
					var paddingElements = product.getElementsByClassName('product-image-padding');
					if (paddingElements && paddingElements.length>0) {
						$scope.productPaddingElements[pId] = paddingElements[0]; 	
					}
					
					//get image elements
					var imageElements = product.getElementsByClassName('product-image');
					if (imageElements && imageElements.length>0) {
						$scope.productImageElements[pId] = imageElements[0]; 	
					}
					
					//get title elements
					var titleElements = product.getElementsByClassName('product-title-box');
					if (titleElements && titleElements.length>0) {
						$scope.productTitleElements[pId] = titleElements[0]; 	
					}
					
				
				} //end if (valid product)
				
			} //end for()
		
		} //end if (found elements)
		
		
		//add scroll listener
		$scope.$on('scroll-view-scroll', function (event, data) {
			
			//found data
			if ($scope.productElements && data) {
				
				//update elements
				var productOffset = data.contentStart;
				//var totalSize = data.pageSize * data.pages;
				for (var i=0; i<$scope.productElements.length; ++i) {
					
					//determine offset percentage
					var percentage = (productOffset - data.position + data.pageCenter) / data.pageSize;
					if (percentage>1) percentage = 1;
					if (percentage<-1) percentage = -1;
					
					//var expPercentage = percentage / percentage;
					
					//update position
					productOffset += data.pageSize;
					
					//get padding element
					var paddingElement = $scope.productPaddingElements['product_' + i];
					if (paddingElement) {
					
						//update padding
						var padding = 20 + (Math.abs(percentage)) * 10;
						angular.element(paddingElement).css('padding-left', padding + "%");
						angular.element(paddingElement).css('padding-right', padding + "%");

					} //end if (valid element)
					
					//get image element
					var imageElement = $scope.productImageElements['product_' + i];
					if (imageElement) {
					
						//update rotation
						var rotation = (1 - Math.abs(percentage)) * -5;
						imageElement.style.webkitTransform = 'rotate('+ rotation +'deg)'; 
					    imageElement.style.mozTransform    = 'rotate('+ rotation +'deg)'; 
					    imageElement.style.msTransform     = 'rotate('+ rotation +'deg)'; 
					    imageElement.style.oTransform      = 'rotate('+ rotation +'deg)'; 
					    imageElement.style.transform       = 'rotate('+ rotation +'deg)'; 
					    
					    //update position
					    var padding = (Math.abs(percentage)) * 30;
						angular.element(imageElement).css('margin-top', padding + "%");

					} //end if (valid element)
					
					//get title element
					var titleElement = $scope.productTitleElements['product_' + i];
					if (titleElement) {
					
						//update opacity
						angular.element(titleElement).css('opacity', 1 - Math.abs(percentage));

					} //end if (valid element)
					
					//console.log("element[" + i + "] offset: " + $scope.productElements[i].offsetLeft + " - scroll: " + data.position + " - page: " + data.currentPage + " - page start: " + data.pageStart + " - scrollOffset: "+ percentage + " - pageSize: " + data.pageSize);
					
					
				} //end for()
			
			} //end if (valid elements)
			
		});
		
		
		//product clicked
		$scope.productClicked = function($event) {
			
			console.log("product clicked: " + $event.currentTarget);
			
		} //end productClicked()
		
		
		
		
		
		
		

		//==========================================================//
		//====				MODAL VIEW FUNCTIONALITY			====//
		//==========================================================//	
		
		
		//modal instances
		$scope.modals = [];
		
		
		$scope.openModal = function (modalId, containerId, templateURL) { //size, parentSelector) {

			//valid modal id
			if (modalId && modalId.length>0) {
	
				//valid parent
				if (containerId && containerId.length>0) {
				
					//valid template URL
					if (templateURL && templateURL.length>0) {
					
						//get container element
						var parentElement = angular.element(document.getElementById(containerId));
						if (parentElement) {
					
							//var parentElem = parentSelector ? 
							//angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
							
							//open view
							$scope.modals[modalId] = modalInstance = $uibModal.open({
								animation: true,
								//ariaLabelledBy: 'modal-title',
								ariaDescribedBy: 'modal-body',
								templateUrl: templateURL, //'myModalContent.html',
								//controller: 'ModalInstanceCtrl',
								//controllerAs: '$ctrl',
								//size: size,
								appendTo: parentElement,
				//				resolve: {
				//					items: function () {
				//						return $ctrl.items;
				//					}
				//				}
							});
					
					/*
							modalInstance.result.then(function (selectedItem) {
								//$ctrl.selected = selectedItem;
							}, function () {
								$log.info('Modal dismissed at: ' + new Date());
							});
					*/
					
						} //end if (found parent element)
					
					} //end if (valid template URL)
				
				} //end if (valid container id)
				
			} //end if (valid id)
	
		}; //end openModal()
		
		
		
		
		$scope.closeModal = function(modalId) {
								console.log("here2");
			//valid id
			if (modalId && modalId.length>0) {
					console.log("here1");			
				//instance exists
				if ($scope.modals && $scope.modals[modalId]) {
					console.log("here");
					//close modal
					$scope.modals[modalId].cancel();
					$scope.modals[modalId] = null;
					
				} //end if (valid instance)
			
			} //end if (valid id)
			
		}; //end closeModal()
	
		
		
		
		
		//------------------------------------------------------//
		//----					SWIPE						----//
		//------------------------------------------------------//		
		
		
		//== SWIPE CONFIGURATION ==//
		/*
		//get base form
		$scope.form = document.forms['questionForm'];
		
		//question swipe elements
		$scope.container = angular.element(document.getElementById('question-container'));
		if ($scope.form) {
			$scope.answerElement = $scope.form.elements['scriptValue'];
		}
		$scope.answerAccept = angular.element(document.getElementById('answer-accept'));
		$scope.answerReject = angular.element(document.getElementById('answer-reject'));
		
		//handle question selection
		$scope.questionAnswered = function(value) {

			//valid form
			if ($scope.form) {

				//set answer value
				if ($scope.answerElement) {
					$scope.answerElement.setAttribute('value', value);
					
					//submit form
					$scope.form.submit();	
				}
				
			} //end if (valid form)
			
		}; //end questionAnswered()
		
		
		$scope.withinElement = function(elem, position) {
			
			//valid element
			if (elem && elem[0] && position) { 
			
				var rect = elem[0].getBoundingClientRect();
//			console.log("rect: " + rect.left + ", " + rect.top + " - " + rect.width + ", " + rect.height);
				
				//get element bounds
				var elemBounds = { 
					left: rect.left,
					right: rect.left + rect.width,
					top: rect.top,
					bottom: rect.top + rect.height
				};

				return ((position.x >= elemBounds.left && position.x < elemBounds.right) && (position.y >= elemBounds.top && position.y < elemBounds.bottom))
		     
			} //end if (valid element)
			
			return false;
			
		 }; //end withinElement()
		
		
		
		//== SWIPE LISTENERS ==//
		
		//add drag listener
		$scope.$on('gesture-drag-end', function (event, data) {
			
			//found data
			if ($scope.container && data) {
				
				//determine ratio
				var maxWidth = $scope.container.prop('offsetWidth');
				var ratio = data.dragOffset.x / maxWidth;
				
				//console.log("ratio: " + ratio + " - maxWidth: " + maxWidth + " - offset: " +  data.dragOffset.x);
				//selection made
				if (ratio<-0.4) {
					//console.log("select left");	
					$scope.questionAnswered(0);
				}
				else if (ratio>0.4) {
					//console.log("select right");
					$scope.questionAnswered(1);	
				}
			
			
			} //end if (valid elements)
			
		});
		
		
		
		//add swipe listener
		$scope.$on('gesture-swipe-left', function (event) {
			//console.log("swipe left");
			$scope.questionAnswered(0);
		});
		$scope.$on('gesture-swipe-right', function (event) {
			//console.log("swipe right");			
			$scope.questionAnswered(1);
		});
		
		
		$scope.$on('gesture-click', function (event, data) {
			
			//click within reject element
			if ($scope.withinElement($scope.answerReject, data.position)) {
				//console.log("click left");
				$scope.questionAnswered(0);
			}
			
			//click within accept element
			else if ($scope.withinElement($scope.answerAccept, data.position)) {
				//console.log("click right");
				$scope.questionAnswered(1);
			}
			
		});
		*/
			
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