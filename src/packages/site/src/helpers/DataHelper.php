<?php


	function validEmail($email = NULL) {
		
		if ($email!=NULL && strlen($email)>0) {
		
			//trim white space
           	$email = trim($email);
           	
			//get length
			$emailLength = strlen($email);
           	if ($emailLength>4) {
               
                //find range of key characters
                $atIndex = strpos($email, "@");
                $dotIndex =  strrpos($email, ".");
                $atOccurrences = substr_count($email, "@");
               
                //valid format
                if ($atIndex>0 && $dotIndex>($atIndex+1) && $atOccurrences<2 && $dotIndex<$emailLength-1) {
                    return true;
                }
               
               
           	} //end if (valid length)
		
		
		} //end if (email exists)
		
		
		//invalid email
		return false;
		
	} //end validEmail()



	function retrieveIPAddress() {
		
		$ip = NULL;
		
		//retrieve value
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		    $ip = $_SERVER['HTTP_CLIENT_IP'];
		} 
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} 
		else {
		    $ip = $_SERVER['REMOTE_ADDR'];
		}
		
		return $ip;
		
	} //end retrieveIPAdress()



	function isMobileDevice(){
		
		//mobile user agents
	    $mobileUserAgents = array(
	        '/iphone/i' => 'iPhone', 
	        '/ipod/i' => 'iPod', 
	        '/ipad/i' => 'iPad', 
	        '/android/i' => 'Android', 
	        '/windows phone/i' => 'Windows', 
	        '/blackberry/i' => 'BlackBerry', 
	        '/symbianos/i' => 'Symbian', 
	        '/mobile/i' => 'Mobile/Tzien',
	        '/webos/i' => 'Mobile',
	        '/phone/i' => 'Mobile'
	    );
//echo "AGENT: " . $_SERVER['HTTP_USER_AGENT'];
//exit(0);	
	    //check if Mobile User Agent is detected
	    foreach($mobileUserAgents as $mobileKey => $mobileOS){
	        if(preg_match($mobileKey, $_SERVER['HTTP_USER_AGENT'])){
	            return true;
	        }
	    }
 
	    //assume desktop  
	    return false;
	    
	} //end isMobileDevice()
	
	
	
?>