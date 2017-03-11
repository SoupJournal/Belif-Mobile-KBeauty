<?php

	//ensure page variables are set
	$step = isset($step) ? $step : 0;
	$total = isset($total) ? $total : 0;
	
	//determine progress percentage
	$percentage = ($total > 0 ? ($step / $total) * 100 : 0);
	$inversePercentage = 100 - $percentage;
	
?>



{{-- has total image --}}
@if ($total>0 && $step>0) 
	<div class="progress-bar-container padding-tiny">
		<div class="progress-bar-title">
			<div class="progress-bar-label page-text-large title-condensed color-2" style="margin-right: {{ $inversePercentage }}%">
				STEP {{ $step }} of {{ $total }}
			</div>
		</div>
		<div class="progress-bar">
			<span class="progress-bar-full" style="right: {{ $inversePercentage }}%"></span>
			<span class="progress-bar-empty" style="left: {{ $percentage }}%"></span>
		</div>
	</div>
@endif


