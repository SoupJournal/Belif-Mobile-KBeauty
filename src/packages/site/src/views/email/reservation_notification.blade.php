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
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Membership Request</title>
	</head>
	<body style="border:0; margin:0; padding:0; background-color:#f5f5f5">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:0; margin:0; padding:0; background-color:#f5f5f5">
			<tbody>
			
				<tr>
					<td>User {{ $firstName }} has requested a reservation:</td>
				</tr>
				<tr>
					<td>Name: {{ $firstName }} {{ $lastName }}</td>
				</tr>
				<tr>
					<td>Email: {{ $email }}</td>
				</tr>
				<tr>
					<td>Venue: {{ $venueName }}</td>
				</tr>
				<tr>
					<td>Reservation Guests: {{ $guests }}</td>
				</tr>
				<tr>
					<td>Reservation Time: {{ $reservationTime }}</td>
				</tr>
				<tr>
					<td>Reservation Date: {{ $reservationDay }}</td>
				</tr>
				
			</tbody>
		</table>
	</body>
</html>

