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

<div class="text-center page-padding-small">
	
	<div class="page-padding-tiny">
	
		<div class="spacer-medium"></div>

		<div class="no-margins size-3 color-2 font-3">{!! $title !!}</div>

		<div class="spacer-large"></div>

		<div class="no-margins size-7 color-2 font-9">{!! $subtitle !!}</div>

		<div class="spacer-large"></div>
	
		{{-- Re-verify button --}}
		<a href="{{ route('belif.reverify') }}" class="color-2">
			<h4 class="button-link">{!! $buttonNo !!}</h4>
		</a>
		
	</div>

	<div class="spacer-large"></div>
	<div class="spacer-large"></div>
	@include('belif::layouts.footer')

</div>

@stop
{{--------------- END CONTENT ----------------}}
