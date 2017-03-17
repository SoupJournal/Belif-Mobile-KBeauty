<?php

	namespace Soup\Mobile\Lib;
	
	use \Auth;


	class AppGlobals {
		
		//auth guard
		public static $AUTH_GUARD = 'soup';
			
		//user status codes
		const USER_STATUS_INQUIRY	 	= 0;
		const USER_STATUS_REGISTERED 	= 1; 
		const USER_STATUS_REQUESTED 	= 2;
		const USER_STATUS_MEMBER 		= 3;
		const USER_STATUS_UNSUBSCRIBED	= 4;
			
		//question types
		const QUESTION_TYPE_BINARY	 	= 0;
		const QUESTION_TYPE_DROP_DOWN 	= 1;
		const QUESTION_TYPE_TEXT	 	= 2;
		const QUESTION_TYPE_MULTIPLE 	= 3;
			
		//Google API key
		const GOOGLE_API_KEY = "AIzaSyB4ge2qO8plaMWCmLWNNi3U4o1RW4B_ucA";
		
			
	} //end class AppGlobals



?>