<?php

	//setup namespace
	use Carbon\Carbon;
	use Soup\Mobile\Models\VenueOpenHours;
	use Soup\Mobile\Models\VenueBlockedHours;


		//==========================================================//
		//====					FORM VALIDATION					====//
		//==========================================================//	
	


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




	function parseDateString($dateString, $formats = null) {
		
		$date = null;
		
		//valid date string
		if ($dateString && strlen($dateString)>0) {
			
			//use default formats (if required)
			if (!$formats) {
				$formats = [
					'm/d/Y',
					'm\\d\\Y',
					'm-d-Y',
					'Y-m-d',
					'Y-d-m',
					'Y-d-m H:m:s'
				];
			}
			
			//formats specified
			if ($formats && count($formats)>0) {
				
				//convert date
				foreach ($formats as $format) {
					
					try {
						
						//convert date
						$date = Carbon::createFromFormat($format, $dateString);
						break;
						
					}
					catch (\Exception $ex) {
						$date = null;
						//echo "Exception - format[" . $format . "] - string[" . $dateString . "]: " . $ex->getMessage() . "<br>";
						continue;
					}
					
				} //end for()
				
				
				//no date found - try direct conversion
				if (!$date) {
					try {
						$date = new Carbon($dateString);	
					}
					catch (\Exception $ex) {
						$date = null;
					}
				}
				
			} //end if (valid formats)
			
		} //end if (valid date string) 

		
		return $date;
		
	} //end parseDateString()
	
	
	


	function availableStates() {
		
		return array (
			'AL',
			'AZ',
			'AR',
			'CA',
			'CO',
			'CT',
			'DE',
			'DC',
			'FL',
			'GA',
			'ID',
			'IL',
			'IN',
			'IA',
			'KS',
			'KY',
			'LA',
			'ME',
			'MD',
			'MA',
			'MI',
			'MN',
			'MS',
			'MO',
			'MT',
			'NE',
			'NV',
			'NH',
			'NJ',
			'NM',
			'NY',
			'NC',
			'OH',
			'OK',
			'OR',
			'PA',
			'RI',
			'SC',
			'SD',
			'TN',
			'TX',
			'UT',
			'VT',
			'VA',
			'WA',
			'WV',
			'WI',
			'WY',
		);
		/*
		return array (
			'Alabama',
			'Alaska',
			'Arizona',
			'Arkansas',
			'California',
			'Colorado',
			'Connecticut',
			'Delaware',
			'District of Columbia',
			'Florida',
			'Georgia',
			'Hawaii',
			'Idaho',
			'Illinois',
			'Indiana',
			'Iowa',
			'Kansas',
			'Kentucky',
			'Louisiana',
			'Maine',
			'Maryland',
			'Massachusetts',
			'Michigan',
			'Minnesota',
			'Mississippi',
			'Missouri',
			'Montana',
			'Nebraska',
			'Nevada',
			'New Hampshire',
			'New Jersey',
			'New Mexico',
			'New York',
			'North Carolina',
			'North Dakota',
			'Ohio',
			'Oklahoma',
			'Oregon',
			'Pennsylvania',
			'Rhode Island',
			'South Carolina',
			'South Dakota',
			'Tennessee',
			'Texas',
			'Utah',
			'Vermont',
			'Virginia',
			'Washington',
			'West Virginia',
			'Wisconsin',
			'Wyoming'
		);
		*/
	} //end availableStates()
	


		//==========================================================//
		//====					SERVER FUNCTIONS				====//
		//==========================================================//	
	


	function retrieveIPAddress()
    {
		
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

	function isMobileDevice()
    {

	    if (env('APP_ENV') == 'local') {
            return true;
        }

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

	    //check if Mobile User Agent is detected
	    foreach($mobileUserAgents as $mobileKey => $mobileOS){
	        if(preg_match($mobileKey, $_SERVER['HTTP_USER_AGENT'])){
	            return true;
	        }
	    }
 
	    //assume desktop  
	    return false;
	    
	} //end isMobileDevice()
	
	
		//==========================================================//
		//====					UTIL FUNCTIONS					====//
		//==========================================================//	
	
	function generateUniqueCode($baseSeed = null, $length = -1, $start = -1)
    {
		
		//create unique string
		$baseString = ($baseSeed?$baseSeed:"") . microtime() . uniqid();
		
		//encrypt code
		$code = hash('sha256', $baseString);	
		
		//limit code
		if ($length>0 && strlen($code)>$length) {
			
			//determine clip start
			if ($start<0) {
				$start = intval((strlen($code) - $length) * 0.5);
				if ($start<0) $start = 0;
			}
			
			//clip string
			$code = substr($code, $start, $length);	
		}

		return $code;

	} //end generateUniqueCode()
	
	
	
		//==========================================================//
		//====					DATA FUNCTIONS					====//
		//==========================================================//	
	
	
		
	//====== GENERIC DATA ======//
	
	
	
	
	function extractModelValues($valueKey, $valuesArray) {
		
		$extracted = null;
		
		//valid key
		if ($valueKey && strlen($valueKey)>0) {
			
			//array exists
			if ($valuesArray) {
				
				//convert array (if required)
				if (is_a($valuesArray, 'Illuminate\Database\Eloquent\Collection')) {
					$valuesArray = $valuesArray->toArray();
				}
				
				//valid array
				if (is_array($valuesArray) && count($valuesArray)>0) {
				
					$extracted = array_map(function($data) use ($valueKey) { 
						
						//valid value
						if (array_key_exists($valueKey, $data)) {
							return $data[$valueKey];	
						} 
						
						//no match found
						return null; 
						
					}, $valuesArray);	
					
				} //end if (valid array)
			
			} //end if (array exists)
			
		} //end if (valid key)
		
		
		return $extracted;
		
	} //end extractModelValues()
	
	
	
	
	
	function compilePropertiesString($source, $properties, $separators = null, $default = null) {
		
		$result = $default;
		
		//valid user
		if ($source && $properties && count($properties)>0) {
	
			//string separator
			$separator = ($separators && !is_array($separators) ? $separators : ' ');
	
			//add values
			$index = 0;
			foreach ($properties as $property) {
	
				//ARRAY SOURCE
				if (is_array($source)) {
					
					//append property
					if (isset($source[$property]) && strlen($source[$property])>0) {
	
						//append property
						if ($result && strlen($result)>0) {
							$result .= $separator . $source[$property];
						}
						
						//set property
						else {
							$result = $source[$property];
						}
	
					}
					
				}
				//OBJECT SOURCE
				else {
	
					//append property
					if (isset($source->$property) && strlen($source->$property)>0) {
	
						//append property
						if ($result && strlen($result)>0) {
							$result .= $separator . $source->$property;
						}
						
						//set property
						else {
							$result = $source->$property;
						}
	
					}
				
				}
				
				//get separator (separator is not used for first entry)
				if ($separators && is_array($separators) && $index<count($separators)) {
					$separator = $separators[$index];	
				}
				
				//increment index
				++$index;
				
			} //end for()
			
			
		} //end if (valid user)
		
		return $result;
		
	} //end compilePropertiesString()
	
?>