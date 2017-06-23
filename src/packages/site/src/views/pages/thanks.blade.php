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
	$html = safeArrayValue('html', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$buttonNo = safeArrayValue('button_cancel', $pageData, "");
	
?>

<div class="text-center page-padding" id="modalContainer">
	
	{{ Form::open(Array('role' => 'form', 'name' => 'addressForm')) }}
	

	
		<div class="spacer-larger"></div>
		<div class="spacer-medium"></div>
		
		<div class="row page-margin">
		
			{{-- title --}}
			<h2 class="large color-2">{{ $title }}</h2>
		
			{{-- <h4 class="color-2">{{ $subtitle }}</h4> --}}
		
		</div>

		
		{{-- info --}}
		<div class="page-margin-large">
			<h4 class="title-light color-2 large">{!! $html !!}</h4>
		</div>
		
		
		{{-- image --}}
		@if ($image && strlen($image)>0) 
			<div class="page-padding-medium">
				<img src="{{ $image }}" class="page-image" load-style="fade" load-group="page">
			</div>
		@endif
		
		
		<div class="spacer-large"></div>
		<div class="spacer-medium"></div>
		<div class="spacer-tiny"></div>
		
		
		<div class="page-padding-medium">
		
			{{-- Next button --}}
			<a href="{{ $buttonURL }}" class="button-page bg-color-3 color-2" label="{{ $button }}">
				{{ $button }}
			</a>
		
		
			{{-- Cancel button --}}
			<a href ng-click="openModal('noFollow', 'modalContainer', 'NoFollow.html');" class="color-1"><h4 class="button-link">{{ $buttonNo }}</h4></a>
				
		
		</div>
	
	
		<div class="spacer-medium">
	

		
	{{ Form::close() }}



	{{-- modal popup --}}
	<script type="text/ng-template" id="NoFollow.html">
        <div class="modal-body" id="modal-body">
            <h3>All good, we highly recommend this crystal ball that may or may not tell you if you've won 🔮!</h3>
        </div>
    </script>


</div>

@stop
{{--------------- END CONTENT ----------------}}
