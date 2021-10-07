<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>edit</title>
</head>
<body>
    <h2>Edit application</h2>
    <form action="{{ route('app_edit_form', $application->id) }}" method="post">
	@csrf
	<label for="message_edit">Application:</label><br>
	<textarea id="message_edit" name="message_edit">{{ $application->message }}</textarea>
	<input type="submit" value="edit">
    </form>
    @include("inc.messages")
</body>
</html>
