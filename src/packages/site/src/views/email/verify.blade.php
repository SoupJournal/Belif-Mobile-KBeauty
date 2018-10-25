<?php

	//validate properties
	//if (!isset($productImage)) $productImage = "";
	//if (!isset($productColour)) $productColour = "";
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
	$productTitle = safeArrayValue('button', $pageData, "");
	$html = safeArrayValue('html', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$text2 = safeArrayValue('button_cancel', $pageData, "");
	$productImage = safeArrayValue('image', $pageData, "");

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Belif EDM 1</title>
</head>
<body style="border:0; margin:0; padding:0; background-color:#f5f5f5">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:0; margin:0; padding:0; background-color:#f5f5f5">
	<tbody>
		<tr>
			<td align="center" valign="top" style="border: 0; margin: 0; padding: 0; background-color: #f5f5f5;">
				<table width="570" border="0" cellspacing="0" cellpadding="0" align="center">
					<tbody>
						<tr>
							<td style="border: 0; margin: 0; padding: 0; line-height:0; font-size:0;" height="14"></td>
						</tr>
						<tr>
							<td bgcolor="#ffffff" style="border: 0; margin: 0; padding: 0;" ><table width="570" border="0" cellspacing="0" cellpadding="0">
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
										<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" height="51"></td>
									</tr>
									<tr>
										<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#000000; font-size:36px; line-height:47px; font-weight:bold; letter-spacing:-0.8px; word-spacing:-0.2px;">{!! $title !!}</td>
									</tr>
									<tr>
										<td height="48" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;"></td>
									</tr>
									<tr>
										<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#0072bc; font-size:24px; line-height:33px; font-style:italic; letter-spacing:-0.8px;">{!! $subtitle !!}</td>
									</tr>
									<tr>
										<td height="18" align="center" valign="top" style="border: 0; margin:0; padding: 0;"></td>
									</tr>
									<tr>
										<td align="center" valign="top" style="border: 0; margin:0; padding: 0;"><table border="0" cellspacing="0" cellpadding="0">
											<tbody>
												<tr>
													<td bgcolor="#2c68ae" style="border:0; margin:0; padding:21px 45px; text-align:center; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#ffffff; font-size:21px; line-height:21px; letter-spacing:-0.2px; text-transform: uppercase; font-weight:bold;"><a href="{{ $verifyLink }}" target="_blank" style="text-decoration: none; color:#ffffff;">Confirmez votre adresse mail</a></td>
												</tr>
											</tbody>
										</table></td>
									</tr>
								</tbody>
							</table></td>
						</tr>
						<tr>
							<td style="border: 0; margin: 0; padding: 0; background-position:top center; background-size: cover; background-repeat: no-repeat;" background="{{ $productImage }}" bgcolor="#e5f1ef" valign="top">
								<!--[if gte mso 9]>
									<v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:570px;">
										<v:fill type="tile" src="{{ $productImage }}" color="#e5f1ef" />
										<v:textbox style="mso-fit-shape-to-text:true" inset="0,0,0,0">
								<![endif]-->
								<div>
									<table width="570" border="0" cellspacing="0" cellpadding="0">
										<tbody>
											<tr>
												<td height="54" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;"></td>
											</tr>
											<tr>
												<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0;"><table border="0" cellspacing="0" cellpadding="0">
													<tbody>
														<tr>
															<td width="30" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;"></td>
															<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#0072bc; font-size:36px; line-height:47px; font-weight:bold; letter-spacing:-0.8px;">{!! $productTitle !!}</td>
															<td width="30" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;"></td>
														</tr>
													</tbody>
												</table></td>
											</tr>
											<tr>
												<td height="367" style="border: 0; margin:0; padding: 0;"></td>
											</tr>
											<tr>
												<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#0072bc; font-size:24px; line-height:38px; font-style:italic; letter-spacing:-0.8px;">{!! $html !!}</td>
											</tr>
											<tr>
												<td height="30" align="center" valign="top" style="border: 0; margin:0; padding: 0;"></td>
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
							<td height="20" bgcolor="#2c68ae" style="border: 0; margin: 0; padding: 0; font-size: 0; line-height:0;"><table width="570" border="0" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td height="44" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;"></td>
									</tr>
									<tr>
										<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#ffffff; font-size:24px; line-height:35px; font-weight:bold; letter-spacing:-0.4px;">{!! $text !!}</td>
									</tr>
									<tr>
										<td height="23" align="center" valign="top" style="border: 0; margin:0; padding: 0;"></td>
									</tr>
									<tr>
										<td align="center" valign="top" style="border: 0; margin:0; padding: 0;"><table border="0" cellspacing="0" cellpadding="0" style="background-color: #cddbec;">
											<tbody>
												<tr>
													<td bgcolor="#cddbec" style="border:0; margin:0; padding: 5px 10px 8px 10px; text-align:center; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#2c68ae; font-size:24px; line-height:24px; font-style:italic; letter-spacing:-0.4px; word-spacing: -0.2px;">{{ $address1 }}</td>
												</tr>
											</tbody>
										</table></td>
									</tr>
									<tr>
										<td height="14" align="center" valign="top" style="border: 0; margin:0; padding: 0; font-size:0; line-height:0;"></td>
									</tr>
									<tr>
										<td align="center" valign="top" style="border: 0; margin:0; padding: 0;"><table border="0" cellspacing="0" cellpadding="0" style="background-color: #cddbec;">
											<tbody>
												<tr>
													<td bgcolor="#cddbec" style="border:0; margin:0; padding: 5px 10px 8px 10px; text-align:center; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#2c68ae; font-size:24px; line-height:24px; font-style:italic; letter-spacing:-0.4px; word-spacing: -0.2px;">{{ $address2 }}</td>
												</tr>
											</tbody>
										</table></td>
									</tr>
									<tr>
										<td height="14" align="center" valign="top" style="border: 0; margin:0; padding: 0; font-size:0; line-height:0;"></td>
									</tr>
									<tr>
										<td align="center" valign="top" style="border: 0; margin:0; padding: 0;"><table border="0" cellspacing="0" cellpadding="0" style="background-color: #cddbec;">
											<tbody>
												<tr>
													<td bgcolor="#cddbec" style="border:0; margin:0; padding: 5px 10px 8px 10px; text-align:center; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#2c68ae; font-size:24px; line-height:24px; font-style:italic; letter-spacing:-0.4px; word-spacing: -0.2px;">{{ $address3 }}</td>
												</tr>
											</tbody>
										</table></td>
									</tr>
									<tr>
										<td height="34" align="center" valign="top" style="border: 0; margin:0; padding: 0;"></td>
									</tr>
								</tbody>
							</table></td>
						</tr>
						<tr>
							<td bgcolor="#ffffff" style="border: 0; margin: 0; padding: 0; font-size: 0; line-height:0;"><table width="570" border="0" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td height="22" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;"></td>
									</tr>
									<tr>
										<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#0072bc; font-size:24px; line-height:35px; font-weight:bold; letter-spacing:-0.6px;">{!! $text2 !!}</td>
									</tr>
									<tr>
										<td height="18" align="center" valign="top" style="border: 0; margin:0; padding: 0;"></td>
									</tr>
									<tr>
										<td align="center" valign="top" style="border: 0; margin:0; padding: 0;"><table width="290" border="0" cellspacing="0" cellpadding="0">
											<tbody>
												<tr>
													<td style="padding: 0; margin: 0; border: 0;"><a href="#"><img style="padding: 0; margin: 0; border: 0;" src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/product-1.jpg" width="119" height="119" alt="Belif Product"/></a></td>
													<td width="52" style="padding: 0; margin: 0; border: 0;"></td>
													<td style="padding: 0; margin: 0; border: 0;"><a href="#"><img style="padding: 0; margin: 0; border: 0;" src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/product-2.jpg" width="119" height="119" alt="Belif Product"/></a></td>
												</tr>
											</tbody>
										</table></td>
									</tr>
									<tr>
										<td height="30" align="center" valign="top" style="border: 0; margin:0; padding: 0;"></td>
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
							<td style="border: 0; margin: 0; padding: 0; text-align:center; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; font-size:14px; line-height: 20px; font-style:italic;">&nbsp;<unsubscribe> Besoin de changer d'adresse ou de signaler un spam? Contactez-nous à <a href="mailto:beliffrance@gmail.com">beliffrance@gmail.com</a> pour vous désabonner.</unsubscribe></td>
						</tr>
                        <tr>
							<td style="border: 0; margin: 0; padding: 0; text-align:center; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; font-size:14px; line-height: 20px; font-style:italic;"><a href="{{ $unsubscribeLink }}" style="text-decoration:none; color:#000000;">se désabonner</a>
							</td>
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