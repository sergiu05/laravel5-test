@extends('layouts.master')

@section('title')
<title>Create a Profile</title>
@endsection

@section('content')

	{!! Breadcrumb::withLinks(['Home' => '/', 'Profile' => '/profile', 'Create']) !!}

	<h1>Create a New Profile</h1>

	<hr>

	@include('errors.list')

	{!! Form::open(['url' => '/profile', 'class' => 'form']) !!}

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
		<br>
		{!! Form::select('gender', [1 => 'Male', 0 => 'Female'], null, ['placeholder' => 'choose one...']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('birthdate', 'Birthdate') !!}
		{!! Form::date('birthdate', \Carbon\Carbon::now()) !!}
	</div>	

	<div class="form-group">
		{!! Form::submit('Create Profile', ['class' => 'btn btn-primary']) !!}
	</div>

	{!! Form::close() !!}

@endsection