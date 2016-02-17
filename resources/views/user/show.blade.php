@extends('layouts.master')

@section('title')
<title>{{ $user->name }}</title>
@endsection

@section('content')
	{!! Breadcrumb::withLinks(['Home' => '/', 'Users' => '/user', $user->name => $user->id]) !!}

	<br>

	<h1>User: {{ $user->name }}</h1>

	<div class="baseMargin">
		<a href="/user/{{ $user->id }}/edit" class="btn btn-lg btn-primary">Update</a>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading"></div>
		<div class="panel-body">
		{!! Form::model($user, ['route' => ['user.destroy', $user->id], 'method' => "DELETE"]) !!}
			<div class="form-group">
				<div class="baseMargin">
				{!! Form::submit('Delete', ['class' => 'btn btn-danger pull-right', 'Onclick' => 'return confirmDelete();']) !!}
				</div>
			</div>
		{!! Form::close() !!}	
		</div>

		<table class="table table-striped">
			<tr>
				<th>Id</th>	
				<th>Name</th>
				<th>Profile</th>
				<th>Email</th>
				<th>News?</th>
				<th>Admin</th>
				<th>Type</th>
				<th>Status</th>
				<th>Created</th>
			</tr>
			<tr>
				<td>{{ $user->id }}</td>
				<td><a href="/user/{{ $user->id }}/edit">{{ $user->name }}</a></td>
				@if (isset($profile->id))
				<td><a href="/profile/{{ $profile->id }}">Profile</a></td>
				@else
				<td>Profile</td>
				@endif
				<td>{{ $user->email }}</td>
				<td>{{ $user->showNewsletterStatusOf($user) }}</td>
				<td>{{ $user->showAdminStatusOf($user) }}</td>
				<td>{{ $user->showTypeOf($user) }}</td>
				<td>{{ $user->showStatusOf($user) }}</td>
				<td>{{ $user->showDateCreated($user->created_at) }}</td>
			</tr>
		</table>
	


		
	</div>

@endsection

@section('scripts')
<script>
function confirmDelete() {
	return confirm("Are u sure u want to delete it?");
}
</script>
@endsection