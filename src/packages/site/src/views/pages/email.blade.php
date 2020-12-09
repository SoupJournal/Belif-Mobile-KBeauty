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

	<div class="spacer-large"></div>
	<div class="spacer-large"></div>
	<div class="spacer-large"></div>
	<div class="spacer-large"></div>
	<div class="spacer-small"></div>
	<div class="spacer-small"></div>
	<div class="spacer-tiny"></div>

	<div class="green-x"><a href="/">X</a></div>
	<button class="email-button button-page bg-color-15 color-2 font-3" label="{{ $button }}">
		{{ $button }}
	</button>
	<div class="email-letitglow form-group page-padding-small bg-color-1">

		<div class="form-text size-3 color-2 font-7">{!! $text !!}</div>
		<div class="form-group">
			{{ Form::text('firstname', null, Array ('placeholder' => 'FIRST NAME', 'class' => 'letitglow-small color-1', 'tabindex' => '1')) }}
			{{ Form::text('lastname', null, Array ('placeholder' => 'LAST NAME', 'class' => 'letitglow-large color-1', 'tabindex' => '2')) }}
		</div>
		<div class="form-group">
			{{ Form::email('email', null, Array ('placeholder' => 'EMAIL ADDRESS', 'class' => 'letitglow-large color-1', 'tabindex' => '3')) }}
			{{ Form::text('zipcode', null, Array ('placeholder' => 'ZIP CODE', 'class' => 'letitglow-small color-1', 'tabindex' => '4')) }}
		</div>

		<div class="spacer-medium"></div>
	</div>

	<div><p><br/><a href="{!! $termsURL !!}" style="color:#000000;text-decoration:none;">Terms and Conditions</a></p></div>
	
	{{-- display form errors --}}
	@if ($errors->has())
		@foreach ($errors->all() as $error)
			<div class='bg-danger alert'>{{ $error }}</div>
		@endforeach
	@endif

	{{ Form::close() }}

	<div class="spacer-large"></div>
	<div class="spacer-large"></div>
	<div class="spacer-medium"></div>

	@include('belif::layouts.footer')

</div>

@stop
{{--------------- END CONTENT ----------------}}
