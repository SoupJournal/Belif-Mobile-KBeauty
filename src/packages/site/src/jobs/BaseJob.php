<?php


	namespace Soup\Mobile\Jobs;
	
	
	use Illuminate\Bus\Queueable;
	
	
	abstract class BaseJob {
	
	    /*
	    |--------------------------------------------------------------------------
	    | Queueable Jobs
	    |--------------------------------------------------------------------------
	    |
	    | This job base class provides a central location to place any logic that
	    | is shared across all of your jobs. The trait included with the class
	    | provides access to the "onQueue" and "delay" queue helper methods.
	    |
	    */
	    use Queueable;
	    
	} //end class BaseJob


?>