<?php

	//ensure page variables are set
	$sectionId = isset($sectionId) ? $sectionId : "";
	$pageData = isset($pageData) ? $pageData : null;

	//get page variables
	$backgroundImage = safeArrayValue('background_image', $pageData, "");

	//get images
	$images = safeArrayValue('children', $pageData, null);
	
?>


<div class="carousel-section">
	<div class="carousel-box stretch-to-fit" carousel="3000">

		<?php
		
			//found images
			if (isset($images)) {
			
				//loop through images
				$backgroundImage = null;
				foreach($images as $image) {
			
					//get image path
					$backgroundImage = safeArrayValue('background_image', $image, null);
					if (isset($backgroundImage) && strlen($backgroundImage)>0) {
						
						?>
						
							<div class="carousel-item">

								<img class="page-carousel-image" src="{{ $backgroundImage }}" load-style="fade">

							</div>
							
						<?php
						
					} //end if (found background)
			
				} //end for()
			
			} //end if (found images)
		
		?>

	</div>
</div>

{{-- background image --}}

{{--	@include('soup::sections.background', ['backgroundImage' => $backgroundImage, 'loadGroup' => '{{ $sectionId }}']) --}}



