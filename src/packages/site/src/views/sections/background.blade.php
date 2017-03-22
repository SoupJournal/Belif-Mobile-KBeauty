<?php

	//ensure page variables are set
	$loadGroup = isset($loadGroup) ? $loadGroup : "";
	$paddingStyle = isset($paddingHeight) ? ("padding-bottom: " . $paddingHeight) : "";
	
	//create fill style
	$fillStyle = 'style="' . $paddingStyle . '"';
	
?>



{{-- background image --}}
@if (isset($backgroundImage) && strlen($backgroundImage)>0)
	<img class="page-image" src="{{ $backgroundImage }}" load-style="fade" load-group="{{ $loadGroup }}">
@else
	<div class="background-fill" {!! $fillStyle !!}></div>
@endif


