<?php



	//composer groups
	$siteGroup = ['belif::*'];



	//==========================================================//
	//====					 COMPOSERS						====//
	//==========================================================//	

	View::composer($siteGroup, function($view)
	{
		//get route 
		$currentRoute = Route::current();
	    
	    //set scripts asset path
	    $view->with('assetPath', URL::asset('belif/mobile/'));

	    //set controllers namespace
	    $view->with('controllerNamespace', 'Belif\\Mobile\\Controllers\\');
	    
	});
	
	


?>