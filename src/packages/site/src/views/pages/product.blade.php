@extends('belif::layouts.master')


{{------------------ TITLE -------------------}}

@section('title') Belif @stop

{{---------------- END TITLE -----------------}}




{{----------------- SCRIPTS ------------------}}

@section('scripts')

	{{-- HTML::script('packages/artisan/cms/js/cms/form/form.js') --}}	
	
	<?php
	
		//set custom page controllers
		//$pageModules = Array('cms.form');
	
	?>
	
@stop
{{--------------- END SCRIPTS ----------------}}





{{----------------- CONTENT ------------------}}

@section('content')

<?php

	//ensure page properties are set
	$buttonURL = isset($buttonURL) ? $buttonURL : null;

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, ""); 
	$text = safeArrayValue('text', $pageData, ""); 
	$button = safeArrayValue('button', $pageData, "");
		

?>

<div class="text-center page-padding-small">
	
	<div class="container-top">
	
		<div class="spacer-larger"></div>
		<div class="spacer-small"></div>
		
		<div class="row page-margin-small">
		
			{{-- title --}}
			<h2 class="bold color-2">{{ $title }}</h2>
		
			<h1 class="color-2">{{ $subtitle }}</h1>
		

		
			{{-- title --}}
			<div class="shrink-to-fit page-margin-small">
				<h4 class="page-padding-smallest">{{ $text }}</h4>
			</div>
		
			<div class="spacer-medium"></div>
		
		
		
			{{-- next button --}}
			<a href="{{ $buttonURL }}" class="button-page bg-color-3 color-2" label="{{ $button }}">
				{{ $button }}
			</a>
		
			
			<div class="spacer-small"></div>
		
		</div>
	
		<div class="spacer-large">
	
	</div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
