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

<div class="text-center page-padding">
	
	{{ Form::open(Array('role' => 'form', 'name' => 'addressForm')) }}
	
		<div class="container-top">
		
			<div class="spacer-larger"></div>
			<div class="spacer-small"></div>
			
			<div class="row page-margin">
			
				{{-- title --}}
				<h2 class="bold color-2">{{ $title }}</h2>
			
				<h4 class="color-2">{{ $subtitle }}</h4>
			
			</div>
	
		</div>
	
	
		<div id="modalContainer" class="container-bottom stretch-to-width page-padding-small-absolute">
	
			<div class="row">
			
			
			
				{{-- info --}}
				<div class="row page-margin">
					<h2 class="bold color-1 box-padding">{{ $text }}</h2>
				</div>
			
				<div class="spacer-medium">
			
				<page-button href="https://www.instagram.com/belifusa/" class="button-next bg-color-1 small" innerclass="color-2" label="{{ $button }}" image="{{ $assetPath }}/images/logo-instagram.png"></page-button>
			
			
				{{-- Cancel button --}}
				<a href ng-click="openModal('noFollow', 'modalContainer', 'NoFollow.html');" class="color-1"><h4 class="button-link">{{ $buttonNo }}</h4></a>
					
			
			</div>
		
			<div class="spacer-medium">
		
		</div>
		
	{{ Form::close() }}



	{{-- modal popup --}}
	<script type="text/ng-template" id="NoFollow.html">
        <div class="modal-body" id="modal-body">
            <h3>All good, we highly recommend this crystal ball that may or may not tell you if you've won 🔮!</h3>
        </div>
    </script>


</div>

@stop
{{--------------- END CONTENT ----------------}}
