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
	
?>

<div class="text-center page-padding">
	
		<div class="container-top">
		
			<div class="spacer-larger"></div>
			<div class="spacer-small"></div>
			
			<div class="row page-margin">
			
				{{-- title --}}
				<h2 class="bold color-2">{{ $title }}</h2>
			
				<h4 class="color-2">{{ $subtitle }}</h4>
			
			</div>
	
		</div>
	




</div>

@stop
{{--------------- END CONTENT ----------------}}
