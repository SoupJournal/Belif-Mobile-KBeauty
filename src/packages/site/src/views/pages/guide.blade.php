@extends('belif::layouts.master')


{{------------------ TITLE -------------------}}

@section('title') Belif @stop

{{---------------- END TITLE -----------------}}




{{----------------- SCRIPTS ------------------}}

@section('scripts')

	{{-- HTML::script('packages/artisan/cms/js/cms/form/form.js') --}}	
	
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
		
		
			<div class="spacer-medium"></div>
			
		
			{{-- title --}}
			<h2 class="medium color-2">{{ $title }}</h2>
		
		
			<div class="spacer-medium"></div>
			
			{{-- image --}}
			@if ($image && strlen($image)>0) 
				<div class="page-padding-medium title-light">
					<img src="{{ $image }}" class="page-image" load-style="fade" load-group="page">
				</div>
			@endif
			
			<!-- load group -->
			<div load-style="fade" load-group="page">

				{{-- html --}}
				@if ($html && strlen($html)>0) 
					<div class="bg-color-1 row-left guide-block">
						<!-- div class="stretch-to-fit bg-color-2 opacity-50"></div -->
						<h4 class="title-3 color-2 guide-text no-margins">{!! $html !!}</h4>
					</div>
				@endif
		
				<div class="spacer-tiny"></div>
	
				{{-- text --}}
				<h4 class="title-light color-2 page-margin-large">
					{{ $text }}
				</h4>
	
				<div class="spacer-small"></div>
			
				{{-- next button --}}
				<a href="{{ $buttonURL }}" class="button-page bg-color-3 color-2" label="{{ $button }}">
					{{ $button }}
				</a>
					
			</div>
			<!-- load group -->
					
			<div class="spacer-small"></div>
		
		</div>

	</div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
