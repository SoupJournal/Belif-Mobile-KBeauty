<?php


//	use Soup\Mobile\Models\CMSApp;

	//composer groups
	$siteGroup = ['soup::*'];



	//==========================================================//
	//====					 COMPOSERS						====//
	//==========================================================//	



	View::composer($siteGroup, function($view)
	{
		//get route 
		$currentRoute = Route::current();
		


	    
	    //set scripts asset path
	    $view->with('assetPath', URL::asset('soup/mobile/'));

	    //set controllers namespace
	    $view->with('controllerNamespace', 'Soup\\Mobile\\Controllers\\');
	    
	});
	
	


?>