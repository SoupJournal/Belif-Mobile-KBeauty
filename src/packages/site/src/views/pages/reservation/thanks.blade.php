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

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	

?>

{{-- background image --}}
@include('soup::sections.background', ['backgroundImage' => $backgroundImage, 'loadGroup' => 'main'])

<div class="page-overlay bg-color-clear" load-style="fade" load-group="main">

	<div class="framed-box border-color-2 stretch-to-fit">
	
			<div class="table-parent fill-height">
			
				<div class="table-center-row">

					<div class="table-center-cell">
				
	
						<div class="page-section page-padding-large">		
						
							<div class="spacer-small"></div>
							
							@if (isset($title))
								<h1 class="title-bold small color-2">{{ $title }}</h1>
							@endif
							


							@if (isset($subtitle))	
								<div class="spacer-small"></div>						
								<h3 class="title-regular color-2">{{ $subtitle }}</h3>
								<div class="spacer-medium"></div>
							@else
								<div class="spacer-large"></div>
							@endif
							
						</div>
						
						
						
						<div class="page-section page-padding-small">
							
							
							@if (isset($text))
								<div class="form-group color-2">{!! $text !!}</div>
							@endif
								
								
							<div class="spacer-medium"></div>
							<div class="spacer-medium"></div>
						
						</div>
						
						<div class="page-section">		
								
							{{-- next button --}}
							<div class="form-group"> 
								<a href="{{ $nextURL }}" class="button-page-border title-bold bg-color-clear border-color-2 color-2">
									{{ $button }}
								</a>
							</div>
						
							<div class="spacer-large"></div>
						
						</div>
						
		
				</div>
			</div>
		</div>
	
	</div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
