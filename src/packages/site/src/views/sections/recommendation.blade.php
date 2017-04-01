<?php

	//ensure page variables are set
	$type = isset($type) ? $type : "";
	$venue = isset($venue) ? $venue : "";
	
	//get venue properties
	$name = safeArrayValue('name', $venue, "");
	$image = safeArrayValue('image_profile', $venue, "");
	
	//compile properties
	$link = (isset($type) && strlen($type)>0) ? route('soup.venue.profile', ['type'=>$type]) : "#";
	$address = compilePropertiesString($venue, ['address', 'suburb'], [', ']);
	$openHours = venueTodaysOpenHoursString($venue, "CLOSED TODAY");
	
?>



<div class="venue-preview-container">
	<a href="{{ $link  }}" class="no-underline-highlight">
		<div class="venue-preview">
		
			{{-- background image --}}
			<div class="stretch-to-fit hide-overflow-y">
				@include('soup::sections.background', ['backgroundImage' => $image, 'loadGroup' => '{{ $type }}'])
				<div class="stretch-to-fit gradient-overlay"></div>
			</div>
			
			<div class="page-overlay bg-color-clear" load-style="fade" load-group="{{ $type }}">
			
				<div class="spacer-tiny"></div>
				<h1 class="clear-header-margins title-bold uppercase color-2">{{ $type }}</h1>
			
			</div>
		</div>
		<div class="bg-color-10 page-padding-tiny">
			
			<div class="spacer-small"></div>
			
			{{-- name --}}
			<div class="page-padding-medium">
				<h2 class="clear-header-margins uppercase color-1">{{ $name }}</h2>
			</div>


			<div class="padding-small">
				<h4 class="clear-header-margins shrink-to-fit title-regular capitalize color-1">
					{{ $address }}
				</h4>
				<h4 class="clear-header-margins shrink-to-fit title-regular lowercase color-1">
					{{ $openHours }}
				</h4>
			</div>

			<div class="spacer-small"></div>
			
			
			
			{{-- corner icon --}}
			<div class="corner-icon-box">
				<div class="stretch-to-fit">
					<div class="corner-triangle-br border-color-1"></div>
				</div>
				<h1 class="clear-header-margins corner-icon-label title-bold small color-10">+</h1>
			</div>
			
		</div>
	</a>
</div>
