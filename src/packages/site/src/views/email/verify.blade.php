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
<body style="border:0; margin:0; padding:0; background-color:#ffffff;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" style="border:0; margin:0; padding:0; background-color:#ffffff">
	<tbody>
		<tr>
			<td align="center" valign="top" bgcolor="#ffffff" style="border: 0; margin: 0; padding: 0; background-color: #ffffff;">
				<table width="570" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff" style="border:0; margin:0; padding:0; background-color:#ffffff">
					<tbody>
						<tr>
							<td style="border: 0; margin: 0; padding: 0;" height="14">&nbsp;</td>
						</tr>
						<tr>
							<td style="border: 0; margin: 0; padding: 0;">
								<table width="570" border="0" cellspacing="0" cellpadding="0" style="border:0; margin:0; padding:0; background-color:#ffffff">
									<tbody>
										<tr>
											<td style="border: 0; margin: 0; padding: 0;" align="center" valign="top">
												<table width="570" border="0" cellpadding="0" cellspacing="0">
													<tbody>
														<tr>
															<td style="border: 0; margin: 0; padding: 0;" width="19" height="22">&nbsp;</td>
															<td style="border: 0; margin: 0; padding: 0;" width="102">&nbsp;</td>
															<td align="center" valign="bottom" style="border: 0; margin: 0; padding: 0;">&nbsp;</td>
															<td style="border: 0; margin: 0; padding: 0;" width="102">&nbsp;</td>
															<td style="border: 0; margin: 0; padding: 0;" width="19">&nbsp;</td>
														</tr>
														<tr>
															<td style="border: 0; margin: 0; padding: 0;" width="19" height="107">&nbsp;</td>
															<td style="border: 0; margin: 0; padding: 0;" width="102" valign="middle" align="left"><img src="https://soup-journal-app-storage.s3.amazonaws.com/aloeaquabomb/belif_stamp.png" width="100" alt=""/></td>
															<td style="border: 0; margin: 0; padding: 0;" align="center" valign="middle"><img src="https://soup-journal-app-storage.s3.amazonaws.com/belif/Surfsup/BELIF_LOGO.png" width="150" alt="Belif"/></td>
															<td style="border: 0; margin: 0; padding: 0;" width="102" valign="middle" align="right"><img src="https://soup-journal-app-storage.s3.amazonaws.com/aqualand/aqua_confirm_header.png" width="100" alt=""/></td>
															<td style="border: 0; margin: 0; padding: 0;" width="19" height="107">&nbsp;</td>
														</tr>
														<tr>
															<td style="border: 0; margin: 0; padding: 0;" width="19" height="22">&nbsp;</td>
															<td style="border: 0; margin: 0; padding: 0;" width="102">&nbsp;</td>
															<td align="center" valign="bottom" style="border: 0; margin: 0; padding: 0;">&nbsp;</td>
															<td style="border: 0; margin: 0; padding: 0;" width="102">&nbsp;</td>
															<td style="border: 0; margin: 0; padding: 0;" width="19">&nbsp;</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
										<tr>
											<td style="border: 0; margin: 0; padding: 0;" align="left" valign="top">
												<table width="100%" border="0" cellpadding="0" cellspacing="0" style="background: url('https://soup-journal-app-storage.s3.amazonaws.com/aqualand/squirt-right.png') no-repeat left 80px;">
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
											<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family: {{ $fontDefinitions }}; color:#ffffff; font-size:12px; background-color: #01b9ff;">{!! $html !!}</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td style="border: 0; margin: 0 ; padding: 0; text-align: center;" valign="top">
								<div style="height: 750px;background: url('https://soup-journal-app-storage.s3.amazonaws.com/aqualand/belif_Aqualand-Quiz_backgrounds_Page-1.jpg') no-repeat bottom center; background-size: cover;">
									<table width="570" border="0" cellspacing="0" cellpadding="0">
										<tbody>
											<tr>
												<td height="40" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;"></td>
											</tr>
											<tr>
												<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0;">
													<table border="0" cellspacing="0" cellpadding="0">
														<tbody>
															<tr>
																<td width="30" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;"></td>
																<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:{{ $fontDefinitions }}; color:#01b9ff; font-size:18px; line-height:24px; font-weight:bold;">{!! $button !!}</td>
																<td width="30" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;"></td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<tr>
												<td height="367" style="border: 0; margin:0; padding: 0;">
													<img src="{{ $productImage }}" width="50%" />
												</td>
											</tr>
											<tr>
												<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:{{ $fontDefinitions }}; color:#ffffff; font-size:14px; line-height:18px;">{!! $text !!}</td>
											</tr>
											<tr>
												<td height="175" align="center" valign="top" style="border: 0; margin:0; padding: 0;"></td>
											</tr>
										</tbody>
									</table>
								</div>
							</td>
						</tr>
						<tr>
							<td height="20" bgcolor="#ff76a7" style="border: 0; margin: 0; padding: 0; font-size: 0; " align="center">
								<table width="570" border="0" cellspacing="0" cellpadding="0" align="center">
									<tbody>
									<tr>
										<td height="23" align="center" valign="top" style="background-color: #ff76a7;border: 0; margin:0; padding: 0;"></td>
									</tr>
									<tr>
										<td align="center" valign="middle" style="background-color: #ff76a7;border: 0; margin: 0; padding: 0; font-family:{{ $fontDefinitions }}; color: #ffffff; font-size:20px; line-height:28px; font-weight:bold; letter-spacing:-0.4px;">
											Once you confirm your email we'll be posting<br/>your sample to the following address:
										</td>
									</tr>
									<tr>
										<td height="23" align="center" valign="top" style="background-color: #ff76a7;border: 0; margin:0; padding: 0;"></td>
									</tr>
									<tr>
										<td align="center" valign="top" style="background-color: #ff76a7;border: 0; margin:0; padding: 0;">
											<table border="0" cellspacing="0" cellpadding="0" style="background-color: #ff76a7;">
												<tbody>
												<tr>
													<td bgcolor="#ffffff" style="background-color: #ffffff;border:0; margin:0; padding:5px 10px 8px 10px;; text-align:center; font-family:{{ $fontDefinitions }}; color:#01b9ff; font-size:18px; line-height:24px; letter-spacing:-0.4px; word-spacing: -0.2px;">
														<div style="background-color: #ffffff;">{{ $address1 }}</div>
													</td>
												</tr>
												</tbody>
											</table>
										</td>
									</tr>
									<tr>
										<td height="14" align="center" valign="top" style="border: 0; margin:0; padding: 0;"></td>
									</tr>
									<tr>
										<td align="center" valign="top" style="border: 0; margin:0; padding: 0;">
											<table border="0" cellspacing="0" cellpadding="0" style="background-color: #ff76a7;">
												<tbody>
												<tr>
													<td bgcolor="#ffffff" style="background-color: #ffffff;border:0; margin:0; padding: 5px 10px 8px 10px; text-align:center; font-family:{{ $fontDefinitions }}; color:#01b9ff; font-size:18px; line-height:24px; letter-spacing:-0.4px; word-spacing: -0.2px;">
														{{ $address3 }}
													</td>
												</tr>
												</tbody>
											</table>
										</td>
									</tr>
									<tr>
										<td height="10" align="center" valign="top" style="border: 0; margin:0; padding: 0;"></td>
									</tr>
									<tr>
										<td align="center" valign="top" style="border: 0; margin:0; padding: 0;">
											<table border="0" cellspacing="0" cellpadding="0" style="background-color: #ff76a7;">
												<tbody>
												<tr>
													<td bgcolor="#ff76a7" style="border:0; margin:0; padding: 5px 10px 8px 10px; text-align:center; font-family:{{ $fontDefinitions }}; color:#ffffff; font-size:12px; line-height:18px; font-weight: bold; letter-spacing:-0.4px; word-spacing: -0.2px;">We'll send you an email once<br/>the sample has been shipped!</td>
												</tr>
												<tr>
													<td align="center"><img src="https://soup-journal-app-storage.s3.amazonaws.com/aqualand/aqualand_products.png" width="200" /></td>
												</tr>
												</tbody>
											</table>
										</td>
									</tr>
									</tbody>
								</table>
							</td>
						</tr>
						{{-- Social Links Below --}}
						<tr>
							<td align="center" valign="top" bgcolor="#01b9ff" style="background-color: #01b9ff; border: 0; margin: 0; padding: 0;">
								<table width="570" border="0" cellspacing="0" cellpadding="0">
									<tbody>
									<tr>
										<td colspan="3" height="14" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #01b9ff; line-height: 0;"></td>
									</tr>
									<tr>
										<td align="center" valign="middle" style="width: 45%; border: 0; margin: 0; padding: 0; background-color: #01b9ff; color: #fff; text-align: right; font-family:{{ $fontDefinitions }};">
											<a href="https://belifusa.com" style="color: #fff; font-style: italic; text-decoration: none;">belifusa.com</a>
										</td>
										<td style="width: 10%;">&nbsp;</td>
										<td align="center" valign="middle" style="width: 45%; border: 0; margin: 0; padding: 0; background-color: #01b9ff; color: #fff; text-align: left; font-family:{{ $fontDefinitions }};">
											<a href="#" style="color: #fff; font-style: italic; text-decoration: none; white-space: nowrap;">belif at sephora</a>
										</td>
									</tr>
									<tr>
										<td colspan="3" height="14" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #01b9ff; line-height: 0;"></td>
									</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td align="center" valign="top" bgcolor="#01b9ff" style="background-color: #01b9ff; border: 0; margin: 0; padding: 0;">
								<table width="570" border="0" cellspacing="0" cellpadding="0">
									<tbody>
										<tr>
											<td height="19" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #01b9ff;">&nbsp;</td>
										</tr>
										<tr>
											<td width="570" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #01b9ff; color: #fff; text-align: center; font-family:{{ $fontDefinitions }}; text-align: center;">
												<a href="https://www.instagram.com/belifusa/" target="_blank"><img src="https://soup-journal-app-storage.s3.amazonaws.com/aqualand/instagram-logo-transparent.png" width="27" height="27" alt="Belif Instagram" style="border: 0; margin: 0; padding: 0;"/></a>
												&nbsp; &nbsp; &nbsp;
												<a href="https://www.facebook.com/belifUSA/" target="_blank"><img src="https://soup-journal-app-storage.s3.amazonaws.com/aqualand/facebook-logo-transparent.png" width="27" height="27" alt="Belif Facebook" style="border: 0; margin: 0; padding: 0;"/></a>
												&nbsp; &nbsp; &nbsp;
												<a href="https://twitter.com/belifusa" target="_blank"><img src="https://soup-journal-app-storage.s3.amazonaws.com/aqualand/twitter-logo-transparent.png" width="27" height="27" alt="Belif Twitter" style="border: 0; margin: 0; padding: 0;"/></a>
											</td>
										</tr>
										<tr>
											<td height="14" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #01b9ff; line-height: 0;">&nbsp;</td>
										</tr>
										<tr>
											<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #01b9ff; color: #fff; font-family:{{ $fontDefinitions }}; font-size:14px; line-height: 20px; font-style:italic; text-align: center;">&copy; belif cosmetics</td>
										</tr>
										<tr>
											<td height="9" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; background-color: #01b9ff;">&nbsp;</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td height="8" style="border: 0; margin: 0; padding: 0;"></td>
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
							<td height="8" style="border: 0; margin: 0; padding: 0;"></td>
						</tr>
					</tbody>
			</table></td>
		</tr>
	</tbody>
</table>
</body>
</html>
