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

	//ensure page properties are set
	$formURL = isset($formURL) ? $formURL : '';
	$termsURL = isset($termsURL) ? $termsURL : '';

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$html = safeArrayValue('html', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$buttonNo = safeArrayValue('button_cancel', $pageData, "");
	
?>

<div class="text-center">

	<a href="/email" class="landing-button"></a>

	<div class="spacer-large"></div>
	<div class="spacer-large"></div>
	<div class="spacer-large"></div>
	<div class="spacer-large"></div>
	<div class="spacer-large"></div>
	<div class="spacer-large"></div>
	<div class="spacer-medium"></div>

	<div class="no-margins size-4 color-2 font-7 landing-letitglow">{!! $html !!}</div>

	<button class="button-page bg-color-15 color-2 font-3" label="{{ $button }}">
		<a href="{!! $text !!}">{{ $button }}</a>
	</button>

	<div><p><br/><a href="{!! $termsURL !!}" style="color:#000000;text-decoration:none;">Terms and Conditions</a></p></div>

	<div class="spacer-large"></div>
	<div class="spacer-large"></div>
	<div class="spacer-medium"></div>


	@include('belif::layouts.footer')

</div>

@stop
{{--------------- END CONTENT ----------------}}
