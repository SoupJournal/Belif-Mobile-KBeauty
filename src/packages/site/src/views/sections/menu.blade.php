<?php

	//ensure page variables are set
	$options = isset($options) ? $options : null;

?>

<div class="page-container fill-height">


		
	<div class="table-parent fill-height text-center page-padding-small">

		<div class="table-center-row">
		
			<div class="table-center-cell">	
				
				{{-- has steps --}}
				@if ($options && count($options)>0) 
			
					{{-- draw options --}}
					@foreach ($options as $option) 
		
						@if ($option) 
						
							@if (safeArrayValue('type', $option, "")=="spacer")
							
								<div class="spacer-medium"></div>
							
							@else
						
								<div class="">
									
									<div class="spacer-tiny"></div>
									
									{{-- draw text --}}
									<a href="{{ safeArrayValue('url', $option, '') }}">
										<h2 class="color-2 {{ safeArrayValue('class', $option, '') }}">
											{{ safeArrayValue('name', $option, "") }}
										</h2>
									</a>
				
									<div class="spacer-tiny"></div>
								
								</div>
								
							@endif
							
						@endif
			
		
					@endforeach
				
				@endif
		
				<div class="spacer-medium"></div>
		
			</div>
			
		</div>
	
	</div>
		



</div>

