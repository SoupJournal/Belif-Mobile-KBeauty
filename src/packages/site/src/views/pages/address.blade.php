@extends('belif::layouts.master')

{{------------------ TITLE -------------------}}

@section('title') Belif @stop

{{---------------- END TITLE -----------------}}

{{----------------- SCRIPTS ------------------}}

@section('scripts')

	{{-- HTML::script('packages/artisan/cms/js/cms/form/form.js') --}}	
	
@stop
{{--------------- END SCRIPTS ----------------}}

{{----------------- CONTENT ------------------}}

@section('content')

<?php

	//ensure page properties are set
	$formURL = isset($formURL) ? $formURL : "";
	$buttonURL = isset($buttonURL) ? $buttonURL : "";

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	
?>

@if ($errors->has())
<div class="text-center page-padding-medium">
	
	<div class="spacer-large"></div>

	{{-- title --}}
	<h2 class="title-2 color-4 line-height-30">Oops! Nous avons trouvé une erreur.</h2>

	<div class="spacer-large"></div>
	<div class="spacer-large"></div>

    @foreach ($errors->all() as $error)
        <h4 class="title-4 color-4 italic white-background padding-20">{{ $error }}</h4>
    @endforeach

	<div class="spacer-large"></div>
	<div class="spacer-large"></div>
	<div class="spacer-large"></div>

	<a href="{{ $buttonURL }}" class="button-page bg-color-3 color-2" label="Try Again">
		RÉESSAYER
	</a>
</div>

@else

{{ Form::open(Array('role' => 'form', 'name' => 'addressForm', 'url' => $formURL)) }}

<div class="text-center page-padding-medium">
	
	<div class="spacer-medium"></div>

	{{-- title --}}
	<h2 class="title-2 color-4 line-height-30">{{ $title }}</h2>

	<div class="spacer-tiny"></div>
	<div class="spacer-tiny"></div>

	{{-- name --}}
	<div class="form-group"> 
		{{ Form::text('name', null, Array ('placeholder' => 'Prénom', 'class' => 'page-input-text page-input-center color-4', 'required' => '', 'auto-next-focus' => '')) }}
	</div>

	{{-- address 1 --}}
	<div class="form-group"> 
		{{ Form::text('address_1', null, Array ('placeholder' => 'Adresse Ligne 1', 'class' => 'page-input-text page-input-center color-4', 'required' => '', 'auto-next-focus' => '')) }}
	</div>

	{{-- address 2 --}}
	<div class="form-group"> 
		{{ Form::text('address_2', null, Array ('placeholder' => 'Adresse Ligne 2', 'class' => 'page-input-text page-input-center color-4', 'auto-next-focus' => '')) }}
	</div>

	{{-- city --}}
	<div class="form-group"> 
		{{ Form::text('city', null, Array ('placeholder' => 'Ville', 'class' => 'page-input-text page-input-center color-4', 'required' => '', 'auto-next-focus' => '')) }}
	</div>

	{{--zip code --}}
	<div class="form-group"> 
		{{ Form::input('number', 'zip_code', null, Array ('placeholder' => 'Code Postal', 'class' => 'page-input-text page-input-center color-4', 'required' => '', 'pattern' => '[0-9]*')) }}
	</div>
	
    <div class="spacer-small">
	
	{{-- submit button --}}
	<button class="button-page bg-color-3 color-2" label="{{ $button }}">
		{{ $button }}
	</button>
	
	<div class="spacer-small"></div>

</div>

{{ Form::close() }}

@endif

@stop

{{--------------- END CONTENT ----------------}}