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
	$sephoraOptions = [
		'Insider' => 'Insider',
		'VIB' => 'VIB',
		'Rouge' => 'Rouge'
	];

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	
?>

<div class="text-center page-padding">
	
	{{ Form::open(Array('role' => 'form', 'name' => 'addressForm', 'url' => $formURL)) }}

	<div class="page-padding-tiny">

		<div class="spacer-medium"></div>

		<div class="no-margins size-6 color-2 font-3 stroke">{!! $title !!}</div>
	
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
					{{ Form::select('state', $states, 'State', Array ('placeholder' => 'State', 'class' => 'page-input-text color-1 page-input-select input-padding-very-large', 'auto-next-focus' => '')) }}
					</select-button>
				</span>
			</div>

			{{-- sephora question --}}
			<div class="form-group">
				<select-button class="page-input-text color-1" label-class="page-input-select-overlay stretch-to-fit">
					{{ Form::select('sephora', $sephoraOptions, 'What Sephora member are you?', Array ('placeholder' => 'What Sephora member are you?', 'class' => 'page-input-text color-1 page-input-select', 'auto-next-focus' => '')) }}
				</select-button>
			</div>

			{{-- display form errors --}}
		    @if ($errors->has())
		        @foreach ($errors->all() as $error)
		            <div class='bg-danger alert'>{{ $error }}</div>
		        @endforeach
		        
		    @else
				<div class="spacer-small"></div>
		    @endif
			
			{{-- submit button --}}
			<button class="button-page button-next bg-color-14 color-2 font-3" label="{{ $button }}">
				{{ $button }}
			</button>

		</div>
		
		<div class="spacer-small"></div>
		
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
