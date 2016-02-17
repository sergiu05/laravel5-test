@extends('layouts.master')

@section('title')
<title>{{ $profile->first_name . ' ' . $profile->last_name }}</title>
@endsection

@section('content')
@if (Auth::user()->isAdmin())
{!! Breadcrumb::withLinks(['Home' => '/', 'Profile' => '/profile', $profile->first_name.' '.$profile->last_name => $profile->id]) !!}
@else
{!! Breadcrumb::withLinks(['Home' => '/', $profile->first_name.' '.$profile->last_name]) !!}
@endif

<div class="baseMargin">
	<a href="/profile/{{ $profile->id }}/edit" class="btn btn-lg btn-primary">Update</a>
	<hr>
	<div class="panel panel-default">
		<div class="panel-heading"></div>
		<div class="panel-body">		

		</div>

		<table class="table table-stripped">
			<tr>
				<th>Id</th>	
				<th>First name</th>
				<th>Last name</th>
				<th>Username</th>
				<th>Gender</th>
				<th>Birthday</th>
				<th>Delete</th>
			</tr>
			<tr>
				<td>{{ $profile->id }}</td>
				<td><a href="/profile/{{ $profile->id }}/edit">{{ $profile->first_name }}</a></td>
				<td><a href="/profile/{{ $profile->id }}/edit">{{ $profile->last_name }}</a></td>
				@if(Auth::user()->isAdmin())
				<td><a href="/user/{{ $user->id }}">{{ $user->name }}</a></td>
				@else
				<td><a href="/settings">{{ $user->name }}</a></td>
				@endif
				<td>{{ $profile->showGender() }}</td>				
				<td>{{ $profile->showBirthday($profile->birthdate) }}</td>
				<td>
					{!! Form::model($profile, ['route' => ['profile.destroy', $profile->id], 'method' => 'DELETE']) !!}
					<div class="form-group">
						{!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => 'return confirmDelete(); ']) !!}
					</div>
					{!! Form::close() !!}
				</td>
			</tr>
		</table>
	</div>
</div>
@endsection

@section('scripts')
<script>
function confirmDelete() {
	var x = confirm('Sure u wany to delete ?');
	return x;
}
</script>
@endsection