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

	use Soup\Mobile\Lib\AppGlobals;

	//ensure page data is set
	$pageData = isset($pageData) ? $pageData : null;
	$user = isset($user) ? $user : null;

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
//	$subtext = safeArrayValue('subtext', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$secondaryButton = safeArrayValue('secondary_button', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	
	//determine if member request option available
	$memberStatus = safeObjectValue('status', $user, AppGlobals::USER_STATUS_UNSUBSCRIBED);
	$showMemberRequest = ($memberStatus==AppGlobals::USER_STATUS_INQUIRY || $memberStatus==AppGlobals::USER_STATUS_REGISTERED) ? true : false;
	
?>

{{-- background image --}}
<img class="page-image" src="{{ $backgroundImage }}" load-style="fade" load-group="main">

<div class="page-overlay bg-color-opacity-2" load-style="fade" load-group="main">

	{{ Form::open(Array('role' => 'form', 'name' => 'loginForm', 'class' => 'row-centered')) }}
	
		{{-- login page --}}
		<div class="page-container page-padding-medium">


			{{-- title --}}
			<h1>{{ $title }}</h1>
			
			<div class="spacer-small-2"></div>
			
			
			{{-- description --}}
			<h4 class="title-regular">{!! $subtitle !!}</h4>
			
			<div class="spacer-small"></div>

		</div>


		<div class="page-container page-padding-large">

			{{-- enter name --}}
			<div class="form-group page-padding-medium"> 
			
				<div class="page-input-text input-container">
					{{ Form::text('code', null, Array ('placeholder' => 'Enter Invitation Code', 'class' => 'page-input-text small input-left input-padding-large input-clear', 'tabindex' => '1', 'required' => '', 'autofocus' => '', 'auto-next-focus' => '')) }}
					<button class="button-input border-color-1">
						<h4 class="clear-header-margins title-semi-bold">Enter</h4>
					</button>
				</div>
				
			</div>
			
		</div>
		
		<div class="page-container page-padding-medium">	
			
			{{-- display form errors --}}
		    @if ($errors->has())
		    
		        @foreach ($errors->all() as $error)
		            <div class='bg-danger alert clear-padding'><h5 class="clear-header-margins">{{ $error }}</h5></div>
		        @endforeach
		        
		    @else
				
				<div class="spacer-medium"></div>
				<div class="spacer-small"></div>
				
			@endif
				
			
				
			
			{{-- membership --}}
			<div class="form-group">
		
				<div class="spacer-small-2"></div>
		
				<button class="button-page-round bg-color-5 color-2">
					<div class="spacer-miniscule"></div>
					<h4 class="clear-header-margins">{{ $button }}</h4>
					<div class="spacer-miniscule"></div>
				</button>

			</div>


		@if ($showMemberRequest) 

			<div class="spacer-tiny"></div>
			<a href="{{ route('soup.signup.request') }}">
				<h4 class="title-regular color-1">{!! $text !!}</h4>
			</a>


		@else 
		
			<div class="spacer-medium"></div>
			<div class="spacer-tiny"></div>
		
		@endif


			<div class="spacer-medium"></div>
			<div class="spacer-tiny"></div>

			

			{{-- footer --}}
			<h5>{!! $secondaryButton !!}</h5>
		
			
			<div class="spacer-medium"></div>
			<div class="spacer-small"></div>
			
		@if (!$showMemberRequest) 
			<div class="spacer-small"></div>
		@endif
		
		</div>
		
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
