
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
		<img class="logo-title-image" alt="belif" src="{{ $headerLogoUrl }}" load-style1="fade"/>
	</div>
   	
   	{{-- next button --}}
   	<div class="page-header-side">
		@if (isset($nextURL) && strlen($nextURL)>0)
			<h4 class="title-light button-back"><a href="{{ $nextURL }}" class="color-2 button-next">SKIP</a></h4>
		@endif
		@yield('header-right', '')
   	</div>

</div>