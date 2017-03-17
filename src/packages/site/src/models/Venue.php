<?php

namespace Soup\Mobile\Models;


use Soup\Mobile\Models\UserProfile;

use Illuminate\Database\Eloquent\Model;



class Venue extends Model {

	//set model connection 
	protected $connection = 'Soup';

	//set model table name
    protected $table = 'venue';
    

} //end class Venue


?>