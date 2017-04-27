<?php

	//ensure page variables are set
	$APIKey = isset($APIKey) ? $APIKey : 0;
	$width = isset($width) ? $width : 0;
	$height = isset($height) ? $height : 0;
	$zoom = isset($zoom) ? $zoom : 15;
	$markers = isset($markers) ? $markers : null;
	
	/*
	//encode position
	$JSONposition = "";
	if (isset($position) && is_array($position)) {
		try {
			$JSONposition = json_encode($position);
		}
		catch (Exception $ex) {
			$JSONposition = "";	
		}
	}
	
	//encode markers
	$JSONmarkers = "";
	if (isset($markers) && is_array($markers)) {
		try {
			$JSONmarkers = json_encode($markers);
		}
		catch (Exception $ex) {
			$JSONmarkers = "";	
		}
	}*/
	$JSONposition = convertObjectToJS($position, true);
	$JSONmarkers = convertObjectToJS($markers, true);

?>


@if (isset($APIKey))
	<div class="google-map-container" google-map="{{ $APIKey }}" map-width="{{ $width }}" map-height="{{ $height }}" map-zoom="{{ $zoom }}" map-position="{{ $JSONposition }}" map-markers="{{ $JSONmarkers }}">
	</div>
@endif

