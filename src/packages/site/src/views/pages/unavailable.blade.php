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
	$button = safeArrayValue('button', $pageData, "");
	$buttonNo = safeArrayValue('button_cancel', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	
?>

<div class="text-center page-padding">
	
	<div class="page-padding-tiny">

		<div class="spacer-medium"></div>
	
		{{-- title --}}
		<div class="no-margins size-7 color-2 font-3 stroke">{!! $title !!}</div>

		<div class="spacer-medium"></div>

		{{-- image --}}
		@if ($image && strlen($image)>0) 
			<div>
				<img src="{{ $image }}" class="page-image" load-style="fade" load-group="page">
			</div>
		@endif

		<div class="spacer-medium"></div>

		{{-- info --}}
		<div class="no-margins size-6 color-2 font-3">{!! $text !!}</div>
		
		<div class="spacer-medium"></div>
	
		<a href="{{ $buttonNo }}" class="button-page button-next bg-color-14 color-2 font-3" innerclass="color-2" label="{{ $button }}" image="{{ $assetPath }}/images/logo-instagram.png" target="_blank">
			{{ $button }} <div class="button-instagram-icon"><img src="{{ $assetPath }}/images/logo-instagram.png" width="16" /></div>
		</a>

	</div>	

</div>

@stop
{{--------------- END CONTENT ----------------}}
