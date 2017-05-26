<?php

	namespace Soup\Mobile\Lib;
	
	use \Auth;


	class AppGlobals {
		
		//auth guard
		public static $AUTH_GUARD = 'soup';
			
		//header styles
		const HEADER_STYLE_NORMAL 	= 0;
		const HEADER_STYLE_WHITE	= 1;
		const HEADER_STYLE_BLACK 	= 2;
			
			
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
			
		//reservation status
		const RESERVATION_STATUS_DRAFT 		= 0;
		const RESERVATION_STATUS_REQUESTED 	= 1;
		const RESERVATION_STATUS_CONFIRMED 	= 2;
		const RESERVATION_STATUS_CANCELLED 	= 3;
		
		//password reset request status
		const RESET_PASSWORD_STATUS_ISSUED 		= 0;
		const RESET_PASSWORD_STATUS_CONSUMED 	= 1;
		
		//review status
		const REVIEW_STATUS_REQUIRED 	= 0;
		const REVIEW_STATUS_IGNORED 	= 1;
		const REVIEW_STATUS_COMPLETE 	= 2;
		
		//recommendation type
		const RECOMMENDATION_TYPE_DINNER = 'Dinner';
		const RECOMMENDATION_TYPE_LUNCH = 'Lunch';
		const RECOMMENDATION_TYPE_BRUNCH = 'Brunch';
		const RECOMMENDATION_TYPE_BREAKFAST = 'Breakfast';
		
			
		//Google API key
		const GOOGLE_API_KEY = "AIzaSyBDh1B9VMqSCyO2zXUkX37U_iiStdtbzW0"; //"AIzaSyB4ge2qO8plaMWCmLWNNi3U4o1RW4B_ucA";
		
			
		//EMAIL DETAILS
				
		//forgot password
		const EMAIL_PASSWORD_RESET_SENDER = "test@belifinhydration.com"; //"team@soupjournal.com";
		const EMAIL_PASSWORD_RESET_SUBJECT = "Soup - Password Reset Request";
		
		//request membership (SYSTEM EMAIL)
		const EMAIL_MEMBER_REQUEST_RECIPIENT = "adam.kinnane@soupjournal.com"; 
		//const EMAIL_MEMBER_REQUEST_RECIPIENT = "aberrationmedia@gmail.com"; //TEST EMAIL (REMOVE)
		const EMAIL_MEMBER_REQUEST_SENDER = "test@belifinhydration.com"; //"team@soupjournal.com";
		const EMAIL_MEMBER_REQUEST_SUBJECT = "Soup - Membership request";
		
		//request reservation
		const EMAIL_RESERVATION_REQUEST_SENDER = ['name' => 'Soup', 'email' => "team@soupjournal.com"]; //"test@belifinhydration.com";
		//const EMAIL_RESERVATION_REQUEST_SUBJECT = "Soup - Password Reset Request";
		
		//reservation notification (SYSTEM EMAIL)
		const EMAIL_RESERVATION_NOTIFICATION_RECIPIENT = "adam.kinnane@soupjournal.com"; 
		//const EMAIL_RESERVATION_NOTIFICATION_RECIPIENT = "aberrationmedia@gmail.com"; //TEST EMAIL (REMOVE)
		const EMAIL_RESERVATION_NOTIFICATION_SENDER = ['name' => 'Soup', 'email' => "team@soupjournal.com"]; //"test@belifinhydration.com";
		const EMAIL_RESERVATION_NOTIFICATION_SUBJECT = "Soup - Reservation request";
			
	} //end class AppGlobals



?>