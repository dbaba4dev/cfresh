<?php $settings = \App\Setting::find(1);  ?>
<html>
<head>
    <title>Welcome Email</title>
</head>
<body>
<table>
    <tr><td>Dear {{$name}}! </td></tr>
    <tr><td>&nbsp; </td></tr>
    <tr><td>Your account has been successfully activated. <br>
            Your account information is as below:</td></tr>
    <tr><td>&nbsp; </td></tr>
    <tr><td>Email: {{$email}} </td></tr>
    <tr><td>&nbsp; </td></tr>
    <tr><td>Password: ****** (as chosen by you)</td></tr>
    <tr><td>&nbsp; </td></tr>
    <tr><td>Thanks & Regards, </td></tr>
    <tr><td>Team {{$settings->site_name}}  </td></tr>
</table>
</body>
</html>
