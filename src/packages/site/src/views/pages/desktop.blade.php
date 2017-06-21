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
	$image = safeArrayValue('text', $pageData, "");
	
?>

<div class="text-center page-padding-small">
	
	
	
		<div class="container-top">
		
			<div class="spacer-medium"></div>
			
			<div class="row page-margin">
			
				{{-- title --}}
				<h3 class="title-2 color-2 page-padding-small">{{ $title }}</h3>
			
				<h4 class="title-4 color-2 page-padding-small">{{ $subtitle }}</h4>
			
				
				<div class="spacer-landscape"></div>
				
				{{-- image --}}
				<div class="logo-page-image" style="background-image: url({{ $image }});"></div>
			
			</div>
	
		</div>
	

</div>

@stop
{{--------------- END CONTENT ----------------}}
