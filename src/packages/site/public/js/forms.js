//anonymous function to load features without name conflicts
(function() {
	
	//setup module
	var module = angular.module('forms', ['ngResource']); 
	
	
	
	
	/**
	* 	Auto Next Focus - focus on next tab elment if enter pressed
	**/
	module.directive('autoNextFocus', function() {
		return {
			restrict: 'A',
			link: function($scope,elem,attrs) {

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
	});
	
	
		
})();
//end anonymous function