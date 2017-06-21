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
	$buttonNo = safeArrayValue('button_cancel', $pageData, "");
	
?>

<div class="text-center page-padding">
	
	{{ Form::open(Array('role' => 'form', 'name' => 'shareForm')) }}
	
		<div class="container-top">
		
			<div class="stretch-to-width bg-color-opacity-1 box-margin">
				<h4 class="color-1">{{ $text }}</h4>
			</div>
		
			<div class="spacer-huge">
			
			<div class="row page-margin">
			
				{{-- title --}}
				<h2 class="bold color-1">{{ $title }}</h2>
			
				<h4 class="color-1">{{ $subtitle }}</h4>
			
			</div>
	
		</div>
	
	
		<div id="modalContainer" class="container-bottom stretch-to-width page-padding-small-absolute">
	
			<div class="row">
			
			
				{{-- enter email --}}
				<div class="form-group"> 
				
					{{ Form::email('email', null, Array ('placeholder' => 'enter yourfriends@email.com', 'class' => 'page-input-text', 'required' => '', 'autofocus' => '')) }}
					
				</div>
			
				{{-- display form errors --}}
			    @if ($errors->has())
			        @foreach ($errors->all() as $error)
			            <div class='bg-danger alert'>{{ $error }}</div>
			        @endforeach
			    @endif
			
			
			
				{{-- info --}}
				<div class="shrink-to-fit page-margin-small">
				<div>
				{{--	<h4 class="title-3 color-4 box-padding">{{ $text }}</h4> --}}
				</div>
				</div>
			
				<div class="spacer-small"></div>
			
				<form-button class="button-next bg-color-4 color-2" label="{{ $button }}"></form-button>
			
			
				{{-- Cancel button --}}
				<a href ng-click="openModal('noShare', 'modalContainer', 'NoShare.html');" class="color-1"><h4 class="button-link">{{ $buttonNo }}</h4></a>
					
			
			</div>
		
			<div class="spacer-larger"></div>
			<div class="spacer-small"></div>
		
		</div>
		
	{{ Form::close() }}


	{{-- modal popup --}}
	<script type="text/ng-template" id="NoShare.html">
        <div class="modal-body" id="modal-body">
            <h3>No worries! You do you and enjoy belif yourself!</h3>
        </div>
    {{--    <div class="modal-footer text-center">
            <button class="btn" type="button" ng-click="$parent.closeModal('noShare');">Dismiss</button>
        </div> --}}
    </script>

</div>

@stop
{{--------------- END CONTENT ----------------}}
