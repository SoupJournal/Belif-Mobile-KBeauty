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

<div class="text-center page-padding-small">
	
	
	
		<div class="container-top">
		
			<div class="spacer-medium"></div>
			
			<div class="page-padding-medium">
			
				{{-- title --}}
				<h3 class="title-2 color-2 page-padding-small">{!! $title !!}</h3>
			
				<div class="spacer-small"></div>
			
				<h4 class="title-4 color-2 page-padding-small">{!! $subtitle !!}</h4>
			
				
				<div class="spacer-medium"></div>
				
				{{-- image --}}
				@if ($image && strlen($image)>0) 
					<div class="page-padding-very-large">
						<img src="{{ $image }}" class="page-image" load-style="fade" load-group="page">
					</div>
				@endif
			
			</div>
	
		</div>
	

</div>

@stop
{{--------------- END CONTENT ----------------}}
