<?php

	//validate properties
	if (!isset($pageData)) $pageData = null;
	if (!isset($name)) $name = "";
	if (!isset($address1)) $address1 = "";
	if (!isset($address2)) $address2 = "";
	if (!isset($address3)) $address3 = "";
	if (!isset($emailType)) $emailType = "";
	if (!isset($emailMessage)) $emailMessage = "";
	if (!isset($emailImage)) $emailImage = "";
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
								<table width="570" height="803" border="0" cellspacing="0" cellpadding="0" style="border:0; margin:0; padding:0;background: url(https://soup-journal-app-storage.s3.amazonaws.com/letitglow/email_verify_1-1.jpg) no-repeat top center;">
									<tr>
										<td style="border: 0; margin: 0; padding: 0; height: 125px;">&nbsp;</td>
									</tr>
									<tr>
										<td style="margin: 0px auto;text-align: center;color: #fff;font-size: 24px;">{!! $title !!}</td>
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
													<td style="border:0; margin:0; padding:21px 5px; width:80%; text-align:center; color:#ffffff; font-size:14px; font-weight:bold; white-space: nowrap;">
														<div style="background: #009900;border-radius: 25px; display: block;height: 50px;line-height: 50px;">
															<a href="{{ $verifyLink }}" target="_blank" style="text-decoration: none; color:#ffffff;">VERIFY EMAIL ADDRESS</a>
														</div>
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
									<tr>
										<td style="border: 0; margin: 0; padding: 0; height: 450px;">
											@if ($emailType == 'message')
												<p style="font-size:36px; margin: 0 170px;padding-bottom:150px;text-align:center;">{!! $emailMessage !!}</p>
											@else
												<img src="{!! $emailImage !!}" />
											@endif
										</td>
									</tr>
								</table>
							</td>
						</tr>
						@if ($emailType == 'prize')
						<tr>
							<td style="border: 0; margin: 0; padding: 0;">
								<table width="570" height="377" border="0" cellspacing="0" cellpadding="0" style="border:0; margin:0; padding:0;background: url(https://soup-journal-app-storage.s3.amazonaws.com/letitglow/email_verify_2.jpg) no-repeat top center;">
									<tbody>
										<tr>
											<td style="border: 0; margin: 0; padding: 0;" align="left" valign="top">
												<table width="100%" border="0" cellpadding="0" cellspacing="0">
													<tr>
														<td height="220" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;">
															<p>You won!</p>
															<p>Your glowing prize is:</p>
															<p style="font-size:24px; margin: 0 170px;">{!! $emailMessage !!}</p>
															<p style="font-size:10px;">Your prize will be shipping in the next 4-6 weeks</p>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						@endif
						<tr>
							<td style="border: 0; margin: 0; padding: 0;">
								<table width="570" height="377" border="0" cellspacing="0" cellpadding="0" style="border:0; margin:0; padding:0;">
									<tbody>
										<tr>
											<td><a href="https://artisancouncil.com/Ulta/let-it-glow-set/redirect.php?fbclid=IwAR0-e13cP2YwUZPjiXnl4hIW6HGufJZ8vkGOgBTDl4MWUC3vcUiugJfyn0w"><img src="https://soup-journal-app-storage.s3.amazonaws.com/letitglow/email_verify_3.jpg" width="570" height="345" /></a></td>
										</tr>
										<tr>
											<td><a href="https://www.ulta.com/bestselling-hydrators-on-go-kit?productId=pimprod2013182"><img src="https://soup-journal-app-storage.s3.amazonaws.com/letitglow/email_verify_4.jpg" width="570" height="240" /></a></td>
										</tr>
										<tr>
											<td><a href="https://www.ulta.com/true-cream-aqua-bomb?productId=pimprod2013170"><img src="https://soup-journal-app-storage.s3.amazonaws.com/letitglow/email_verify_5.jpg" width="570" height="276" /></a></td>
										</tr>
										<tr>
											<td><a href="https://www.ulta.com/moisturizing-eye-bomb?productId=pimprod2013176"><img src="https://soup-journal-app-storage.s3.amazonaws.com/letitglow/email_verify_6.jpg" width="570" height="297" /></a></td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td style="border: 0; margin: 0; padding: 0;">
								<table width="570" height="794" border="0" cellspacing="0" cellpadding="0" style="border:0; margin:0; padding:0;background: url(https://soup-journal-app-storage.s3.amazonaws.com/letitglow/email_verify_7.jpg) no-repeat top center;">
									<tbody>
										<tr>
											<td style="border: 0; margin: 0; padding: 0;" align="left" valign="top">
												<table width="100%" border="0" cellpadding="0" cellspacing="0">
													<tr>
														<td height="200" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;"></td>
													</tr>
													<tr>
														<td width="570" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;  color: #fff; text-align: center; font-family:{{ $fontDefinitions }}; text-align: center;">
															<a href="https://www.instagram.com/belifusa/" target="_blank"><img src="https://soup-journal-app-storage.s3.amazonaws.com/letitglow/email_instagram_logo.jpg" width="60" height="60" alt="Belif Instagram" style="border: 0; margin: 0; padding: 0;"/></a>
															&nbsp; &nbsp; &nbsp;
															<a href="https://www.facebook.com/belifUSA/" target="_blank"><img src="https://soup-journal-app-storage.s3.amazonaws.com/letitglow/email_facebook_logo.jpg" width="60" height="60" alt="Belif Facebook" style="border: 0; margin: 0; padding: 0;"/></a>
															&nbsp; &nbsp; &nbsp;
															<a href="https://twitter.com/belifusa" target="_blank"><img src="https://soup-journal-app-storage.s3.amazonaws.com/letitglow/email_twitter_logo.jpg" width="60" height="60" alt="Belif Twitter" style="border: 0; margin: 0; padding: 0;"/></a>
														</td>
													</tr>
													<tr>
														<td height="50" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;">
															<p style="font-size:10px;">You are receiving this email because you subscribed<br/>
																to hear from us regarding products, sweepstakes and events.</p>
														</td>
													</tr>
{{--													<tr>--}}
{{--														<td width="570" align="center" valign="middle" style="border: 0; margin: 0; padding: 0;  color: #fff; text-align: center; font-family:{{ $fontDefinitions }}; text-align: center;">--}}
{{--															<a href="#" style="color:#009900;">Unsubscribe</a>--}}
{{--															&nbsp; &nbsp; &nbsp;--}}
{{--															<a href="#" style="color:#009900;">Send to a Friend</a>--}}
{{--														</td>--}}
{{--													</tr>--}}
												</table>
											</td>
										</tr>
										<tr>
											<td height="200" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; line-height: 0;">&nbsp;</td>
										</tr>
										<tr>
											<td height="100" align="center" valign="middle" style="border: 0; margin: 0; padding: 0; line-height: 0;">
												@if ($emailType == 'prize')
												<p style="color: #ffffff;">{!! $address1 !!}, {!! $address3 !!}</p>
												@endif
											</td>
										</tr>
										<tr>
											<td align="center" valign="middle" style="border: 0; margin: 0; padding: 0;  color: #fff; font-family:{{ $fontDefinitions }}; font-size:14px; line-height: 20px; font-style:italic; text-align: center;">
												<p style="width: 250px; font-size: 10px; margin: 0 auto; color: #ffffff;">
													&copy; belif cosmetics<br/>
													Need to change your address or report spam?<br/>
													Contact us at <a href="mailto:contact@belifinhydration.com" style="color: #fff;text-decoration:underline;">contact@belifinhydration.com</a><br/>
													<a href="{!! $unsubscribeLink !!}" style="color:#fff;text-decoration:none;">unsubscribe</a>
												</p>
											</td>
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
