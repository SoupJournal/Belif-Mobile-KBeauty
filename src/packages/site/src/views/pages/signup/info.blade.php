@extends('soup::layouts.master')


{{------------------ TITLE -------------------}}

@section('title') Soup @stop

{{---------------- END TITLE -----------------}}




{{----------------- SCRIPTS ------------------}}

@section('scripts')

	{{-- HTML::script('packages/artisan/cms/js/cms/form/form.js') --}}	
	
@stop
{{--------------- END SCRIPTS ----------------}}





{{----------------- CONTENT ------------------}}

@section('content')

<?php

	//ensure page data is set
	$pageData = isset($pageData) ? $pageData : null;
	$user = isset($user) ? $user : null;

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
//	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
//	$secondaryButton = safeArrayValue('secondary_button', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	
	//get user properties
	$userEmail = safeObjectValue('email', $user, "");
	
	//form submit URL
	$formURL = isset($formURL) ? $formURL : "";
	
?>

{{-- background image --}}
@include('soup::sections.background', ['backgroundImage' => $backgroundImage, 'loadGroup' => 'main'])

<div class="page-overlay bg-color-opacity-2" load-style="fade" load-group="main">

	{{ Form::model($user, Array('role' => 'form', 'name' => 'loginForm', 'class' => 'row-centered')) }}
	
		{{-- login page --}}
		<div class="page-container page-padding-large">


			{{-- title --}}
			<h1>{{ $title }}</h1>

			<div class="spacer-tiny"></div>			
			
			{{-- user email --}}
			<h5 class="clear-header-margins">{{ $userEmail }}</h5>

			<div class="spacer-tiny"></div>


			{{-- enter name --}}
			<div class="form-group"> 
			
				{{ Form::text('first_name', null, Array ('placeholder' => 'First Name', 'class' => 'page-input-text small-margin', 'tabindex' => '0', 'required' => '', 'autofocus' => '', 'auto-next-focus' => '')) }}
				
			</div>
			<div class="form-group"> 
			
				{{ Form::text('last_name', null, Array ('placeholder' => 'Last Name', 'class' => 'page-input-text', 'tabindex' => '1', 'required' => '', 'auto-next-focus' => '')) }}
				
			</div>
				
				
				
			{{-- enter birth date --}}
			<div class="form-group"> 
			
				{{ Form::date('birth_date', ($user->birth_date? $user->birth_date->format('m/d/Y') : null), Array ('placeholder' => 'Date of Birth (MM/DD/YYYY)', 'class' => 'page-input-text', 'tabindex' => '2', 'required' => '', 'autofocus' => '', 'auto-next-focus' => '')) }}
				
			</div>
			
			
			<div class="spacer-tiny"></div>
			
			
			{{-- enter gender --}}
			<div class="form-group"> 
			
				<div class="table-parent fill-height">

					<div class="table-center-row">
					
						<div class="table-column-left">
						
							{{ Form::radio('gender', 'Female', false, Array ('class' => 'page-input-radio', 'required' => '')) }}
							{{ Form::label('female', 'Female', Array('class' => 'title-semi-bold page-text-larger color-1')) }}
							
						</div>
							
							
						<div class="table-column-center">
							
							{{ Form::radio('gender', 'Male', false, Array ('class' => 'page-input-radio', 'required' => '')) }}
							{{ Form::label('male', 'Male', Array('class' => 'title-semi-bold page-text-larger color-1')) }}
			
						</div>
			
			
						<div class="table-column-right">
							
							{{ Form::radio('gender', 'Other', false, Array ('class' => 'page-input-radio', 'required' => '')) }}
							{{ Form::label('other', 'Other', Array('class' => 'title-semi-bold page-text-larger color-1')) }}
							
						</div>
					</div>
				</div>
				
			</div>
			


			{{-- display form errors --}}
		    @if ($errors->has())
		    
			    <div class="spacer-small-2"></div>
		    
		        @foreach ($errors->all() as $error)
		            <div class='bg-danger alert'>{{ $error }}</div>
		        @endforeach
		        
		        <div class="spacer-small-2"></div>
		        
		    @else
				
				<div class="spacer-large"></div>
				
			@endif


		
			{{-- join buttons --}}
			<button class="button-page-round bg-color-5 color-2">
				<div class="spacer-tiny"></div>
				<h4 class="clear-header-margins">{{ $button }}</h4>
				<div class="spacer-tiny"></div>
			</button>


			<div class="spacer-large"></div>
		
		</div>
		
		<div class="page-container page-padding-small">	

			{{-- footer --}}
			<h5>{!! $text !!}</h5>
		
		</div>
		
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
