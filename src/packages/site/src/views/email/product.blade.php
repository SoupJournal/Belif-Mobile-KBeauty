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
	$image = safeArrayValue('image', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>VDL</title>
</head>
<body style="border:0; margin:0; padding:0; background-color:#f5f5f5">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:0; margin:0; padding:0; background-color:#ffffff" bgcolor="#ffffff">
	<tbody>
		<tr>
			<td align="center" valign="top" style="border: 0; margin: 0; padding: 0; background-color: #f5f5f5;">
				<table width="570" border="0" cellspacing="0" cellpadding="0" align="center">
					<tbody>
						<tr>
							<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" height="14"></td>
						</tr>
						<tr>
							<td style="border: 0; margin: 0; padding: 0; background-position:top center; background-size: cover; background-repeat: no-repeat;" background="" bgcolor="#ffffff" valign="top">
								<!--[if gte mso 9]>
									<v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:570px;">
										<v:fill type="tile" src="$productImage" color="#f0f9f8" />
										<v:textbox style="mso-fit-shape-to-text:true" inset="0,0,0,0">
								<![endif]-->
								<div>
									<table width="570" border="0" cellspacing="0" cellpadding="0">
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
															<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" valign="top" align="left"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/space.gif" width="102" height="107" alt=""/></td>
															<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" align="center" valign="center"><img src="https://s3.amazonaws.com/soup-journal-app-storage/VDL/Images/VDL+High+Res+Logo.png" width="250" height="76" alt="VDL"/></td>
															<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" valign="center" align="center"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/space.gif" width="120" height="35" alt=""/></td>
															<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;"></td>
														</tr>

													</tbody>
												</table></td>
											</tr>

											<tr>
												<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#000000; text-transform:uppercase; font-size:28px; line-height:34px; font-weight:bold; letter-spacing:-0.4px;">{{ $title }}</td>
											</tr>
											<tr>
												<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#824d9f; font-size:18px; line-height:32px; font-weight:bold; letter-spacing:-0.8px;">{{ $subtitle }}</td>
											</tr>
											
											<tr>
												<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" height="20"></td>
											</tr>
											
											<tr>
												<td style="border: 0; margin:0; padding: 0;" align="center">
													<img src="{{ $image }}" alt=""/>
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
						<table width="570" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff">
							<tbody>
								<tr>
									<td width="370" align="center" style="border: 0; margin: 0; padding: 0; text-align:center; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#000000; font-size:14px; line-height:18px; font-style:italic; letter-spacing:-0.4px; word-spacing: -0.2px;">{!! $html !!}</td>
								</tr>
								
							</tbody>
						</table>
						
						<tr>
							<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" height="50"></td>
						</tr>
						
						<tr>
							<td align="center" valign="top" bgcolor="#000000" style="border: 0; margin: 0; padding: 0;"><table width="570" border="0" cellspacing="0" cellpadding="0">
									<tbody>
										<tr>
											<td height="19" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; font-size:0; line-height: 0;"></td>
										</tr>
										<tr>
											<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; color: #fff; text-align: center; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; text-align: center;"><a href="https://www.instagram.com/vdlus/" target="_blank"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/icon-instagram.gif" width="27" height="27" alt="VDL Instagram" style="border: 0; margin: 0; padding: 0;"/></a> &nbsp; &nbsp; &nbsp; <a href="https://www.facebook.com/vdlus/" target="_blank"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/icon-facebook.gif" width="27" height="27" alt="VDL Facebook" style="border: 0; margin: 0; padding: 0;"/></a> &nbsp; &nbsp; &nbsp; <a href="https://twitter.com/vdlus" target="_blank"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/icon-twitter.gif" width="27" height="27" alt="VDL Twitter" style="border: 0; margin: 0; padding: 0;"/></a>
											</td>
										</tr>
										<tr>
											<td height="14" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; font-size:0; line-height: 0;"></td>
										</tr>
										<tr>
											<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; color: #ffffff; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; font-size:14px; line-height: 20px; font-style:italic; text-align: center;">&copy; VDL Cosmetics</td>
										</tr>
										<tr>
											<td height="9" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; font-size:0; line-height: 0;"></td>
										</tr>
										<tr>
											<td height="8" style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;"></td>
										</tr>
										<tr>
											<td style="border: 0; margin: 0; padding: 0; text-align:center; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; font-size:14px; line-height: 20px; font-style:italic;"><a href="{{ $unsubscribeLink }}" style="text-decoration:none; color:#FFFFFF;">
												<unsubscribe>unsubscribe</unsubscribe></a></td>
										</tr>
										<tr>
											<td height="8" style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;"></td>
										</tr>
										
									</tbody>
							</table></td>
							</tr>

					</tbody>
			</table></td>
		</tr>
	</tbody>
</table>
</body>
</html>
