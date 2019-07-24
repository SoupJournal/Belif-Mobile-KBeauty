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
		
		<div class="page-padding-small">
	
			<div class="spacer-medium"></div>
			
			<div class="font-4 color-2 size-6">{!! $title !!}</div>
		
			<div class="spacer-small"></div>
			
			<div load-style="fade" load-group="page">

				<div style="margin: -5px 0;"><img src="https://soup-journal-app-storage.s3.amazonaws.com/belif/Surfsup/aqua_quiz_guide_p2.png" class="page-image" /></div>

				{{-- html --}}
				@if ($html && strlen($html)>0) 
					<div class="bg-color-12 row-left guide-block">
						<div class="color-2 guide-text no-margins">{!! $html !!}</div>
					</div>
				@endif
		
				<div class="spacer-small"></div>
	
				{{-- text --}}
				<div class="font-1 color-2 size-6 page-margin-large">
					{!! $text !!}
				</div>
	
				<div class="spacer-small"></div>
			
				{{-- next button --}}
				<a href="{{ $buttonURL }}" class="button-page bg-color-12 color-2 font-3" label="{{ $button }}">
					{{ $button }}
				</a>
					
			</div>
					
		</div>

	</div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
