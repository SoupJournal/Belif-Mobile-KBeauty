@extends('belif::layouts.master')

{{------------------ TITLE -------------------}}

@section('title') Belif @stop

{{---------------- END TITLE -----------------}}

{{----------------- SCRIPTS ------------------}}

@section('scripts')
	
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

<div class="text-center page-padding-small" id="modalContainer">
	
	<div class="page-padding-small">
	
		<div class="spacer-large"></div>
		
		{{-- title --}}
		<h2 class="no-margins title-bold medium color-1">{!! $title !!}</h2>
	
		<div class="spacer-large"></div>
	
		{{-- image --}}
		@if ($image && strlen($image)>0) 
			<div class="page-padding-large">
				<img src="{{ $image }}" class="page-image" load-style="fade" load-group="page">
			</div>
		@endif
		
		<div class="spacer-medium"></div>
		
		<!-- load group -->
		<div load-style="fade" load-group="page">
		
			{{-- info --}}
			<h3 class="title-light page-padding color-1">{!! $text !!}</h3>
		
			<div class="spacer-medium"></div>

			<a href="/" class="button-page button-next bg-color-1 color-2 font-3" innerclass="color-2" label="{{ $button }}">
				{{ $button }}
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
            <h3 class="color-1">An email has been resent 
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
