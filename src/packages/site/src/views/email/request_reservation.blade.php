<?php

	//ensure data is set
	$reservation = isset($reservation) ? $reservation : null;
	$user = isset($user) ? $user : null;
	$venue = isset($venue) ? $venue : null;
	
	//get reservation properties
	$guests = safeObjectValue('guests', $reservation, "");
	$date = safeObjectValue('date', $reservation, "");
	$reservationTime = $date ? $date->format('g:i A') : "";
	$reservationDay = $date ? $date->format('l, F jS') : "";
	
	//get user properties
	$firstName = safeObjectValue('first_name', $user, "");
	//$lastName = safeObjectValue('last_name', $user, "");

	//get venue properties
	$venueName = safeObjectValue('name', $venue, "");
	

?>
<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.0 Transitional//EN” “http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd”>
<html>
	<body>
		Hi {{ $firstName }},
		<br>
		<br>
		Your reservation at {{ $venueName }} has been requested. 
		<br>We have made a request for {{ $guests }} people on {{ $reservationDay }} at {{ $reservationTime }}.  
		<br><br>
		We are doing our very best to secure this date and time for you and will confirm within 24 hours. 	
		<br>
		<br>Thanks for being awesome.  
		<br>
		<br>Adam & the Soup team.
		<br>
		<br><a href="https://soupjournal.com">Members</a> | <a href="https://www.instagram.com/soupjournal/">Instagram</a> | <a href="tel:512-988-2177">Call</a>
		<br><a href="http://soupjournal.com"><img src="https://i.imgsafe.org/0077362d03.png" alt="Soup"></a>
		<br> 
		<br>
		<br>
		<br>
		<br>
		<br> 
		
		<center>
	        <br>
	        <br>
	        <br>
	        <br>
	        <br>
	        <br>
	        <table border="0" cellpadding="0" cellspacing="0" width="100%" id="canspamBarWrapper" style="background-color:#FFFFFF; border-top:1px solid #FFFFFF;">
	            <tr>
	                <td align="center" valign="top" style="padding-top:20px; padding-bottom:20px;">
	                    <table border="0" cellpadding="0" cellspacing="0" id="canspamBar">
                        </table>
                    </td>
                </tr>
            </table>
			                        
			                    
             
            <style type="text/css">
                @media only screen and (max-width: 480px){
                    table[id="canspamBar"] td{font-size:14px !important;}
                    table[id="canspamBar"] td a{display:block !important; margin-top:10px !important;}
                }
            </style>
		</center>            
		<center>
	        <br>
	        <br>
	        <br>
	        <br>
	        <br>
	        <br>
	        <table border="0" cellpadding="0" cellspacing="0" width="100%" id="canspamBarWrapper" style="background-color:#FFFFFF; border-top:1px solid #E5E5E5;">
	            <tr>
	                <td align="center" valign="top" style="padding-top:20px; padding-bottom:20px;">
	                    <table border="0" cellpadding="0" cellspacing="0" id="canspamBar">
	                        <tr>
	                            <td align="center" valign="top" style="color:#FFFFFF; font-family:Helvetica, Arial, sans-serif; font-size:11px; line-height:150%; padding-right:20px; padding-bottom:5px; padding-left:20px; text-align:center;">
	                                This email was sent to <a href="mailto:*|EMAIL|*" target="_blank" style="color:#FFFFFF !important;">*|EMAIL|*</a>
	                                <br>
	                            <a href="*|UNSUB|*" style="color:#404040 !important;">unsubscribe</a>
	                                <br>
	                                *|LIST:ADDRESSLINE|*
	                                <br>
	                                <br>
	                                
	                            </td>
	                        </tr>
	                    </table>
	                </td>
	            </tr>
	        </table>
	        <style type="text/css">
	            @media only screen and (max-width: 480px){
	                table[id="canspamBar"] td{font-size:14px !important;}
	                table[id="canspamBar"] td a{display:block !important; margin-top:10px !important;}
	            }
	        </style>
	    </center>
		            
	</body>            
</html>