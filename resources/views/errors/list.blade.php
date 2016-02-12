@if (count($errors))

<div class="alert alert-danger">
<strong>Errors</strong>
<ul>
	@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
</ul>
</div>

@endif