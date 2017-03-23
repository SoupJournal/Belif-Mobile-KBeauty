<?php

	//ensure page variables are set
	$type = isset($type) ? $type : "";
	$name = isset($name) ? $name : "";
	$address = isset($address) ? $address : "";
	$openHours = isset($openHours) ? $openHours : "";
	$link = isset($link) ? $link : "";
	$image = isset($image) ? $image : "";
	
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
				<h1 class="clear-header-margins title-bold color-2">{{ $type }}</h1>
			
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
