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
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$buttonNo = safeArrayValue('button_cancel', $pageData, "");

	$firstname = isset($firstname) ? $firstname : null;
	$result = isset($result) ? $result : null;
	$resultType = isset($resultType) ? $resultType : null;

	$formURL = isset($formURL) ? $formURL : null;

//	$productIdx = isset($productIdx) ? $productIdx : 0;
//	$restartURL = isset($restartURL) ? $restartURL : null;
//	$sampleResult = isset($sampleResult) ? $sampleResult : null;
//	$resultImage = isset($resultImage) ? $resultImage : null;
//	$alternativeTitle = isset($alternativeTitle) ? $alternativeTitle : null;
//
//	if (!empty($alternativeTitle)) {
//		$subtitle = $alternativeTitle;
//	}
?>

<div class="text-center page-padding">
	
	@if ($resultType == 'message')

		{{ Form::open(Array('role' => 'form', 'name' => 'shareForm', 'url' => $formURL)) }}

		<div class="spacer-large"></div>
		<div class="spacer-large"></div>
		<div class="spacer-small"></div>

		<div class="no-margins size-4 color-1 result-intro">
			<p><strong>{!! $firstname !!},</strong><br/>{!! $title !!}</p>
		</div>

		<div class="spacer-tiny"></div>

		<div class="no-margins font-7 color-1 size-7 result-message"><p>{!! $result !!}</p></div>

		<div class="spacer-large"></div>
		<div class="spacer-large"></div>

		<div class="result-message-form">
			<div class="green-x"><a href="/">X</a></div>
			<button class="share-button button-page bg-color-15 color-2 font-3" label="{{ $button }}">
				{{ $button }}
			</button>
			<div class="email-letitglow form-group page-padding-small bg-color-1">

				<div class="form-text size-3 color-2 font-7">{!! $subtitle !!}</div>
				<div class="form-group">
					{{ Form::email('email', null, Array ('placeholder' => 'YOUR FRIEND\'S EMAIL ADDRESS', 'class' => 'letitglow-full color-1', 'tabindex' => '3')) }}
				</div>

				<div class="spacer-medium"></div>
			</div>
		</div>

		{{-- display form errors --}}
		@if ($errors->has())
			@foreach ($errors->all() as $error)
				<div class='bg-danger alert'>{{ $error }}</div>
			@endforeach
		@endif

		{{ Form::close() }}

	@else

		<div class="spacer-large"></div>
		<div class="spacer-large"></div>
		<div class="spacer-small"></div>


		<div class="result-message-form">
			<div class="green-x"><a href="/">X</a></div>
			<button class="claim-button button-page bg-color-15 color-2 font-3" label="{{ $buttonNo }}">
				<a href="/address">{{ $buttonNo }}</a>
			</button>
			<div class="email-letitglow form-group page-padding-small bg-color-1">

				<div class="form-text size-3 color-2 font-7">YOU WON!</div>
				<div class="prize-text size-6 color-2 font-7"><p>{!! $result !!}</p></div>

				<div class="spacer-medium"></div>
				<div class="spacer-small"></div>

			</div>
		</div>

	@endif

	<div class="spacer-large"></div>
	<div class="spacer-large"></div>
	@include('belif::layouts.footer')

</div>

@stop
{{--------------- END CONTENT ----------------}}
