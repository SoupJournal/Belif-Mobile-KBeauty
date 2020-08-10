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
	$formURL = isset($formURL) ? $formURL : '';
	$termsURL = isset($termsURL) ? $termsURL : '';

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$html = safeArrayValue('html', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$buttonNo = safeArrayValue('button_cancel', $pageData, "");
	
?>

<div class="text-center">
	
	{{ Form::open(Array('role' => 'form', 'name' => 'emailForm', 'url' => $formURL)) }}
	
		<div>
	
			<div class="spacer-small"></div>
		
			{{-- title --}}
			<div class="no-margins size-9 color-2 font-3 stroke">{!! $title !!}</div>

			<div class="spacer-small"></div>

			<div class="no-margins size-4 color-14 font-5">{!! $subtitle !!}</div>

			<div class="spacer-small"></div>

			<div class="no-margins size-4 color-2 font-5"><img src="{!! $image !!}" class="page-image" /></div>

			<div class="spacer-large"></div>
			
			<div class="no-margins size-4 color-2 font-5">{!! $html !!}</div>

			{{-- enter email --}}
			<div class="form-group page-padding-small"> 
			
				{{ Form::email('email', null, Array ('placeholder' => 'your@email.com', 'class' => 'page-input-text large color-2', 'tabindex' => '1')) }}
				
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
			<button class="button-page bg-color-14 color-2 font-3" label="{{ $button }}">
				{{ $button }}
			</button>
			
			<div class="spacer-small"></div>

			<div class="color-2 size-4"><a href="{{ route('belif.unsubscribe') }}" class="color-2">I want to unregister myself.</a></div>

			<div class="spacer-tiny"></div>

			{{-- Terms & Conditions --}}
			<div class="terms">
				<input type="checkbox" name="agree" value="1" /> <a href="{{ $termsURL }}" class="color-2 small" target="_blank">{{ $buttonNo }}</a>
			</div>
			
		</div>
		
	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
