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
	$formURL = isset($formURL) ? $formURL : "";
	$states = isset($states) ? $states : null;

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	
?>

<div class="text-center page-padding">
	
	{{ Form::open(Array('role' => 'form', 'name' => 'addressForm', 'url' => $formURL)) }}
	
	<div class="page-padding-tiny">

		<div class="spacer-large"></div>
		<div class="spacer-large"></div>
		<div class="spacer-large"></div>
	
		{{-- title --}}
		<h2 class="no-margins title-bold medium color-1">{!! $title !!}</h2>
	
		<div class="spacer-medium"></div>

		<div class="page-padding-medium">

			{{-- name --}}
			<div class="form-group"> 
				{{ Form::text('name', null, Array ('placeholder' => 'Full Name', 'class' => 'page-input-text color-1', 'autofocus' => '', 'auto-next-focus' => '')) }}
			</div>

			{{-- address 1 --}}
			<div class="form-group"> 
				{{ Form::text('address_1', null, Array ('placeholder' => 'Address line 1', 'class' => 'page-input-text color-1', 'auto-next-focus' => '')) }}
			</div>
			
			<div class="form-group input-flex"> 
				{{-- address 2 --}}
				<span class="input-address-2-left">
					{{ Form::text('address_2', null, Array ('placeholder' => 'Address line 2', 'class' => 'page-input-text color-1', 'auto-next-focus' => '')) }}
				</span>

				{{-- zip code --}}
				<span class="input-address-2-right">
					{{ Form::input('number', 'zip_code', null, Array ('placeholder' => 'ZIP', 'class' => 'page-input-text color-1', 'pattern' => '[0-9]*')) }}
				</span>
			</div>
			
			<div class="form-group input-flex">
				{{-- city --}}
				<span class="input-city-left">
					{{ Form::text('city', null, Array ('placeholder' => 'City', 'class' => 'page-input-text color-1', 'auto-next-focus' => '')) }}
				</span>
		
				{{-- state --}}
				<span class="input-city-right">
					<select-button class="page-input-text color-1 page-input-place-holder input-padding-zero" label-class="page-input-select-overlay stretch-to-fit">
					{{ Form::select('state', $states, 'State', Array ('placeholder' => 'State', 'class' => 'page-input-text color-1 page-input-select input-padding-very-large', 'ng-model' => 'state', 'ng-change' => '$parent.valueUpdated(state, this);', 'auto-next-focus' => '')) }}
					</select-button>
				</span>
			</div>

			{{-- display form errors --}}
		    @if ($errors->has())
		        @foreach ($errors->all() as $error)
		            <div class='bg-danger alert'>{{ $error }}</div>
		        @endforeach
		        
		    @else
		        <div class="spacer-large">
		    @endif

			<div class="spacer-large">

			{{-- submit button --}}
			<button class="button-page button-next bg-color-2 color-1 size-6" label="{{ $button }}">
				{{ $button }}
			</button>

		</div>
		
		<div class="spacer-small"></div>
		
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
