<?php

namespace Soup\Mobile\Models;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class SoupUser extends Eloquent implements AuthenticatableContract {

	//set model connection 
	protected $connection = 'Soup';

	//set model table name
    protected $table = 'user';




	
		//==========================================================//
		//====				AUTHENTICATION METHODS				====//
		//==========================================================//	
			


    /**
	 * Get the unique identifier name for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifierName()
	{
	    return $this->getKeyName(); //return column name 'id'
	}


    /**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
    public function getAuthIdentifier()
    {
        return $this->getKey(); //return user id
    }


    /**
	 * Get the password for the user.
	 *
	 * @return string
	 */
    public function getAuthPassword()
    {
        return $this->password;
    }




    /**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
//    public function getReminderEmail()
//    {
//        return $this->email;
//    }
        

    public function getRememberToken()
    {
        return $this->remember_token;
    }


    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
    

} //end class SoupUser


?>