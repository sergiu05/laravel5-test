@extends('layouts.master')

@section('title')
<title>All Profiles Page</title>
@endsection

@section('content')
	{!! Breadcrumb::withLinks(['Home' => '/', 'Profiles' => '/profile']) !!}

	<h1>Profiles</h1>

	@include('profile.datatable')

@endsection

@section('scripts')
	@include('profile.datatable-script')
@endsection