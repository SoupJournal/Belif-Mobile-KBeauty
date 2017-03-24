<?php

	//ensure data is set
	$user = isset($user) ? $user : null;
	$link = isset($link) ? $link : "";
	
	//get properties
	$firstName = safeObjectValue('first_name', $user, "");
	$lastName = safeObjectValue('last_name', $user, "");
	$email = safeObjectValue('email', $user, "");
	$instagram = safeObjectValue('instagram', $user, "");
	$snapchat = safeObjectValue('snapchat', $user, "");
	$zipCode = safeObjectValue('zip_code', $user, "");
	$verifyCode = safeObjectValue('verify_code', $user, "");

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
					<td>User {{ $firstName }} has requested membership:</td>
				</tr>
				<tr>
					<td>Name: {{ $firstName }} {{ $lastName }}</td>
				</tr>
				<tr>
					<td>Email: {{ $email }}</td>
				</tr>
				<tr>
					<td>Instagram: {{ $instagram }}</td>
				</tr>
				<tr>
					<td>SnapChat: {{ $snapchat }}</td>
				</tr>
				<tr>
					<td>Verification Code: <b>{{ $verifyCode }}</b></td>
				</tr>
				
			</tbody>
		</table>
	</body>
</html>

