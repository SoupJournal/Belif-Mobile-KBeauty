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
	$image = safeArrayValue('image', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$buttonNo = safeArrayValue('button_cancel', $pageData, "");
	
?>

<div class="text-center page-padding-small">
	

		
	<div class="spacer-large"></div>
	
	<div class="row page-margin-small">
	
		{{-- title --}}
		<h2 class="bold page-padding-small">{{ $title }}</h2>
	
		<div class="spacer-small"></div>
	

	
		{{-- image --}}
		@if ($image && strlen($image)>0) 
			<div class="page-padding-medium">
				<img src="{{ $image }}" class="page-image" load-style="fade" load-group="page">
			</div>
		@endif
		
		
		<!-- load group -->
		<div load-style="fade" load-group="page">
	
		
			{{-- info --}}
			<h3 class="title-light page-padding">{{ $text }}</h3>
		
			
			<div class="spacer-medium"></div>
			
			
			{{-- Next button --}}
			<a href="" class="button-page bg-color-3 color-2">
				<h4 class="button-link">{{ $button }}</h4>
			</a>
		
		
			{{-- Re-verify button --}}
			<a href="{{ route('belif.reverify') }}" class="button-page color-1">
				<h4 class="button-link">{{ $buttonNo }}</h4>
			</a>
		
		</div>
		<!-- load group -->
		
	
	</div>

	<div class="spacer-larger"></div>
		

	
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
