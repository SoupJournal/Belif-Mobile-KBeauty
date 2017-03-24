<?php

	//ensure data is set
	$user = isset($user) ? $user : null;
	$link = isset($link) ? $link : "";
	
	//get properties
	$name = safeObjectValue('first_name', $user, "");

?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Password Reset</title>
	</head>
	<body style="border:0; margin:0; padding:0; background-color:#f5f5f5">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:0; margin:0; padding:0; background-color:#f5f5f5">
			<tbody>
			
				<tr>
					<td>Hi {{ $name }},</td>
				</tr>
				<tr>
					<td>
						A request has been made to reset your password. To update your password please follow <a href="{{ $link }}">this link</a>.
					</td>
				</tr>
				<tr>
					<td>If this email was sent in error or you do not wish to reset your password please disregard this message.</td>
				</tr>
				
			</tbody>
		</table>
	</body>
</html>

