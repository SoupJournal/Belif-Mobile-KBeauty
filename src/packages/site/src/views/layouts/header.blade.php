
{{-- header --}}
<div class="page-header navbar navbar-top bg-color-1 color-2">


	{{-- back button --}}
	<div class="page-header-side">
		@if (isset($backURL) && strlen($backURL)>0)
			<h4 class="title-light button-back"><a href="{{ $backURL }}" class="color-2">BACK</a></h4>
		@endif
	</div>



	{{-- title --}}
	<div class="page-header-center text-center">
		{{-- <h1 class="font-header">belif</h1> --}}
		{{-- <h5 class="font-header">believe in truth</h5> --}}
		<img class="logo-title-image" alt="belif" src="{{ $assetPath }}/images/logo-title.png" load-style1="fade"/>
	</div>
   	
   	
   	{{-- next button --}}
   	<div class="page-header-side">
		@if (isset($nextURL) && strlen($nextURL)>0)
			<a href="{{ $nextURL }}" class="color-2 button-next">BACK</a>
		@endif
   	</div>

</div>

    	