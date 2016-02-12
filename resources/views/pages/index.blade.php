@extends('layouts.master')

@section('title')
<title>Laraboot Homepage</title>
@endsection


@section('content')
{!! Breadcrumb::withLinks(['Home' => '/', 'Laraboot']) !!}

<div class="jumbotron">
<h1>Laraboot</h1>

<p>Welcome!</p>
</div>
@endsection

