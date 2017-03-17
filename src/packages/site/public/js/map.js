//anonymous function to load features without name conflicts
(function() {
	
	//setup module
	var module = angular.module('maps', ['ngResource']); 
	
	
	/*
	module.service('lazyLoadApi', function lazyLoadApi($window, $q) {
		
		//create promise
		var deferred = $q.defer();
		
		//script loader
		function loadScript() {
			
			console.log('loadScript')
			// use global document since Angular's $document is weak
			var s = document.createElement('script')
			s.src = '//maps.googleapis.com/maps/api/js?sensor=false&language=en&callback=initMap'
			document.body.appendChild(s)
			
		};
		
		$window.initMap = function() {
			deferred.resolve()
		}
		
		//add page load listener
		if ($window.attachEvent) {
			$window.attachEvent('onload', loadScript)
		} else {
			$window.addEventListener('load', loadScript, false)
		}
		
		//return promise
		return deferred.promise;
		
	}); //end service
	*/
	
	
	/**
	* 	Google Map View - generate map view
	**/
	module.directive('googleMap', function($window, $log) {
		
		//map callbacks
		var mapCallbacks = [];
		
		//setup map callback
		$window.googleMapDirectiveCallback = function() {

			if (mapCallbacks) {
				
				//trigger callbacks
				var callback = null;
				while (mapCallbacks.length>0) {
					
					//get callback
					callback = mapCallbacks.shift();
					if (callback && typeof(callback)=='function') {
					
						//trigger callback
						try {
							callback();		
						}
						catch (ex) {
							$log.error('ERROR triggering map callback: ' + ex);
						}

					} //end if (valid callback)
					
				} //end while()
			
			} //end if (has callbacks)
		}
		
		return {
			restrict: 'A',
			scope: {
				googleMap: '@',
				mapWidth: '@',
				mapHeight: '@',
				mapZoom: '@',
				mapPosition: '@',
				mapMarkers: '@'
			},
			link: function(scope, element, attrs) {
				
				//set defaults
				var zoom = parseInt(scope.mapZoom);
				scope.zoom = zoom>0 ? zoom : 4;
				
				//decode position properties
				if (scope.mapPosition && scope.mapPosition.length>0) {
					try {
						//decode position
						scope.position = JSON.parse(scope.mapPosition);
					}
					catch (ex) {
						//use default
						scope.position = {lat: -25.363, lng: 131.044};
						$log.warn('WARNING failed to decode map position, using default');
					}	
				}
				
				//decode marker properties
				if (scope.mapMarkers && scope.mapMarkers.length>0) {
					try {
						//decode position
						scope.markers = JSON.parse(scope.mapMarkers);
					}
					catch (ex) {
						scope.markers = null;
						$log.warn('WARNING failed to decode map markers');
					}	
				}
				
				
				//map initialisation method (called from Google API)
				scope.initMap = function() {
					
					//valid element
					if (element && element.length>0) {
						
						//size element
						if (scope.mapWidth && scope.mapWidth.length>0) {
							element.css('width', scope.mapWidth);
						}
						if (scope.mapHeight && scope.mapHeight.length>0) {
							element.css('height', scope.mapHeight);
						}

						//create map
						var map = new google.maps.Map(element[0], {
							zoom: scope.zoom,
							center: scope.position
						});
	
						//add markers
						if (scope.markers && scope.markers.length>0) {
							
							//create markers
							for (var i=0; i<scope.markers.length; ++i) {
								
								try {
									//add marker
									new google.maps.Marker({
										position: scope.markers[i],
										map: map
									});
								}
								catch (ex) {
									$log.warn('WARNING failed to add map marker[' + i + ']: ' + ex);
								}
								
							} //end for()
							
						} //end if (add markers)
						
					}
					
				};
				
				
				//found API key
				if (scope.googleMap && scope.googleMap.length>0) {
					
					//add callback
					mapCallbacks.push(scope.initMap);
					
					//load script (use global document as Angular's $document is weak)
			        var script = document.createElement('script');
			        script.src = 'https://maps.googleapis.com/maps/api/js?key=' + scope.googleMap + '&callback=googleMapDirectiveCallback';
			        document.body.appendChild(script);
				
				} //end if (valid API key)
				
			}
		}
	}); //end directive
	
	
		
})();
//end anonymous function