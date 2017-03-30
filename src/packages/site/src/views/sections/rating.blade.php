<?php

	//ensure page variables are set
	$loadGroup = isset($loadGroup) ? $loadGroup : "";
	$paddingStyle = isset($paddingHeight) ? ("padding-bottom: " . $paddingHeight) : "";
	

	//rating properties
	$numberOfStars = 5;	
	$starImageOff = "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/icon_star_blank.png";
	$starImageOn = "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/icon_star_full.png";

?>


<div class="rating-container" star-rating star-rating-on="{{ $starImageOn }}" star-rating-off="{{ $starImageOff }}">

	@for ($i=0; $i<$numberOfStars; ++$i) 
	
		<button name="rating" class="rating-button" type="button" value="{{ $i }}">
			<img src="{{ $starImageOff }}" class="rating-star" load-style="fade" load-group="star">
		</button>
	
	@endfor


	{{-- question key --}}
	<input type="hidden" name="rating" value="0" id="test">
	
</div>
