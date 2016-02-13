@extends('layouts.master')

@section('title')
<title>{{ $widget->widget_name }}</title>
@endsection

@section('content')

{!! Breadcrumb::withLinks(['Home' => '/', 'Widgets' => '/widget', $widget->widget_name => $widget->id]) !!}

<div><h1>Update {{ $widget->widget_name }}</h1></div>

<div>
	<div class="baseMargin">
		<a href="/widget/create" class="btn btn-lg btn-primary">Create New</a>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading"></div>
		<div class="panel-body">

		</div>

		<table class="table table-striped">
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Date Created</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<tr>
				<td>{{ $widget->id }}</td>
				<td><a href="/widget/{{ $widget->id }}/edit">{{ $widget->widget_name }}</a></td>
				<td>{{ $widget->showDateCreated($widget->created_at) }}</td>
				@if (Auth::user()->adminOrCurrentUserOwns($widget))
				<td><a href="/widget/{{ $widget->id }}/edit" class="btn btn-default">Edit</a></td>
				@else
				<td>{{ $widget->widget_name }}</td>
				@endif
				<td>
					{!! Form::model($widget, ['route' => ['widget.destroy', $widget->id], 'method' => 'DELETE']) !!}
					<div class="form-group">
						{!! Form::submit('Delete', array('class' => 'btn btn-danger', 'Onclick' => 'return confirmDelete();')) !!}
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
	var x = confirm("Are u sure u want to delete?");
	if (x) {
		return true;
	}
	return false;
}
</script>
@endsection