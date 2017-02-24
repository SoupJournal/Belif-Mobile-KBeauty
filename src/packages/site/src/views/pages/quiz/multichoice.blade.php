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
	$question = safeArrayValue('question', $pageData, "");
	$answers = safeArrayValue('answers', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	
?>


{{-- background image --}}
<img class="page-image" src="{{ $backgroundImage }}" load-style="fade">


<div class="text-center">


	{{ Form::open(Array('role' => 'form', 'name' => 'questionForm', 'class' => 'stretch-to-fit', 'id' => 'question-container')) }}

		<div class="page-padding-large">

			{{-- question --}}
			<h2 class="bold">{{ $question }}</h2>
	
			
			<?php
			
				//show answers
				foreach ($answers as $answer) {
			?>
			
				<div class="button-checkbox">
				   	<label class="color-2">
				   		{{ Form::checkbox($answer, $answer, false, Array ('class' => 'multiple-choice', 'checkbox-limit' => '3', 'checkbox-group' => 'choices')) }}
				   		<span>{{ $answer }}</span>
	<!--			    	<input type="checkbox" value="1"> -->
					</label>
				</div>
			
			
			<?php
			
				} //end for()
				
			?>
		
		</div>

	{{ Form::close() }}

</div>

@stop
{{--------------- END CONTENT ----------------}}
