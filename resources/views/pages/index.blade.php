@extends('layouts.master')

@section('title')
<title>Laraboot Homepage</title>
@endsection


@section('content')
{!! Breadcrumb::withLinks(['Home' => '/', 'Laraboot']) !!}

<div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div>

<div class="jumbotron">
<h1>Laraboot</h1>

<p>Welcome!</p>
</div>
@endsection

