<?php

namespace Soup\Mobile\Models;


use Soup\Mobile\Models\UserProfile;

use Illuminate\Database\Eloquent\Model;



class Page extends Model {

	//set model connection 
	protected $connection = 'Soup';

	//set model table name
    protected $table = 'page';



		//==========================================================//
		//====				RELATIONSHIP METHODS				====//
		//==========================================================//	
			

	/**
     * Get the any child pages associated with this page.
     */
	public function children() {
    
        return $this->hasMany(Page::class, 'parent', 'id')->with('children')->orderBy('order');
        
    } //end children()
    



} //end class Page


?>