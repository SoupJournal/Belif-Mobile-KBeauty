<?php

namespace Soup\Mobile\Models;


use Soup\Mobile\Models\UserProfile;

use Illuminate\Database\Eloquent\Model;



class UserProfile extends Model {

	//set model connection 
	protected $connection = 'Soup';

	//set model table name
    protected $table = 'user_profile';



} //end class UserProfile


?>