@extends('layouts.master')

@section('title')
<title>The user page</title>
@endsection

@section('content')
	{!! Breadcrumb::withLinks(['Home' => '/', 'Users' => '/user']) !!}

	<h1>Users</h1>

	@include('user.datatable')

@endsection

@section('scripts')

	@include('user.datatable-script')

@endsection