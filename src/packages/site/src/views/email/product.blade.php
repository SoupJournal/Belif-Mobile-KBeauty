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
<title>Belif EDM</title>
</head>
<body style="border:0; margin:0; padding:0; background-color:#f5f5f5">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:0; margin:0; padding:0; background-color:{{ $productColour }}" bgcolor="{{ $productColour }}">
	<tbody>
		<tr>
			<td align="center" valign="top" style="border: 0; margin: 0; padding: 0; background-color: #f5f5f5;">
				<table width="570" border="0" cellspacing="0" cellpadding="0" align="center">
					<tbody>
						<tr>
							<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" height="14"></td>
						</tr>
						<tr>
							<td style="border: 0; margin: 0; padding: 0; background-position:top center; background-size: cover; background-repeat: no-repeat;" background="" bgcolor="{{ $productColour }}" valign="top">
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
															<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" valign="top" align="left"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/logo-belif.png" width="102" height="107" alt="belif - believe in truth"/></td>
															<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" align="center" valign="center"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile-KBeauty/images/email/header-belif-white.png" width="250" height="76" alt="belif - believe in truth"/></td>
															<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" valign="center" align="center"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile-KBeauty/images/email/image-dna-2.png" width="120" height="35" alt=""/></td>
															<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;"></td>
														</tr>

													</tbody>
												</table></td>
											</tr>

											<tr>
												<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#FFFFFF; text-transform:uppercase; font-size:28px; line-height:34px; font-weight:bold; letter-spacing:-0.4px;">{{ $multipleSamples ? $text : $title }}</td>
											</tr>
											<tr>
												<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#00aeef; font-size:18px; line-height:32px; font-weight:bold; letter-spacing:-0.8px;">{{ $subtitle }}</td>
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
						<table width="570" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="{{ $productColour }}">
							<tbody>
								<tr>
									<td width="150" align="center">
										<img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile-KBeauty/images/email/image-molecule.png" width="80" height="57" alt="belif - believe in truth"/>
									</td>
									<td width="370" align="center" style="border: 0; margin: 0; padding: 0; text-align:center; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#FFFFFF; font-size:14px; line-height:18px; font-style:italic; letter-spacing:-0.4px; word-spacing: -0.2px;">{!! $html !!}</td>
									<td width="150" align="right">
										<img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile-KBeauty/images/email/image-dna.png" width="100" height="36" alt="belif - believe in truth"/>
									</td>
								</tr>
								
							</tbody>
						</table>
						
						<tr>
							<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" height="50"></td>
						</tr>
						
						<!-- instagram -->
						<!-- tr>
							<td align="center" valign="top" style="border: 0; margin:0; padding: 0;"><table border="0" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td bgcolor="#000000" style="border:0; margin:0; padding:10px 45px 10px 45px; text-align:center; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#ffffff; font-size:21px; line-height:21px; letter-spacing:-0.2px; font-weight:bold;"><a href="https://www.instagram.com/belifusa/" target="_blank" style="text-decoration: none; color:#ffffff;">
												<table border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td align="left" valign="middle"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/icon-instagram-large.png" width="40" height="40" alt="Belif Instagram" style="border: 0; margin: 8px 30px 10px 0; padding: 0 0 0 0;"/></td>
														<td  align="left" valign="middle" style="color:#ffffff">follow belif</td>
													</tr>
												</table>
												</a>
										</td>
									</tr>
								</tbody>
							</table></td>
						</tr -->
						<!-- end instagram -->
						
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
											<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; color: #fff; text-align: center; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; text-align: center;">
											<a href="https://www.instagram.com/belifusa/" target="_blank"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/icon-instagram.gif" width="27" height="27" alt="Belif Instagram" style="border: 0; margin: 0; padding: 0;"/></a> &nbsp; &nbsp; &nbsp; <a href="https://www.facebook.com/belifUSA/" target="_blank"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/icon-facebook.gif" width="27" height="27" alt="Belif Facebook" style="border: 0; margin: 0; padding: 0;"/></a> &nbsp; &nbsp; &nbsp; <a href="https://twitter.com/belifusa" target="_blank"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/icon-twitter.gif" width="27" height="27" alt="Belif Twitter" style="border: 0; margin: 0; padding: 0;"/></a>
											</td>
										</tr>
										<tr>
											<td height="14" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; font-size:0; line-height: 0;"></td>
										</tr>
										<tr>
											<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; color: #00aeef; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; font-size:14px; line-height: 20px; font-style:italic; text-align: center;">&reg;belif cosmetics</td>
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
