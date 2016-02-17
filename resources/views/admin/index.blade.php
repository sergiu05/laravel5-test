@extends('layouts.master')

@section('title')
<title>The Admin Page</title>
@endsection

@section('content')
	<h1>I am admin</h1>
	@include('admin.grid')
@endsection