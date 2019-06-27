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
	$buttonURL = isset($buttonURL) ? $buttonURL : null;

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	$html = safeArrayValue('html', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	
?>

<div class="text-center">
	
	<div class="container-top">
		
		<div class="row page-margin-small">

			<div class="spacer-large"></div>
			<div class="spacer-large"></div>

			{{-- title --}}
			<h1 class="no-margins title-bold large color-12">{!! $title !!}</h1>
		
			<div class="spacer-small"></div>
			
			<!-- load group -->
			<div load-style="fade" load-group="page">

				{{-- html --}}
				@if ($html && strlen($html)>0) 
					<div class="row-left guide-block">
						<h4 class="title-bold color-12 guide-text">{!! $html !!}</h4>
					</div>
				@endif
		
				<div class="spacer-tiny"></div>

				{{-- next button --}}
				<a href="{{ $buttonURL }}" class="button-page bg-color-2 color-1 font-3 size-6" label="{{ $button }}">
					{{ $button }}
				</a>
	
				<div class="spacer-medium"></div>

				{{-- text --}}
				<p class="title-bold color-12 page-margin-large">
					{!! $text !!}
				</p>

				<div class="spacer-medium"></div>

			</div>
			<!-- load group -->
					
		</div>

	</div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
