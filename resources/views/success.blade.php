<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>success</title>
</head>
<body>
    <a href="{{ route('index_page') }}">index</a>
    <h1>Welcome, {{ session('name') }} </h1>
    @include("inc.notification")
    <h2>Send application</h2>
    <form action="{{ route('application_form') }}" method="post">
	@csrf
	<label for="message">Application:</label><br>
	<textarea id="message" name="message"></textarea>
	<input type="submit" value="send">
    </form>
    @include("inc.messages")
    <h2>Your applications</h2>
    @foreach($data as $key => $application)
	<div>
	    <p>{{ $application->message }}</p>
	    <a href="{{ route('get_edit_page', $application->id) }}"><input type="button" value="edit"></a>
	    <a href="{{ route('app_delete', $application->id) }}"><input type="button" value="delete"></a>
	</div>
    @endforeach
</body>
</html>
