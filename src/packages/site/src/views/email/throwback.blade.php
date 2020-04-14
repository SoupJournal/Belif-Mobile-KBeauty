<?php

//validate properties
if (!isset($pageData)) $pageData = null;
if (!isset($name)) $name = "";
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
	<title>belif</title>
</head>
<body style="border:0; margin:0; padding:0; background-color:#ffffff">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:0; margin:0; padding:0; background-color:#ffffff">
	<tbody>
	<tr>
		<td align="center" valign="top" style="border: 0; margin: 0; padding: 0; background-color: #ffffff;">
			<table width="570" border="0" cellspacing="0" cellpadding="0" align="center">
				<tbody>
				<tr>
					<td style="border: 0; margin: 0; padding: 0; line-height:0; font-size:0;" height="14"></td>
				</tr>
				<tr>
					<td style="border: 0; margin: 0; padding: 0;">
						<table width="570" border="0" cellspacing="0" cellpadding="0">
							<tbody>
							<tr>
								<td style="border: 0; margin: 0; padding: 0;">
									<table width="570" border="0" cellpadding="0" cellspacing="0">
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
											<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" valign="middle" align="center"><img src="https://soup-journal-app-storage.s3.amazonaws.com/aloeaquabomb/belif_stamp.png" width="100" alt=""/></td>
											<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" align="center" valign="middle"><img src="https://soup-journal-app-storage.s3.amazonaws.com/belif/Surfsup/BELIF_LOGO.png" width="150" alt="Belif"/></td>
											<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" valign="middle" align="center"><img src="https://soup-journal-app-storage.s3.amazonaws.com/aloeaquabomb/belif_sts_top.png" width="100" alt=""/></td>
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
								<td style="border: 0; margin: 0; padding: 0;">
									<table width="570" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" height="30"></td>
										</tr>
										<tr>
											<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:{{ $fontDefinitions }}; color:#1d5c58; font-size:24px; line-height:30px; font-weight:bold; word-spacing:-0.2px;">{!! $title !!}</td>
										</tr>
										<tr>
											<td height="30" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;">&nbsp;</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td style="border: 0; margin: 0; padding: 0;" align="left" valign="top">
									<table width="570" height="781" border="0" cellpadding="0" cellspacing="0" style="background: url('https://soup-journal-app-storage.s3.amazonaws.com/aloeaquabomb/playlist/playlist_throwback.jpg') no-repeat center bottom #1d5c58;">
										<tr>
											<td align="center" valign="top" height="281" style="border: 0; margin: 0; padding: 0; font-family: {{ $fontDefinitions }}; color:#ffffff; font-size:12px;">
												<div style="width: 100%;padding-top:20px;font-family: {{ $fontDefinitions }}; color:#ffffff; font-size:24px; font-weight: bold;">{!! $subtitle !!}</div>
												<div style="width: 350px;padding-top:20px;font-family: {{ $fontDefinitions }}; color:#ffffff; font-size:12px;">{!! $html !!}</div>
												<div style="width: 100%;padding-top:40px;"><a href="https://open.spotify.com/playlist/4zLvTSzlm0TBkEFjw17TKg?si=Xyz8RYBSTDym1FOxzbQrPQ" target="_blank" style="text-decoration: none; color:#1d5c58; background-color: #ffffff; padding: 10px; font-weight: bold;">Follow your Playlist on Spotify</a></div>
											</td>
										</tr>
										<tr>
											<td style="border: 0; margin: 0; padding: 0; font-size:0; line-height:0;" height="500">&nbsp;</td>
										</tr>
									</table>
								</td>
							</tr>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td style="border: 0; margin: 0 ; padding: 0; text-align: center;" valign="top">
						<div>
							<table width="570" border="0" cellspacing="0" cellpadding="0" style="background: url('https://soup-journal-app-storage.s3.amazonaws.com/aloeaquabomb/backgrounds/soothe_default.png') no-repeat top center;">
								<tbody>
								<tr>
									<td height="54" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;"></td>
								</tr>
								<tr>
									<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0;">
										<table border="0" cellspacing="0" cellpadding="0">
											<tbody>
											<tr>
												<td width="30" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;"></td>
												<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:{{ $fontDefinitions }}; color:#ffffff; font-size:24px; line-height:36px; font-weight:bold;">{!! $button !!}</td>
												<td width="30" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;"></td>
											</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td height="367" style="border: 0; margin:0; padding: 0;">
										<img src="{{ $productImage }}" width="100%" />
									</td>
								</tr>
								<tr>
									<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:{{ $fontDefinitions }}; color:#ffffff; font-size:14px; line-height:18px;">{!! $text !!}</td>
								</tr>
								<tr>
									<td height="30" align="center" valign="top" style="border: 0; margin:0; padding: 0;"></td>
								</tr>
								<tr>
									<td align="center" valign="top" style="border: 0; margin:0; padding: 0;">
										<table border="0" cellspacing="0" cellpadding="0" width="570">
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
												<td bgcolor="#1d5c58" style="border:0; margin:0; padding:10px 5px; text-align:center; font-family:{{ $fontDefinitions }}; color:#ffffff; font-size:14px; line-height:20px; font-weight:bold;"><a href="https://www.sephora.com/product/belif-the-true-cream-aqua-bomb-aloe-vera-P457514" target="_blank" style="text-decoration: none; color:#ffffff;">Available at Sephora NOW!</a></td>
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
								<tr>
									<td height="30" align="center" valign="top" style="border: 0; margin:0; padding: 0;"></td>
								</tr>
								<tr>
									<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0; font-family:{{ $fontDefinitions }}; color:#ffffff; font-size:14px; line-height:18px;">{!! $buttonCancel !!}</td>
								</tr>
								</tbody>
							</table>
						</div>
					</td>
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
