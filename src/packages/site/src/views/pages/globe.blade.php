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

	<div class="spacer-medium"></div>

	<div class="no-margins size-6 color-2 font-3">{!! $title !!}</div>

	<a href="#" id="video-link" onclick="playVideo()">

		<video id="video" width="100%" height="100%" autoplay="autoplay">
			<source src="https://soup-journal-app-storage.s3.amazonaws.com/letitglow/Snow+Globe+Jump.mp4" type="video/mp4">
		</video>

	</a>

	<div class="spacer-large"></div>
	<div class="spacer-medium"></div>

	@include('belif::layouts.footer')

</div>

<script>
	function playVideo() {
		document.getElementById('video').play();
		setTimeout(nextPage, 1500);
	}
	function nextPage() {
		window.location = '/results';
	}
</script>
@stop
{{--------------- END CONTENT ----------------}}
