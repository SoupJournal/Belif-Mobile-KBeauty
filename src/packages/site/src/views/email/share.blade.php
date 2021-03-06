<?php

	//validate properties
	if (!isset($pageData)) $pageData = null;
	if (!isset($unsubscribeLink)) $unsubscribeLink = "";

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Belif EDM 3</title>
</head>
<body style="border:0; margin:0; padding:0; background-color:#125a7d">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:0; margin:0; padding:0; background-color:#f5f5f5" >
	<tbody>
		<tr>
			<td align="center" valign="top" style="border: 0; margin: 0; padding: 0; background-color: #125a7d;">
				<table width="570" border="0" cellspacing="0" cellpadding="0" align="center" >
					<tbody>
						<tr>
							<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" height="14"></td>
						</tr>
						<tr>
							<td style="border: 0; margin: 0; padding: 0; background-position:bottom center; background-size: contain; background-repeat: no-repeat;" background="{{ $backgroundImage }}" bgcolor="#125a7d" valign="top">
								<!--[if gte mso 9]>
									<v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:570px;">
										<v:fill type="tile" src="{{ $backgroundImage }}" color="#ecf4fa" />
										<v:textbox style="mso-fit-shape-to-text:true" inset="0,0,0,0">
								<![endif]-->
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
																<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" valign="top" align="left"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/logo-belif.png" width="102" height="107" alt="belif - believe in truth"/></td>
																<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" align="center" valign="bottom"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile-KBeauty/images/email/header-belif-white.png" width="250" height="76" alt="belif - believe in truth"/></td>
																<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" valign="top" align="left"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/space.gif" width="102" height="1" alt=""/></td>
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
															<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#FFFFFF; text-transform:uppercase; font-size:36px; line-height:54px; font-weight:bold; letter-spacing:-1.5px; word-spacing:-1px;">{{ $title }}</td>
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
															<td align="center" valign="middle"  style="border: 0; margin: 0; padding: 0; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#42b6e7; font-size:24px; line-height:35px; font-weight:bold; letter-spacing:-0.8px;">{{ $subtitle }}</td>
															<td width="30" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;"></td>
														</tr>
													</tbody>
												</table>
												</td>
											</tr>
											<tr>
												<td height="440" style="border: 0; margin:0; padding: 0;"></td>
											</tr>
											<tr>
												<td align="center" valign="top" style="border: 0; margin:0; padding: 0;">
												<table width="350px" border="0" cellspacing="0" cellpadding="0" style="background-color: #125a7d;">
													<tbody>
														<tr>
															<td style="border:0; margin:0; padding: 7px 15px; text-align:center; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#FFFFFF; font-size:14px; line-height:15px; font-style:italic; letter-spacing:-0.5px; word-spacing: -0.8px;">{{ $text }}</td>
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
															<td bgcolor="#42b6e7" style="border:0; margin:0; padding:21px 39px; text-align:center; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#ffffff; font-size:21px; line-height:21px; letter-spacing:-0.2px; text-transform: uppercase; font-weight:bold;"><a href="http://www.belifinhydration.com" target="_blank" style="text-decoration: none; color:#ffffff;">Claim Gift Now</a></td>
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
								<!--[if gte mso 9]>
										</v:textbox>
									</v:rect>
								<![endif]-->
							</td>
						</tr>
						<tr>
							<td style="border: 0; margin: 0; padding: 0; font-size: 0; line-height:0;" height="19"></td>
						</tr>
						<tr>
							<td align="center" valign="top" bgcolor="#000000" style="border: 0; margin: 0; padding: 0;"><table width="570" border="0" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td height="19" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; font-size:0; line-height: 0;"></td>
									</tr>
									<tr>
										<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; color: #fff; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; font-size:16px; line-height: 24px; text-align: center;"><a href="http://www.sephora.com/belif" target="_blank" style="color: #00aeef; text-decoration: none; font-style:italic;">belif at sephora</a></td>
									</tr>
									<tr>
										<td height="21" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; font-size:0; line-height: 0;"></td>
									</tr>
									<tr>
										<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; color: #fff; text-align: center; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; text-align: center;"><a href="https://www.instagram.com/belifusa/" target="_blank"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/icon-instagram.gif" width="27" height="27" alt="Belif Instagram" style="border: 0; margin: 0; padding: 0;"/></a> &nbsp; &nbsp; &nbsp; <a href="https://www.facebook.com/belifUSA/" target="_blank"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/icon-facebook.gif" width="27" height="27" alt="Belif Facebook" style="border: 0; margin: 0; padding: 0;"/></a> &nbsp; &nbsp; &nbsp; <a href="https://twitter.com/belifusa" target="_blank"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/icon-twitter.gif" width="27" height="27" alt="Belif Twitter" style="border: 0; margin: 0; padding: 0;"/></a></td>
									</tr>
									<tr>
										<td height="14" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; font-size:0; line-height: 0;"></td>
									</tr>
									<tr>
										<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; color: #fff; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; font-size:14px; line-height: 20px; font-style:italic; text-align: center;">&copy; belif cosmetics</td>
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
							<td style="border: 0; margin: 0; padding: 0; text-align:center; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; font-size:14px; line-height: 20px; font-style:italic;"><a href="{{ $unsubscribeLink }}" style="text-decoration:none; color:#000000;"><unsubscribe>unsubscribe</unsubscribe></a></td>
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
