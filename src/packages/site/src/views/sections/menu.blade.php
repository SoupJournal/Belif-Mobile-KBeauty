<?php

	//ensure page variables are set
	$options = isset($options) ? $options : null;
	
?>

<div class="page-container bg-color-1">

	<div class="text-center page-padding-medium">
				
		<?php
		
			//has steps
			if ($options && count($options)>0) {
		
				//draw steps
				foreach ($options as $name => $url) {
					
		?>
		
					<div class="">
						
						<div class="spacer-tiny"></div>
						
						{{-- draw text --}}
						<a href="{{ $url }}">
							<h3 class="page-padding-medium color-2">{!! $name !!}</h3>
						</a>
	
						<div class="spacer-small"></div>
					
					</div>
		
		<?php
		
				} //end for
			
			} //end if (has steps)
		?>
			

	</div>

</div>

