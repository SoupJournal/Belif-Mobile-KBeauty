<?php

	namespace Soup\Mobile\Lib;
	
	use \Auth;


	class AppGlobals {
		
		//auth guard
		public static $AUTH_GUARD = 'soup';
			
		//user status codes
		const $USER_STATUS_INQUIRY	 	= 0; 
		const $USER_STATUS_REQUESTED 	= 1;
		const $USER_STATUS_MEMBER 		= 2;
			
	} //end class AppGlobals



?>