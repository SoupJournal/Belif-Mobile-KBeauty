<?php

	//validate properties
	if (!isset($pageData)) $pageData = null;
	if (!isset($name)) $name = "";
	if (!isset($address1)) $address1 = "";
	if (!isset($address2)) $address2 = "";
	if (!isset($address3)) $address3 = "";
	if (!isset($verifyLink)) $verifyLink = "";
	if (!isset($unsubscribeLink)) $unsubscribeLink = "";
	
	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$html = safeArrayValue('html', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$buttonCancel = safeArrayValue('button_cancel', $pageData, "");
	$productImage = safeArrayValue('image', $pageData, "");
	$fontDefinitions = "'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif";

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Belif</title>
</head>
<body style="border:0; margin:0; padding:0;">
<table width="100%" border="0" cellspacing="0" cellpadding="0"  style="border:0; margin:0; padding:0;">
	<tbody>
		<tr>
			<td align="center" valign="top"  style="border: 0; margin: 0; padding: 0; ">
				<table width="570" border="0" cellspacing="0" cellpadding="0" align="center"  style="border:0; margin:0; padding:0;">
					<tbody>
						<tr>
							<td style="border: 0; margin: 0; padding: 0;">
								<table width="570" height="249" border="0" cellspacing="0" cellpadding="0" style="border:0; margin:0; padding:0;background: url(https://soup-journal-app-storage.s3.amazonaws.com/letitglow/verify_top.jpg) no-repeat center center;">
									<tr>
										<td>content here</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="border: 0; margin: 0; padding: 0;">
								<table width="570" height="947" border="0" cellspacing="0" cellpadding="0" style="border:0; margin:0; padding:0;background: url(https://soup-journal-app-storage.s3.amazonaws.com/letitglow/verify_middle.jpg) no-repeat center center;">
									<tbody>
										<tr>
											<td style="border: 0; margin: 0; padding: 0;" align="left" valign="top">
												<table width="100%" border="0" cellpadding="0" cellspacing="0">
													<tr>
														<td style="border: 0; margin: 0; padding: 0;" height="30"></td>
													</tr>
													<tr>
														<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:{{ $fontDefinitions }}; color:#1d5c58; font-size:24px; line-height:30px; font-weight:bold; word-spacing:-0.2px;">{!! $title !!}</td>
													</tr>
													<tr>
														<td height="30" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;"></td>
													</tr>
													<tr>
														<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:{{ $fontDefinitions }}; color:#1d5c58; font-size:14px; line-height:20px;">{!! $subtitle !!}</td>
													</tr>
													<tr>
														<td height="18" align="center" valign="top" style="border: 0; margin:0; padding: 0;"></td>
													</tr>
													<tr>
														<td align="center" valign="top" style="border: 0; margin:0; padding: 0;">
															<table border="0" cellspacing="0" cellpadding="0" width="570px">
																<tbody>
																<tr>
																	<td>
																		<table border="0" cellspacing="0" cellpadding="0">
																			<tbody>
																			<tr><td style="border:0; margin:0; padding:16px 70px;"></tr>
																			<tr><td style="border:0; margin:0; padding:16px 70px;"></tr>
																			</tbody>
																		</table>
																	</td>
																	<td style="border:0; margin:0; padding:21px 5px; width:80%; text-align:center; font-family:{{ $fontDefinitions }}; color:#ffffff; background-color: #ff76a7; font-size:21px; line-height:21px; font-weight:bold; white-space: nowrap;">
																		<a href="{{ $verifyLink }}" target="_blank" style="text-decoration: none; color:#ffffff;">Confirm email</a>
																	</td>
																	<td>
																		<table border="0" cellspacing="0" cellpadding="0">
																			<tbody>
																			<tr><td style="border:0; margin:0; padding:16px 70px;"></tr>
																			<tr><td style="border:0; margin:0; padding:16px 70px;"></tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
																</tbody>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family: {{ $fontDefinitions }}; color:#ffffff; font-size:12px; ">{!! $html !!}</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						{{-- Social Links Below --}}
						<tr>
							<td align="center" valign="top" style=" border: 0; margin: 0; padding: 0;">
								<table width="570" height="407" border="0" cellspacing="0" cellpadding="0" style="background: url(https://soup-journal-app-storage.s3.amazonaws.com/letitglow/verify_bottom.jpg) no-repeat center center;">
									<tbody>
										<tr>
											<td height="19" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; ">&nbsp;</td>
										</tr>
										<tr>
											<td width="570" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;  color: #fff; text-align: center; font-family:{{ $fontDefinitions }}; text-align: center;">
												<a href="https://www.instagram.com/belifusa/" target="_blank"><img src="https://soup-journal-app-storage.s3.amazonaws.com/aqualand/instagram-logo-transparent.png" width="27" height="27" alt="Belif Instagram" style="border: 0; margin: 0; padding: 0;"/></a>
												&nbsp; &nbsp; &nbsp;
												<a href="https://www.facebook.com/belifUSA/" target="_blank"><img src="https://soup-journal-app-storage.s3.amazonaws.com/aqualand/facebook-logo-transparent.png" width="27" height="27" alt="Belif Facebook" style="border: 0; margin: 0; padding: 0;"/></a>
												&nbsp; &nbsp; &nbsp;
												<a href="https://twitter.com/belifusa" target="_blank"><img src="https://soup-journal-app-storage.s3.amazonaws.com/aqualand/twitter-logo-transparent.png" width="27" height="27" alt="Belif Twitter" style="border: 0; margin: 0; padding: 0;"/></a>
											</td>
										</tr>
										<tr>
											<td height="14" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;  line-height: 0;">&nbsp;</td>
										</tr>
										<tr>
											<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0;  color: #fff; font-family:{{ $fontDefinitions }}; font-size:14px; line-height: 20px; font-style:italic; text-align: center;">&copy; 2017 LG Household & Health Care, LTD. All Rights Reserved.</td>
										</tr>
										<tr>
											<td height="9" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; ">&nbsp;</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>
</body>
</html>
