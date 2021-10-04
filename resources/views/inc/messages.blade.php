@if($errors->any())
    <ul>
	@foreach($errors->all() as $error)
	    <li>{{ $error }}</li>
	@endforeach
    </ul>
@endif
@if(session('login_error'))
    <ul>
	<li>{{ session('login_error') }}</li>
    </ul>
@endif
