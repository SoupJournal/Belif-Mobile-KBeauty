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

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$buttonNo = safeArrayValue('button_cancel', $pageData, "");
	
?>

<div class="text-center page-padding-small">
	
	
	
		<div class="container-top">
		
			<div class="spacer-large"></div>
			
			<div class="row page-margin-small">
			
				{{-- title --}}
				<h2 class="bold color-1 page-padding-small">{{ $title }}</h2>
			
				<div class="spacer-small"></div>
			
				<h4 class="color-1 page-padding">{{ $subtitle }}</h4>
			
			</div>
	
		</div>
	
	
		<div id="modalContainer" class="container-bottom stretch-to-width page-padding-small-absolute">
	
			<div class="row">
			
			
			
				{{-- info --}}
				<h2 class="bold color-1 page-padding">{{ $text }}</h2>
			
				
				{{-- Re-verify button --}}
				<a href="{{ URL::to('/reverify') }}" class="color-1"><h4 class="button-link">{{ $button }}</h4></a>
			
			
			</div>
		
			<div class="spacer-larger"></div>
		
		</div>
		
	
	{{-- modal popup --}}
	<script type="text/ng-template" id="ResentEmail.html">
        <div class="modal-body" id="modal-body">
            <h3>An email has been resent 
            	@if (isset($verifyEmail) && $verifyEmail)
		            to {{ $verifyEmail }}
		        @endif
            </h3>
        </div>
    </script>
	
	
	{{-- show verify message --}}
	@if (isset($verifyEmail) && $verifyEmail)
		<div ng-controller="BelifController" ng-init="openModal('emailSent', 'modalContainer', 'ResentEmail.html');"></div>
	@endif

</div>

@stop
{{--------------- END CONTENT ----------------}}
