@extends('layouts.master')

@section('title')
<title>The Widget Page</title>
@endsection

@section('content')
	<div class="container">
	{!! Breadcrumb::withLinks(['Home' => '/', 'Widgets' => '/widget']) !!}
	<div class="row">
		<div class="col-md-6">
			<h1>Widgets</h1>
		</div>
		<div class="col-md-6 text-right">
			<a class="btn btn-lg btn-primary" href="/widget/create" style="margin-top:20px;">Create New</a>		
		</div>
	</div>
	
	
	@include('widget.datatable')
	</div>
@endsection

@section('scripts')
	@include('widget.datatable-script')
@endsection