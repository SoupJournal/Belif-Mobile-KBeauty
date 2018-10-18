<?php

	//CONSTANTS
	$bootstrapVersion = "3.3.2";
	$angularVersion = "1.5.8";
	
	//DEBUG
	$useLocalAPIs = false;
	$debugMode = true;
	
	//ensure properties are set
	$pageName = (isset($pageName) ? $pageName : 'belif');
	$useHTTP = (isset($useHTTP) ? $useHTTP : false);
	
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
		{{ HTML::script('soup/cms/js/core/debug.js') }}
	@endif

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

	{{-- import angularjs version of bootstrap ui --}}
	{{ HTML::script('soup/cms/js/bootstrap/ui-bootstrap-2.4.0.js') }}

	{{----------------- SCRIPTS ------------------}}
      
		@yield('scripts')

	{{--------------- END SCRIPTS ----------------}}
	
	{{-- custom app scripts --}}
	{{ HTML::script($assetPath . '/js/gui.js') }}
	{{ HTML::script($assetPath . '/js/core.js') }}
	{{ HTML::script($assetPath . '/js/swipe.js') }}
	{{ HTML::script($assetPath . '/js/jquery.touchSwipe.min.js') }}
	
	<!-- add style -->
    {{ HTML::style($assetPath . '/css/theme.css') }} 
    {{ HTML::style($assetPath . '/css/colours.css') }} 
    {{ HTML::style($assetPath . '/css/fonts.css') }} 
    {{ HTML::style($assetPath . '/css/page.css') }} 
	
	{{-- Google Analytics --}}
	<script type="text/javascript"> 
		
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  		ga('create', 'UA-90585268-6', 'auto');
 		ga('send', 'pageview', '{{ $pageName }}');
 		
	</script>
	
	{{-- Facebook Pixel Code --}}
	<script>
		!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?			
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
		n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
		document,'script','https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '220888885086120'); // Insert your pixel ID here.
		fbq('track', 'PageView');
	</script>
	<noscript>
		<img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=220888885086120&ev=PageView&noscript=1"/>
	</noscript>
	{{-- DO NOT MODIFY --}}
	{{-- End Facebook Pixel Code --}}
	
	