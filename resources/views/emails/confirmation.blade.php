<?php $settings = \App\Setting::find(1);  ?>
<html>
<head>
    <title>Register Email</title>
</head>
<body>
<table>
    <tr><td>Dear {{$name}}! </td></tr>
    <tr><td>&nbsp; </td></tr>
    <tr><td>Please click on below link to activate your account: </td></tr>
    <tr><td>&nbsp; </td></tr>
    <tr><td><a href="{{route('confirmAccount',['code'=>$code])}}">Confirm Account</a> </td></tr>
    <tr><td>&nbsp; </td></tr>
    <tr><td>Thanks & Regards, </td></tr>
    <tr><td>Team {{$settings->site_name}}</td></tr>
</table>
</body>
</html>
