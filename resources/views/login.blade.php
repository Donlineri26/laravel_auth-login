<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>login</title>
</head>
<body>
    <a href="{{ route('index_page') }}">index</a>
    <form action="{{ route('login_form') }}" method="post">
	@csrf
	<input type="text" name="email" placeholder="email">
	<input type="password" name="password" placeholder="password">
	<input type="submit" value="send">
    </form> 
    @include("inc.messages")
</body>
</html>
