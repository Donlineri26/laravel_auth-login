<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>registration</title>
</head>
<body>
    <a href="{{ route('index_page') }}">index</a>
    <form action="{{ route('auth_form') }}" method="post">
	@csrf
	<input type="text" name="name" placeholder="name">
	<input type="text" name="email" placeholder="email (unique)">
	<input type="password" name="password" placeholder="password">
	<input type="password" name="password_confirmation" placeholder="confirm password">
	<input type="submit" value="send">
    </form> 
    @include("inc.messages")
</body>
</html>
