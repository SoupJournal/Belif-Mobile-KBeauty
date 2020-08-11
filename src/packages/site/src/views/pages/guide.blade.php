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
		
		<div>
	
			<div class="spacer-medium"></div>
			
			<div class="no-margins size-7 color-2 font-3 stroke">{!! $title !!}</div>

			<div class="guide-block-image">
				<img src="{!! $image !!}" class="page-image" />
				{{-- html --}}
				@if ($html && strlen($html) > 0)
					<div class="bg-color-14 row-left guide-block">
						<div class="color-2 guide-text no-margins">{!! $html !!}</div>
					</div>
				@endif
			</div>

			<div class="spacer-large"></div>
			<div class="spacer-large"></div>
			<div class="spacer-large"></div>

			<div class="spacer-small"></div>

			{{-- next button --}}
			<a href="{{ $buttonURL }}" class="button-page bg-color-14 color-2 font-3" label="{{ $button }}">
				{{ $button }}
			</a>

			<div class="spacer-medium"></div>
					
		</div>

	</div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
