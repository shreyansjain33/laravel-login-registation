<!DOCTYPE html>
<html>
<head>
    <title>Account Verification - {{ config('app.name', '') }}</title>
</head>
 <body>
	<br>
	<h3 style="color:#009688">Thank you registering with us. Please verify the account.</h3>
	<hr>
	<p style="color:#374046">Your registered email-id is {{$user->email}}. Please click on the below link to verify your email account:<br><br><a target="_blank" href="{{url('user/verify/')}}/{{$user->act}}" target="_blank">Verify Email Account</a></p>
	<br>
	OR open this URL in the browser:<br><br>
	{{url('user/verify')}}/{{$user->act}}
	<br><br>
	Thank You.
	<br>
	<br><br><hr>
	<small><a href="#">Contact Us</a></small>
</body> 
</html>