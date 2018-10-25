<?php

	//validate properties
	if (!isset($productImage)) $productImage = "";
	if (!isset($productColour)) $productColour = "";
	if (!isset($unsubscribeLink)) $unsubscribeLink = "";
	if (!isset($pageData)) $pageData = null;
	if (!isset($multipleSamples)) $multipleSamples = false;
	
	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$html = safeArrayValue('html', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Belif EDM 2A</title>
</head>
<body style="border:0; margin:0; padding:0; background-color:#f5f5f5">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:0; margin:0; padding:0; background-color:#f5f5f5">
	<tbody>
		<tr>
			<td align="center" valign="top" style="border: 0; margin: 0; padding: 0; background-color: #f5f5f5;">
				<table width="570" border="0" cellspacing="0" cellpadding="0" align="center" >
					<tbody>
						<tr>
							<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" height="14"></td>
						</tr>
						<tr>
							<td style="border: 0; margin: 0; padding: 0; background-position:top center; background-size: cover; background-repeat: no-repeat;" background="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/belif-2a.jpg" bgcolor="#d5e4f7" valign="top">
								<!--[if gte mso 9]>
									<v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:570px;">
										<v:fill type="tile" src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/belif-2a.jpg" color="#d5e4f7" />
										<v:textbox style="mso-fit-shape-to-text:true" inset="0,0,0,0">
								<![endif]-->
								<div>
									<table width="570" border="0" cellspacing="0" cellpadding="0" >
										<tbody>
											<tr>
												<td style="border: 0; margin: 0; padding: 0;" align="left" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
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
															<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" align="center" valign="bottom"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/header-belif.png" width="250" height="76" alt="belif - believe in truth"/></td>
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
												</table></td>
											</tr>
											<tr>
												<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" height="117"></td>
											</tr>
											<tr>
												<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#0072bc; text-transform:uppercase; font-size:31px; line-height:56px; font-weight:bold; letter-spacing:-0.4px;">{{ $multipleSamples ? $text : $title }}</td>
											</tr>
											<tr>
												<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#00aeef; font-size:21px; line-height:48px; font-weight:bold; letter-spacing:-0.8px;">{{ $subtitle }}</td>
											</tr>
											<tr>
												<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" height="20"></td>
											</tr>
											<tr>
												<td style="border: 0; margin:0; padding: 0;" align="center">
													<img src="{{ $productImage }}" width="520" height="376" alt="belif - believe in truth"/>
												</td>
											</tr>
											<tr>
												<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" height="20"></td>
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
							<td style="border: 0; margin: 0; padding: 0; font-size: 0; line-height:0;" height="20"></td>
						</tr>
						<tr>
							<td height="41" bgcolor="#ffffff" style="border: 0; margin: 0; padding: 0; font-size: 0; line-height:0;"></td>
						</tr>
						<tr>
							<td align="center" bgcolor="#ffffff" style="border: 0; margin: 0; padding: 0; text-align:center; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#2c68ae; font-size:19px; line-height:30px; font-style:italic; letter-spacing:-0.4px; word-spacing: -0.2px;">If you love the samples let us know by sharing <br>
								the fun on Instagram or Facebook using<br>
								<a href="#" style="color:#00aeef; font-weight:bold; text-decoration:none;">#belifinhydration</a> and tagging us <a href="#" style="color:#00aeef; font-weight:bold; text-decoration:none;">@belifusa</a></td>
						</tr>
						<tr>
							<td height="32" bgcolor="#ffffff" style="border: 0; margin: 0; padding: 0; font-size: 0; line-height:0;"></td>
						</tr>
						<tr>
							<td style="border: 0; margin: 0; padding: 0; font-size: 0; line-height:0;" height="21"></td>
						</tr>
										<tr>
											<td align="center" valign="top" bgcolor="#000000" style="border: 0; margin: 0; padding: 0;"><table width="570" border="0" cellspacing="0" cellpadding="0">
												<tbody>
													<tr>
														<td height="19" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; font-size:0; line-height: 0;"></td>
													</tr>
													<tr>
														<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; color: #fff; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; font-size:16px; line-height: 24px; text-align: center;"><a href="https://www.sephora.fr/marques/de-a-a-z/belif-belif/" target="_blank" style="color: #00aeef; text-decoration: none; font-style:italic;">belif at sephora</a></td>
													</tr>
													<tr>
														<td height="21" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; font-size:0; line-height: 0;"></td>
													</tr>
													<tr>
														<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; color: #fff; text-align: center; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; text-align: center;"><a href="https://www.instagram.com/beliffrance/" target="_blank"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/icon-instagram.gif" width="27" height="27" alt="Belif Instagram" style="border: 0; margin: 0; padding: 0;"/></a> &nbsp; &nbsp; &nbsp; <a href="https://www.facebook.com/beliffrance/" target="_blank"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/icon-facebook.gif" width="27" height="27" alt="Belif Facebook" style="border: 0; margin: 0; padding: 0;"/></a> &nbsp; &nbsp; &nbsp; <a href="https://twitter.com/belifusa" target="_blank"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/icon-twitter.gif" width="27" height="27" alt="Belif Twitter" style="border: 0; margin: 0; padding: 0;"/></a></td>
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
											<td style="border: 0; margin: 0; padding: 0; text-align:center; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; font-size:14px; line-height: 20px; font-style:italic;"><a href="{{ $unsubscribeLink }}" style="text-decoration:none; color:#000000;">se désabonner</a></td>
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