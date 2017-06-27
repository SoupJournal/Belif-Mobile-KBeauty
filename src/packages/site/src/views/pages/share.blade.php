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

 	//ensure page properties are set
	$buttonURL = isset($buttonURL) ? $buttonURL : null;

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$html = safeArrayValue('html', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$buttonNo = safeArrayValue('button_cancel', $pageData, "");
	
?>

<div class="text-center" ng-controller="BelifController" id="modalContainer">
	
	{{ Form::open(Array('role' => 'form', 'name' => 'shareForm')) }}
	

		<div class="spacer-medium"></div>
		<div class="spacer-tiny"></div>
		
	
		<div class="page-padding-small">
	
			{{-- title --}}
			<h2 class="large color-2 no-margins">{{ $title }}</h2>
		
			<div class="spacer-small"></div>
		
			<h4 class="title-light large color-2 no-margins">{{ $subtitle }}</h4>
		
			<div class="spacer-small"></div>

		</div>


		<div class="page-padding-large">
	
			{{-- image --}}
			@if ($image && strlen($image)>0) 
				<div class="page-padding-larger">
					<img src="{{ $image }}" class="page-image" load-style="fade" load-group="page">
				</div>
			@endif
			
		</div>


		<div class="page-padding-large">

			<div class="spacer-small"></div>

			<div class="box-margin">
				{{-- Form::textArea('email', null, Array ('placeholder' => $text, 'class' => 'page-input-text share-text-area', 'required' => '', 'autofocus' => '', 'rows' => '3')) --}}
				<!-- <h4 class="title-light color-2">{!! $text !!}</h4> -->
			</div>
		

		
			{{-- enter email --}}
			<div class="form-group"> 
			
				{{ Form::email('email', null, Array ('placeholder' => 'Yourfriends@email.com', 'class' => 'page-input-text', 'required' => '', 'autofocus' => '')) }}
				
			</div>
		
			{{-- display form errors --}}
		    @if ($errors->has())
		        @foreach ($errors->all() as $error)
		            <div class='bg-danger alert'>{{ $error }}</div>
		        @endforeach
		    @endif
		
		
	
		
			<div class="spacer-medium"></div>
			
			<h5 class="title-light color-2 no-margins">{!! $html !!}</h5>
			
			<div class="spacer-medium"></div>
			

			{{-- submit button --}}
			<button class="button-page bg-color-3 color-2" label="{{ $button }}">
				{{ $button }}
			</button>
		
			{{-- Cancel button --}}
			<a href ng-click="openModal('noShare', 'modalContainer', 'NoShare.html');" class="color-1"><h4 class="button-link">{{ $buttonNo }}</h4></a>
				
		

		
			<div class="spacer-larger"></div>
			<div class="spacer-small"></div>
		
		</div>
		
	{{ Form::close() }}


	{{-- modal popup --}}
	<script type="text/ng-template" id="NoShare.html">
        <div class="modal-body" id="modal-body">
            <h3 class="color-1">No worries! You do you and enjoy belif yourself!</h3>
        </div>
    {{--    <div class="modal-footer text-center">
            <button class="btn" type="button" ng-click="$parent.closeModal('noShare');">Dismiss</button>
        </div> --}}
    </script>

</div>

@stop
{{--------------- END CONTENT ----------------}}
