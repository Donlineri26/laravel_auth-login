<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>index</title>
</head>
<body>
    @if(session('authorize'))
	<a href="{{ route('unlogin') }}">unlogin</a>
	<a href="{{ route('profile_page') }}">profile</a>
    @else
	<a href="{{ route('auth_page') }}">registration</a>
	<a href="{{ route('login_page') }}">login</a>
	<a href="{{ route('profile_page') }}">sendApplication</a>
    @endif
    <ul>
	<h1>Users</h1>
	@foreach($users as $key => $user)
	    @if(session('authid') == $user->id)
		<li style="color: green;"><b>id</b>: {{$user->id}} <b>name</b>: {{$user->name}} <b>email</b>: {{$user->email}} <b>password</b>: {{$user->password}}</li>
	    @else
		<li><b>id</b>: {{$user->id}} <b>name</b>: {{$user->name}} <b>email</b>: {{$user->email}} <b>password</b>: {{$user->password}}</li>
	    @endif
	@endforeach 
    </ul>
</body>
</html>

