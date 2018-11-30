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
	
?>

<div class="text-center page-padding">
	
	<div class="page-padding-tiny">

		<div class="spacer-large"></div>
		<div class="spacer-large"></div>
		<div class="spacer-small"></div>
	
		{{-- title --}}
		<h2 class="no-margins title-bold medium color-1">{!! $title !!}</h2>

		<div class="spacer-small"></div>
		
		<h3 class="title-light no-margins small color-1">{!! $subtitle !!}</h3>
		
		<div class="spacer-medium"></div>

		{{-- image --}}
		@if ($image && strlen($image)>0) 
			<div class="page-padding-large">
				<img src="{{ $image }}" class="page-image" load-style="fade" load-group="page">
			</div>
		@endif

	</div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
