<?php

	//validate properties
	if (!isset($pageData)) $pageData = null;
	if (!isset($unsubscribeLink)) $unsubscribeLink = "";

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$image = safeArrayValue('image', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	$fontDefinitions = "'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif";

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>VDL</title>
</head>
<body style="border:0; margin:0; padding:0; background-color:#ffffff">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:0; margin:0; padding:0; background-color:#f5f5f5" >
	<tbody>
		<tr>
			<td align="center" valign="top" style="border: 0; margin: 0; padding: 0; background-color: #ffffff;">
				<table width="570" border="0" cellspacing="0" cellpadding="0" align="center" >
					<tbody>
						<tr>
							<td style="border: 0; margin: 0; padding: 0; background-position:bottom center; background-size: contain; background-repeat: no-repeat;" background="{{ $backgroundImage }}" bgcolor="#ffffff" valign="top">
								<div>
									<table width="570" border="0" cellspacing="0" cellpadding="0" >
										<tbody>
											<tr>
												<td style="border: 0; margin: 0; padding: 0;" align="left" valign="top">
													<table width="100%" border="0" cellpadding="0" cellspacing="0">
														<tbody>
															<tr>
																<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" width="19" height="22"></td>
																<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" width="102"></td>
																<td align="center" valign="bottom" style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;"></td>
																<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" width="102"></td>
																<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" width="19"></td>
																</tr>
															<tr>
																<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" height="107"></td>
																<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" valign="middle" align="left"><img src="https://soup-journal-app-storage.s3.amazonaws.com/aloeaquabomb/belif_stamp.png" width="100" alt=""/></td>
																<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" align="center" valign="middle"><img src="https://soup-journal-app-storage.s3.amazonaws.com/belif/Surfsup/BELIF_LOGO_WHITE.png" width="150" alt="Belif"/></td>
																<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" valign="middle" align="left"><img src="https://soup-journal-app-storage.s3.amazonaws.com/aloeaquabomb/belif_sts_top.png" width="100" alt=""/></td>
																<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;"></td>
																</tr>
															<tr>
																<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;"></td>
																<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;"></td>
																<td align="center" valign="bottom" style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;"></td>
																<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;"></td>
																<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;"></td>
																</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<tr>
												<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" height="40"></td>
											</tr>
											<tr>
												<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0;"><table border="0" cellspacing="0" cellpadding="0">
													<tbody>
														<tr>
															<td width="30" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;"></td>
															<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:{{ $fontDefinitions }}; color:#ffffff; font-size:24px; line-height:30px; font-weight:bold;">{{ $title }}</td>
															<td width="30" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;"></td>
														</tr>
													</tbody>
												</table></td>
											</tr>
											<tr>
												<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" height="10"></td>
											</tr>
											<tr>
												<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0;">
												<table border="0" cellspacing="0" cellpadding="0">
													<tbody>
														<tr>
															<td width="30" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;"></td>
															<td align="center" valign="middle"  style="border: 0; margin: 0; padding: 0; font-family:{{ $fontDefinitions }}; color:#336666; font-size:14px; font-weight:bold;">{{ $subtitle }}</td>
															<td width="30" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;"></td>
														</tr>
													</tbody>
												</table>
												</td>
											</tr>
											<tr>
												<td height="440" style="border: 0; margin:0; padding: 0;"><img src="{{ $image }}" border="0" /></td>
											</tr>
											<tr>
												<td align="center" valign="top" style="border: 0; margin:0; padding: 0;">
												<table width="350px" border="0" cellspacing="0" cellpadding="0">
													<tbody>
														<tr>
															<td style="border:0; margin:0; padding: 7px 15px; text-align:center; font-family:{{ $fontDefinitions }}; color:#ffffff; font-size:14px;">{{ $text }}</td>
														</tr>
													</tbody>
												</table></td>
											</tr>
											<tr>
												<td height="2" align="center" valign="top" style="border: 0; margin:0; padding: 0; font-size:0; line-height:0;"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/space.gif" width="1" height="1" alt=""/></td>
											</tr>

											<tr>
												<td height="31" align="center" valign="top" style="border: 0; margin:0; padding: 0; font-size:0; line-height:0;"></td>
											</tr>
											<tr>
												<td align="center" valign="top" style="border: 0; margin:0; padding: 0;"><table border="0" cellspacing="0" cellpadding="0">
													<tbody>
														<tr>
															<td bgcolor="#336666" style="border:0; margin:0; padding:21px 39px; text-align:center; font-family:{{ $fontDefinitions }}; color:#ffffff; font-size:21px; line-height:21px; letter-spacing:-0.2px; text-transform: uppercase; font-weight:bold;"><a href="http://www.aloeaquabomb.com" target="_blank" style="text-decoration: none; color:#ffffff;">ENTER TO WIN</a></td>
														</tr>
													</tbody>
												</table></td>
											</tr>
											<tr>
												<td height="27" align="center" valign="top" style="border: 0; margin:0; padding: 0;"></td>
											</tr>
										</tbody>
									</table>
								</div>
							</td>
						</tr>
						<tr>
							<td style="border: 0; margin: 0; padding: 0; font-size: 0; line-height:0;" height="19"></td>
						</tr>

						{{-- Social Links Below --}}
						<tr>
							<td align="center" valign="top" bgcolor="#000000" style="border: 0; margin: 0; padding: 0;"><table width="570" border="0" cellspacing="0" cellpadding="0">
									<tbody>
									<tr>
										<td colspan="3" height="14" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; font-size:0; line-height: 0;"></td>
									</tr>
									<tr>
										<td align="center" valign="middle" style="width: 45%; border: 0; margin: 0; padding: 0; background-color: #000000; color: #fff; text-align: right; font-family:{{ $fontDefinitions }};">
											<a href="https://belifusa.com" style="color: #8ad6cf; font-style: italic;">belifusa.com</a>
										</td>
										<td style="width: 10%;">&nbsp;</td>
										<td align="center" valign="middle" style="width: 45%; border: 0; margin: 0; padding: 0; background-color: #000000; color: #fff; text-align: left; font-family:{{ $fontDefinitions }};">
											<a href="#" style="color: #8ad6cf; font-style: italic;">belif at sephora</a>
										</td>
									</tr>
									<tr>
										<td colspan="3" height="14" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; font-size:0; line-height: 0;"></td>
									</tr>
									</tbody>
								</table></td>
						</tr>
						<tr>
							<td align="center" valign="top" bgcolor="#000000" style="border: 0; margin: 0; padding: 0;"><table width="570" border="0" cellspacing="0" cellpadding="0">
									<tbody>
									<tr>
										<td height="19" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; font-size:0; line-height: 0;"></td>
									</tr>
									<tr>
										<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; color: #fff; text-align: center; font-family:{{ $fontDefinitions }}; text-align: center;"><a href="https://www.instagram.com/belifusa/" target="_blank"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/icon-instagram.gif" width="27" height="27" alt="Belif Instagram" style="border: 0; margin: 0; padding: 0;"/></a> &nbsp; &nbsp; &nbsp; <a href="https://www.facebook.com/belifUSA/" target="_blank"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/icon-facebook.gif" width="27" height="27" alt="Belif Facebook" style="border: 0; margin: 0; padding: 0;"/></a> &nbsp; &nbsp; &nbsp; <a href="https://twitter.com/belifusa" target="_blank"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/icon-twitter.gif" width="27" height="27" alt="Belif Twitter" style="border: 0; margin: 0; padding: 0;"/></a></td>
									</tr>
									<tr>
										<td height="14" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; font-size:0; line-height: 0;"></td>
									</tr>
									<tr>
										<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; color: #fff; font-family:{{ $fontDefinitions }}; font-size:14px; line-height: 20px; font-style:italic; text-align: center;">&copy; belif cosmetics</td>
									</tr>
									<tr>
										<td height="9" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; font-size:0; line-height: 0;"></td>
									</tr>
									</tbody>
								</table></td>
						</tr>
						<tr>
							<td height="8" style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;"></td>
						</tr>
						<tr>
							<td style="border: 0; margin: 0; padding: 0; text-align:center; font-family:{{ $fontDefinitions }}; font-size:14px; line-height: 20px; font-style:italic;">
								<unsubscribe> Need to change your address or report spam?<br/>Contact us at <a href="mailto:contact@belifinhydration.com" target="_top">contact@belifinhydration.com</a></unsubscribe>
							</td>
						</tr>
						<tr>
							<td style="border: 0; margin: 0; padding: 0; text-align:center; font-family:{{ $fontDefinitions }}; font-size:14px; line-height: 20px; font-style:italic;"><a href="{{ $unsubscribeLink }}" style="text-decoration:none; color:#000000;"><unsubscribe>unsubscribe</unsubscribe></a></td>
						</tr>
						<tr>
							<td height="8" style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;"></td>
						</tr>
					</tbody>
			</table></td>
		</tr>
	</tbody>
</table>
</body>
</html>
