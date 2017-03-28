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
								<h1 class="title-bold color-2">{{ $title }}</h1>
							@endif
							
							
							<div class="spacer-medium"></div>	


							@if (isset($subtitle))						
								<h2 class="title-regular bold color-2">{{ $subtitle }}</h2>
								<div class="spacer-large"></div>
							@else
								<div class="spacer-large"></div>
							@endif
							
						</div>
						
						
						
						<div class="page-section page-padding-small-2">
							
							
							@if (isset($text))
								<h4 class="form-group title-light color-2">{!! $text !!}</h4>
							@endif
								
								
							<div class="spacer-medium"></div>
							<div class="spacer-medium"></div>
						
						</div>
						
						<div class="page-section">		
								
							{{-- next button --}}
							<div class="form-group"> 
								<a href="{{ $nextURL }}" class="button-page-border border-thin bg-color-clear border-color-2 color-2">
									<h4 class="clear-header-margins title-bold">{{ $button }}</h4>
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
