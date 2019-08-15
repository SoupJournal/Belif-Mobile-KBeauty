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
      
	@if ($debugMode) 
		{{ HTML::script('soup/cms/js/core/debug.js') }}
	@endif

	{{-- import angularjs version of bootstrap ui --}}
	{{-- HTML::script('soup/cms/js/bootstrap/ui-bootstrap-2.4.0.js') --}}

	{{----------------- SCRIPTS ------------------}}
      
		@yield('scripts')

	{{--------------- END SCRIPTS ----------------}}
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E=" crossorigin="anonymous"></script>
	
	{{-- custom app scripts --}}
	{{-- HTML::script($assetPath . '/js/gui.js') --}}
	{{-- HTML::script($assetPath . '/js/core.js') --}}
	{{-- HTML::script($assetPath . '/js/swipe.js') --}}
	{{-- HTML::script($assetPath . '/js/forms.js') --}}
	
	<!-- add style -->
    {{ HTML::style($assetPath . '/css/theme.css') }} 
    {{ HTML::style($assetPath . '/css/colours.css') }} 
    {{ HTML::style($assetPath . '/css/fonts.css') }} 
    {{ HTML::style($assetPath . '/css/page.css') }} 
	
	{{-- Google Analytics --}}
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-145757171-1"></script>
	<script>
	 window.dataLayer = window.dataLayer || [];
	 function gtag(){dataLayer.push(arguments);}
	 gtag('js', new Date());

	 gtag('config', 'UA-145757171-1');
	</script>

	