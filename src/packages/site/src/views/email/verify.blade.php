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
		

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Belif</title>
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
													<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" valign="top" align="left"><img src="https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/email/space.gif" width="102" height="1" alt=""/></td>
													<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" align="center" valign="bottom"><img src="https://soup-journal-app-storage.s3.amazonaws.com/belif/Surfsup/BELIF_LOGO.png" width="250" alt="Belif"/></td>
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
										<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" height="30"></td>
									</tr>
									<tr>
										<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#000000; font-size:28px; line-height:30px; font-weight:bold; letter-spacing:-0.8px; word-spacing:-0.2px;">{!! $title !!}</td>
									</tr>
									<tr>
										<td height="30" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;"></td>
									</tr>
									<tr>
										<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#000000; font-size:18px; line-height:20px; font-style:italic; letter-spacing:-0.8px;">{!! $subtitle !!}</td>
									</tr>
									<tr>
										<td height="18" align="center" valign="top" style="border: 0; margin:0; padding: 0;"></td>
									</tr>
									<tr>
										<td align="center" valign="top" style="border: 0; margin:0; padding: 0;">
											<table border="0" cellspacing="0" cellpadding="0" width="570px">
												<tbody>
													<tr>
														<td bgcolor="#ffffff">
															<table border="0" cellspacing="0" cellpadding="0">
															<tbody>
															<tr><td bgcolor="#FFFFFF" style="border:0; margin:0; padding:16px 70px; box-shadow: 0px -1px 0px white;"></tr>
															<tr><td style="border:0; margin:0; padding:16px 70px;"></tr>
															</tbody>
															</table>
														</td>
														<td bgcolor="#33ccff" style="border:0; margin:0; padding:21px 5px; width:430px; text-align:center; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#ffffff; font-size:21px; line-height:21px; letter-spacing:-0.2px; font-weight:bold;"><a href="{{ $verifyLink }}" target="_blank" style="text-decoration: none; color:#ffffff;">Confirm email</a></td>
														<td bgcolor="#ffffff">
															<table border="0" cellspacing="0" cellpadding="0">
															<tbody>
															<tr><td bgcolor="#FFFFFF" style="border:0; margin:0; padding:16px 70px; box-shadow: 0px -1px 0px white;"></tr>
															<tr><td style="border:0; margin:0; padding:16px 70px;"></tr>
															</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
									<tr>
										<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#000000; font-size:16px; line-height:18px; font-style:italic; letter-spacing:-0.8px;">{!! $html !!}</td>
									</tr>
								</tbody>
							</table></td>
						</tr>
						<tr>
							<td style="border: 0; margin: 0 ; padding: 0; text-align: center;" bgcolor="#fff" valign="top">
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
															<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#000000; font-size:32px; line-height:36px; font-weight:bold; letter-spacing:-0.8px;">{!! $button !!}</td>
															<td width="30" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;"></td>
														</tr>
													</tbody>
												</table></td>
											</tr>
											<tr>
												<td height="367" style="border: 0; margin:0; padding: 0;">
													<img src="{{ $productImage }}" width="500" />
												</td>
											</tr>
											<tr>
												<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#000000; font-size:16px; line-height:18px; font-style:italic; letter-spacing:-0.8px;">{!! $text !!}</td>
											</tr>
											<tr>
												<td height="30" align="center" valign="top" style="border: 0; margin:0; padding: 0;"></td>
											</tr>
											<tr>
												<td align="center" valign="top" style="border: 0; margin:0; padding: 0;">
													<table border="0" cellspacing="0" cellpadding="0" width="570px">
														<tbody>
														<tr>
															<td bgcolor="#ffffff">
																<table border="0" cellspacing="0" cellpadding="0">
																	<tbody>
																	<tr><td bgcolor="#FFFFFF" style="border:0; margin:0; padding:16px 70px; box-shadow: 0px -1px 0px white;"></tr>
																	<tr><td style="border:0; margin:0; padding:16px 70px;"></tr>
																	</tbody>
																</table>
															</td>
															<td bgcolor="#33ccff" style="border:0; margin:0; padding:21px 5px; width:430px; text-align:center; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#ffffff; font-size:21px; line-height:21px; letter-spacing:-0.2px; font-weight:bold;"><a href="#" target="_blank" style="text-decoration: none; color:#ffffff;">Available at Sephora NOW!</a></td>
															<td bgcolor="#ffffff">
																<table border="0" cellspacing="0" cellpadding="0">
																	<tbody>
																	<tr><td bgcolor="#FFFFFF" style="border:0; margin:0; padding:16px 70px; box-shadow: 0px -1px 0px white;"></tr>
																	<tr><td style="border:0; margin:0; padding:16px 70px;"></tr>
																	</tbody>
																</table>
															</td>
														</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<tr>
												<td height="30" align="center" valign="top" style="border: 0; margin:0; padding: 0;"></td>
											</tr>
											<tr>
												<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color:#000000; font-size:16px; line-height:18px; font-style:italic; letter-spacing:-0.8px;">{!! $buttonCancel !!}</td>
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

						{{-- Social Links Below --}}
						<tr>
							<td align="center" valign="top" bgcolor="#000000" style="border: 0; margin: 0; padding: 0;"><table width="570" border="0" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td height="19" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #000000; font-size:0; line-height: 0;"></td>
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
							<td style="border: 0; margin: 0; padding: 0; text-align:center; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; font-size:14px; line-height: 20px; font-style:italic;">
								<unsubscribe> Need to change your address or report spam?<br/>Contact us at <a href="mailto:contact@belifinhydration.com" target="_top">contact@belifinhydration.com</a></unsubscribe>
							</td>
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
