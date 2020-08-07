<?php $settings = \App\Setting::find(1);  ?>
<html>
<head>
    <title>Forgot Password Email</title>
</head>
<body>
<table>
    <tr><td><img src="{{ asset('images/logo/cfresh1.jpg') }}" style="width: 40px" alt="logo"><a href="{{ asset('frontend/img/logo/cfresh1.jpg') }}"><strong style="color: #0d374a">-Fresh</strong></a></td></tr>
    <tr><td>Dear {{$name}}! </td></tr>
    <tr><td>&nbsp; </td></tr>
    <tr><td>Your account has been successfully updated. <br>
            Your account information is as below with the new password:</td></tr>
    <tr><td>&nbsp; </td></tr>
    <tr><td>Email: {{$email}} </td></tr>
    <tr><td>&nbsp; </td></tr>
    <tr><td>New Password: <span style="color: darkred"> <strong>{{$password}}</strong></span> </td></tr>
    <tr><td>&nbsp; </td></tr>
    <tr><td>Thanks & Regards, </td></tr>
    <tr><td>{{$settings->site_name}}</td></tr>
</table>
</body>
</html>
