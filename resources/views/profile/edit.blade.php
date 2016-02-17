@extends('layouts.master')

@section('title')
<title>Edit ur profile</title>
@endsection

@section('content')
{!! Breadcrumb::withLinks(['Home' => '/', 'Profiles' => '/profile', $profile->first_name.' '.$profile->last_name]) !!}

<h1>Update</h1>

@include('errors.list')

{!! Form::model($profile, ['route' => ['profile.update', $profile->id], 'method' => 'PATCH', 'class' => 'form']) !!}

	<div class="form-group">
		{!! Form::label('first_name', 'First Name') !!}
		{!! Form::text('first_name', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('last_name', 'Last Name') !!}
		{!! Form::text('last_name', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('gender', 'Gender') !!}
		{!! Form::select('gender', [1 => 'Male', 0 => 'Female'], null, ['placeholder' => 'choose gender']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('birthdate', 'Birthday') !!}		
	</div>
	<div class="form-group">
		{!! Form::date('birthdate', $profile->birthdate) !!}		
	</div>

	<div class="form-group">
		{!! Form::submit('Update Profile', ['class' => 'btn btn-primary']) !!}
	</div>

{!! Form::close() !!}
@endsection