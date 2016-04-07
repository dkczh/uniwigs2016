<?php
die(var_dump(''));
include_once("./common/conn_db.php");
$conn = new ConnDB('beta.the1727.com');

$ary = $conn->query("select * from `ps_customer` where id_customer<1005");
foreach($ary as $key=>$value)
{
$to = $value['email'];
if(empty($to))
	continue;
// subject
if($value['id_customer']==1000)
{
	$subject = '$500 credit has been credited to your The1727 account!';
	$mscc = '$500 credit has been credited to your The1727 account. You can now shop for your dainty dresses without any shipping costs!';
}
else
{
	$subject = '$20 credit has been credited to your The1727 account!';
	$mscc = '$20 credit has been credited to your The1727 account. You can now shop for your dainty dresses without any shipping costs!';
}
// message
$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Message from the1727.com</title>
</head>
<body>
<table style="font-family:Verdana, sans-serif;font-size:11px;color:#374953;width:550px;">
		<tbody><tr>
			<td align="left">
				<a rel="nofollow" target="_blank" href="http://www.the1727.com/" title="the1727.com"><img alt="the1727.com" src="http://www.the1727.com/themes/1727/images/index_07.jpg" style="border:none;"></a>
			</td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td align="left">Hi <strong style="color:#DB3484;">'.($value['lastname']?$value['lastname']:substr($to,0,strpos($to,'@'))).'</strong>,</td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td align="left">
				'.$mscc.'
				<br>
				<br>Regards,
				<br>
				The1727.com
			</td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td align="center" style="font-size:10px;border-top:1px solid #D9DADE;">
				<a rel="nofollow" target="_blank" href="http://www.the1727.com/" style="color:#DB3484;font-weight:bold;text-decoration:none;">the1727.com</a> All Rights Reserved.
			</td>
		</tr>
	</tbody></table></body>
</html>
';
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// Additional headers
$headers .= 'From: The1727 Service <service@the1727.com>' . "\r\n";
// Mail it
@mail($to, $subject, $message, $headers);


}
?>
