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

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");

	$unsubscribed = isset($unsubscribed) ? $unsubscribed : 1;
	$formURL = isset($formURL) ? $formURL : '';
	
?>

<div class="text-center">
	
	<div class="container-top">
		
		<div class="page-padding-small">
	
			<div class="spacer-medium"></div>
			
			@if ($unsubscribed == true)
				<div class="no-margins size-7 color-2 font-3 stroke">You've successfully<br/>been unsubscribed.</div>

				{{-- image --}}
				@if ($image && strlen($image)>0)
					<div>
						<img src="{{ $image }}" class="page-image" load-style="fade" load-group="page">
					</div>
				@endif
			@else
			{{ Form::open(Array('role' => 'form', 'name' => 'emailForm', 'url' => $formURL, 'method' => 'get')) }}

				<div class="no-margins size-7 color-2 font-3 stroke">{!! $title !!}</div>

				{{-- image --}}
				@if ($image && strlen($image)>0)
					<div>
						<img src="{{ $image }}" class="page-image" load-style="fade" load-group="page">
					</div>
				@endif

				<div class="spacer-large"></div>

				{{ Form::email('email', null, Array ('placeholder' => 'your@email.com', 'class' => 'page-input-text large color-1', 'tabindex' => '1')) }}

				<div class="spacer-small"></div>

				<button class="button-page bg-color-14 color-2 font-3" label="Unsubscribe">Unsubscribe</button>

			{{ Form::close() }}
			@endif

		</div>

	</div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
