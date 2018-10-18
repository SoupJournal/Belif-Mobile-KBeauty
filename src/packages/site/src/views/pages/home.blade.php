@extends('belif::layouts.master')


{{------------------ TITLE -------------------}}

@section('title') Belif @stop

{{---------------- END TITLE -----------------}}




{{----------------- SCRIPTS ------------------}}

@section('scripts')

	{{-- HTML::script('packages/artisan/cms/js/cms/form/form.js') --}}	
	
	<?php
	
		//set custom page controllers
		//$pageModules = Array('cms.form');
	
	?>
	
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
	
?>

<div class="text-center">
	
	<div class="container-top">
	
		<div class="spacer-large">
		
		<div class="row page-margin-small">
		
			{{-- title --}}
			<h2 class="title-3 color-4">{{ $title }}</h2>
		
			<h1 class="title-2 color-3">{{ $subtitle }}</h1>
		
		</div>

	</div>


	<div class="container-bottom stretch-to-width">

		<div>
		
			{{-- title --}}
			<div class="shrink-to-fit">
			<div class="bg-color-opacity-1 box-margin">
				<h3 class="title-3 color-4 box-padding">{{ $text }}</h3>
			</div>
			</div>
		
			<div class="spacer-larger">
		
			<page-button href="{{ URL::to('/email') }}" class="button-next bg-color-3" innerclass="color-2" label="{{ $button }}"></page-button>
		
			<div class="spacer-large">
		
		</div>
	
		<div class="spacer-large">
	
	</div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
