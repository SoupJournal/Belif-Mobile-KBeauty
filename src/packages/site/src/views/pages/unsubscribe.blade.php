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
	$image = safeArrayValue('image', $pageData, "");

	$unsubscribed = isset($unsubscribed) ? $unsubscribed : 1;
	$formURL = isset($formURL) ? $formURL : '';
	
?>

<div class="text-center">
	
	<div class="container-top">
		
		<div class="page-padding-small">
	
			<div class="spacer-medium"></div>
			
			<div class="no-margins size-6 color-2 font-3">{!! $title !!}</div>

			<div class="spacer-small"></div>
		
			@if ($unsubscribed == true)
				<div class="no-margins size-6 color-2 font-3">You've been unsubscribed.</div>
			@else
			{{ Form::open(Array('role' => 'form', 'name' => 'emailForm', 'url' => $formURL)) }}
				<div class="spacer-medium"></div>
				<div class="no-margins size-5 color-2 font-3">Enter your email address to unsubscribe.</div>
				{{ Form::email('email', null, Array ('placeholder' => 'your@email.com', 'class' => 'page-input-text large color-2', 'tabindex' => '1')) }}
				<div class="spacer-small"></div>
				<button class="button-page bg-color-12 color-2 font-3" label="Unsubscribe">Unsubscribe</button>
			{{ Form::close() }}
			@endif			

		</div>

	</div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
