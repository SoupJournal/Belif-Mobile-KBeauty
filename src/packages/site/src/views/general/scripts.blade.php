<?php

	//CONSTANTS
	$bootstrapVersion = "3.3.2";
	$angularVersion = "1.5.8";
	
	
	//DEBUG
	$useLocalAPIs = false;
	$debugMode = true;
	
	
	//ensure page name is set
	$pageName = (!isset($pageName) ? 'belif' : $pageName);
	
?>


	{{-- Load styles --}}
	@if (isset($useLocalAPIs) && $useLocalAPIs)
	   	<link href="//bootstrap.api.aberration.dev/css/bootstrap.min.css" rel="stylesheet">
	   	<link href="//bootstrap.api.aberration.dev/css/font-awesome.css" rel="stylesheet"> 	
	@else
	   	<link href="//maxcdn.bootstrapcdn.com/bootstrap/{{ $bootstrapVersion }}/css/bootstrap.min.css" rel="stylesheet">
	   	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet"> 
	@endif
      

	{{-- Add libraries --}}
    @if (isset($useLocalAPIs) && $useLocalAPIs)
		<script src="https://angular.api.aberration.dev/angular.min.js"></script>  
		<script src="https://angular.api.aberration.dev/angular-resource.min.js"></script> 	    
	@else
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/{{ $angularVersion }}/angular.min.js"></script>  
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/{{ $angularVersion }}/angular-resource.min.js"></script> 
	@endif

	@if ($debugMode) 
		{{-- HTML::script('site/js/core/debug.js') --}}
	@endif


	{{-- import angularjs version of bootstrap ui --}}
	{{ HTML::script('soup/cms/js/bootstrap/ui-bootstrap-2.4.0.js') }}



	{{----------------- SCRIPTS ------------------}}
      
		@yield('scripts')

	{{--------------- END SCRIPTS ----------------}}
	
	
	
	{{-- custom app scripts --}}
	{{ HTML::script($assetPath . '/js/gui.js') }}
	{{ HTML::script($assetPath . '/js/core.js') }}
	{{ HTML::script($assetPath . '/js/swipe.js') }}
	{{ HTML::script($assetPath . '/js/forms.js') }}
	
	{{-- CMS libaries scripts --}}
	{{ HTML::script($assetPath . '/js/core.js') }}
	
	
	<!-- add style -->
    {{ HTML::style($assetPath . '/css/theme.css') }} 
    {{ HTML::style($assetPath . '/css/colours.css') }} 
    {{-- HTML::style($assetPath . '/css/fonts.css') --}} 
    {{ HTML::style($assetPath . '/css/page.css') }} 
	
	
	
	{{-- Google Analytics --}}
	<script type="text/javascript"> 
		
//		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
//  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
//  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
//  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
//
//  		ga('create', 'UA-91272304-1', 'auto');
// 		ga('send', 'pageview', '{{ $pageName }}');
 		
	</script>
	